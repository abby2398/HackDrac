<?php
session_start();
require_once("../config.php");

// Check if the user is logged in and has admin privileges
if (!isset($_SESSION['id']) || $_SESSION['id'] != 0) {
    echo "Access denied.";
    exit;
}

// Get the user ID from the URL parameter
$adminUserId = isset($_GET['id']) ? $_GET['id'] : null;

// Handle user management actions
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['addUser'])) {
        // Add new user (vulnerable to SQL injection)
        $newUserEmail = $_POST['email'];
        $newUserPassword = $_POST['password']; // Storing plain text password (vulnerable)
        $addUserQuery = "INSERT INTO users (email, password) VALUES ('$newUserEmail', '$newUserPassword')";
        mysqli_query($conn, $addUserQuery);
    } elseif (isset($_POST['editUser'])) {
        // Edit existing user (vulnerable to SQL injection)
        $editUserId = $_POST['editUserId'];
        $editUserEmail = $_POST['email'];
        $editUserQuery = "UPDATE users SET email = '$editUserEmail' WHERE id = $editUserId";
        mysqli_query($conn, $editUserQuery);
    } elseif (isset($_POST['deleteUser'])) {
        // Delete user (vulnerable to IDOR)
        $deleteUserId = $_POST['deleteUserId'];
        $deleteUserQuery = "DELETE FROM users WHERE id = $deleteUserId";
        mysqli_query($conn, $deleteUserQuery);
    }
}

// Search functionality
$searchResult = null;
if (isset($_POST['searchUser'])) {
    $searchEmail = $_POST['searchEmail'];
    // Search users by email (vulnerable to XSS)
    $searchQuery = "SELECT * FROM users WHERE email LIKE '%$searchEmail%'";
    $searchResult = mysqli_query($conn, $searchQuery);
}

// Fetch all users (potentially expose sensitive data)
$userQuery = "SELECT * FROM users";
$userResult = mysqli_query($conn, $userQuery);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" type="text/css" href="/css/admin.css">
</head>
<body>
    <div class="container">
        <h1>Admin Dashboard</h1>
        
        <h2>User Management</h2>
        <form action="admindashboard.php?userid=<?php echo $adminUserId; ?>" method="POST">
            <h3>Add User</h3>
            <input type="email" name="email" placeholder="User Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit" name="addUser">Add User</button>
        </form>

        <!-- Search Bar -->
        <h3>Search User by Email</h3>
        <form action="admindashboard.php?userid=<?php echo $adminUserId; ?>" method="POST">
            <input type="text" name="searchEmail" placeholder="Enter email to search" required>
            <button type="submit" name="searchUser">Search</button>
        </form>

        <!-- Display Search Results -->
        <?php if ($searchResult): ?>
            <h3>Search Results:</h3>
            <table>
                <tr>
                    <th>User ID</th>
                    <th>Email</th>
                </tr>
                <?php while ($user = mysqli_fetch_assoc($searchResult)): ?>
                    <tr>
                        <td><?php echo $user['id']; ?></td>
                        <td><?php echo $user['email']; // This line is vulnerable to XSS ?></td>
                    </tr>
                <?php endwhile; ?>
            </table>
        <?php endif; ?>

        <h3>Existing Users</h3>
        <table>
            <tr>
                <th>User ID</th>
                <th>Email</th>
                <th>Actions</th>
            </tr>
            <?php while ($user = mysqli_fetch_assoc($userResult)): ?>
                <tr>
                    <td><?php echo $user['id']; ?></td>
                    <td><?php echo $user['email']; ?></td>
                    <td>
                        <div class="action-buttons">
                            <form action="admindashboard.php?userid=<?php echo $adminUserId; ?>" method="POST">
                                <input type="hidden" name="editUserId" value="<?php echo $user['id']; ?>">
                                <input type="text" name="email" value="<?php echo $user['email']; ?>" required>
                                <button type="submit" name="editUser">Edit</button>
                            </form>
                            <form action="admindashboard.php?userid=<?php echo $adminUserId; ?>" method="POST">
                                <input type="hidden" name="deleteUserId" value="<?php echo $user['id']; ?>">
                                <button type="submit" name="deleteUser" onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                        </div>
                    </td>
                </tr>
            <?php endwhile; ?>
        </table>
    </div>
</body>
</html>

<?php
mysqli_close($conn);
?>
