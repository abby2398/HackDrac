<?php
session_start();
require_once("config.php");

// Check if the user is logged in
if (!isset($_SESSION["authenticated"]) || $_SESSION["authenticated"] !== true) {
    header("Location: login.php");
    exit;
}

// Get the username and email from the session
$username = isset($_SESSION["username"]) ? $_SESSION["username"] : "User"; // Fallback to 'User' if not set
$email = $_SESSION["email"];
$id = $_SESSION["id"];

// Check if a user ID is provided in the URL, if not use the logged-in user's ID
$user_id = isset($_GET['user_id']) ? $_GET['user_id'] : $id;

// Vulnerable: No validation on user_id, allowing IDOR
$viewNotesQuery = "SELECT * FROM notes WHERE user_id = '$user_id' ORDER BY created_at ASC"; 
$result = mysqli_query($conn, $viewNotesQuery);
$notesArray = [];

// Fetch all results into the array
while ($row = mysqli_fetch_assoc($result)) {
    $notesArray[] = $row; // Append each row to the notesArray
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Page</title>
    <link rel="stylesheet" type="text/css" href="/css/dashboard.css">
    <link rel="stylesheet" type="text/css" href="/css/navbar.css">
    <link rel="stylesheet" type="text/css" href="/css/notes.css">
    <link rel="icon" href="/images/favicon.ico" type="image/x-icon">
</head>
<body>
    <nav>
        <a href="index.php">Home</a>
        <a href="contact.php" target="_blank">Contact</a>
        <a href="about.php" target="_blank">About Us</a>
    </nav>
   <!-- <h1 style="color: blueviolet; text-align: center;">dashboard to Hackdrac</h1> -->
   <?php
    // Display the user's profile picture if available
    $profileImagePath = '';
    $email = $_SESSION["email"]; 
    $profileImageQuery = "SELECT ProfileImage FROM users WHERE email = '$email'";
    $result = mysqli_query($conn, $profileImageQuery);

    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $profileImagePath = $row['ProfileImage'];
    }
    ?>
    <div class="outer">
    <div class="dashboard">
        <h1>Welcome back, <?php echo $username; ?></h1>   <!--  htmlspecialchars($username) for removing special chars -->
        <?php   if (!empty($profileImagePath)) {
        echo "<img src='$profileImagePath' alt='Profile Picture' class='profile-picture'>";
    } ?>
    </div>

        <div class="right-bar">
            <a href="edit-profile.php" class="profile-link">Edit Profile</a>
            <form action="logout.php" method="post" class="logout-form">
                <input type="submit" class="logout-button" value="Logout">
            </form>
        </div>
    </div>

    <div>
        <h2>Your Notes</h2>
        <form method="post" action="notes.php">
            <textarea name="message" class="note-form" cols="50" rows="20" required></textarea><br>
            <input type="submit" class="submit-btn" value="Submit" />
        </form>
    </div>

    <div>
    <h2>My Notes</h2>
    <table>
        <thead>
            <tr>
                <th>Message</th>
                <th>Created At</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            if (!empty($notesArray)) {
                foreach ($notesArray as $note) {
                    echo '<tr>';
                    echo '<td>' . $note['message'] . '</td>'; 
                    echo '<td>' . $note['created_at'] . '</td>'; 
                    echo '<td>';

                    // Edit and Delete buttons
                    echo '<a href="edit-note.php?note_id=' . $note['message_id'] . '&user_id=' . $user_id . '" class="edit-btn">Edit</a>';
                    echo '<form method="POST" action="delete-note.php" style="display:inline;">
                            <input type="hidden" name="note_id" value="' . $note['message_id'] . '">
                            <button type="submit" class="delete-btn">Delete</button>
                          </form>';

                    // Save to PDF button for each note
                    echo '<form action="generate_pdf.php" method="POST" style="display:inline;">
                            <input type="hidden" name="name" value="' . $username . '">
                            <input type="hidden" name="email" value="' . $email . '"> <!-- Replace with actual user email -->
                            <input type="hidden" name="message" value="' . $note['message'] . '"> <!-- No encoding/sanitization -->
                            <input type="hidden" name="created_at" value="' . $note['created_at'] . '"> <!-- No encoding/sanitization -->
                            <input type="hidden" name="document_id" value="' . $note['message_id'] . '"> <!-- Directly exposing ID -->
                            <button type="submit" class="save-pdf-btn">Save to PDF</button>
                          </form>';

                    echo '</td>';
                    echo '</tr>';
                }
            } else {
                echo '<tr><td colspan="3">No notes found.</td></tr>';
            }
            ?>
        </tbody>
    </table>
</div>

    
    <?php include_once 'footer.php'; ?>
</body>
</html>
