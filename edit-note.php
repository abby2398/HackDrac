<?php
$seo = [
  "title" => "Cybersecurity Notes & Writeups | HackDrac",
  "description" => "Read cybersecurity notes, pentesting writeups, and vulnerability analysis based on real-world attack scenarios.",
  "keywords" => "pentesting notes, bug bounty writeups, security research",
  "url" => "https://hackdrac.in/notes"
];
?>
<?php
session_start();
require_once("config.php"); // Include your database connection

// Vulnerability: No authentication check
// Check if the note_id is provided directly from the GET request
if (isset($_GET['note_id'])) {
    $note_id = $_GET['note_id']; // IDOR vulnerability, no validation
    $user_id = $_SESSION['id']; // User ID taken directly from session

    // Vulnerability: SQL Injection vulnerability
    $query = "SELECT * FROM notes WHERE message_id = $note_id"; 
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) === 1) {
        $note = mysqli_fetch_assoc($result);
    } else {
        echo "Note not found.";
        exit;
    }
} else {
    echo "No note ID provided.";
    exit;
}

$id = $_SESSION["id"];

// Handle the form submission for updating the note
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['message'])) {
        $updated_message = $_POST['message']; // Vulnerable to XSS

        // Vulnerability: Update note without validation
        $updateQuery = "UPDATE notes SET message = '$updated_message' WHERE message_id = $note_id"; // SQL Injection
        mysqli_query($conn, $updateQuery);

        // Vulnerability: Lack of error handling
        echo '<p class="success-message">Your note has been updated successfully!</p>';
        header("Location: dashboard.php?id=$id"); // Redirect to notes page after update
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>

    <title><?= $seo['title']; ?></title>

    <meta name="description" content="<?= $seo['description']; ?>">
    <meta name="keywords" content="<?= $seo['keywords']; ?>">

    <link rel="canonical" href="<?= $seo['url']; ?>">

    <meta property="og:title" content="<?= $seo['title']; ?>">
    <meta property="og:description" content="<?= $seo['description']; ?>">
    <meta property="og:url" content="<?= $seo['url']; ?>">
    <meta property="og:type" content="website">

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Note</title>
    <link rel="stylesheet" href="/css/notes.css"> <!-- Link to your CSS file -->
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
    <div style= "margin-left: 20px;">
        <h2>Edit Note</h2>
        <form method="POST" action="">
            <textarea name="message" cols="50" rows="20" required><?php echo $note['message']; ?></textarea>
            <br>
            <input type="submit" class="submit-btn" value="Update Note" />
        </form>
        <a href="dashboard.php?user_id=<?php echo $user_id; ?>">Cancel</a>
    </div>
    <?php include_once 'footer.php'; ?>
</body>
</html>
