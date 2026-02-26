<?php 
session_start();
require_once("config.php");

// Check if the user is already authenticated
if (isset($_SESSION["authenticated"]) && $_SESSION["authenticated"] === true) {
    header("Location: dashboard.php"); // Redirect to dashboard page
    exit; // Make sure to exit after the redirect
}

if (isset($_POST['email']) && isset($_POST['password'])) {
    $nm = $_POST['email'];
    $pwd = $_POST['password'];

    // Vulnerable to SQL Injection
    $emailCheckQuery = "SELECT username, id, Password FROM users WHERE email = '$nm'";
    $result = mysqli_query($conn, $emailCheckQuery);
    
    if (!$result) {
        // Database query error
        header("Location: error.php?message=" . urlencode("Database query error: " . mysqli_error($conn)));
        exit;
    }

    // Check if the email is found
    if (mysqli_num_rows($result) > 0) {
        // Email exists, now check the password
        $user = mysqli_fetch_array($result);
        if ($user['Password'] === $pwd) { // Vulnerable to timing attacks
            // After successful login, set session ID
            $session_id = session_id();
            $update_query = "UPDATE users SET session_id = '$session_id' WHERE email = '$nm'";
            $update_result = mysqli_query($conn, $update_query);
            
            if ($update_result) {
                // Set session variables
                $_SESSION["authenticated"] = true;
                $_SESSION["email"] = $nm;
                $_SESSION["username"] = $user['username']; // Store username in session
                $_SESSION["id"] = $user["id"];

                // If user ID = 1, redirect to admin page
                if ($_SESSION['id'] == 1) {    
                    header("Location: /admin/admin.php");
                    exit;
                }

                // Redirect to dashboard with user ID in the URL (vulnerable to IDOR)
                header("Location: dashboard.php?user_id=" . $_SESSION['id']); 
                exit;
            } else {
                // Failed to update session ID
                echo "<script>alert('Session error. Please try again.');</script>";
                exit;
            }
        } else {
            // Password is incorrect
            echo "<script>alert('Incorrect password. Please try again.');</script>";
            exit;
        }
    } else {
        // Email is incorrect
        echo "<script>alert('Email not found. Please check and try again.');</script>";
        exit;
    }
}

mysqli_close($conn);

$seo = [
  "title" => "Login | HackDrac Cybersecurity Platform",
  "description" => "Login to your HackDrac account to access cybersecurity labs, notes, and vulnerability research.",
  "keywords" => "hackdrac login, cybersecurity platform login",
  "url" => "https://hackdrac.in/login"
];
?>

<!DOCTYPE html>
<html>
<head>
    <title><?= $seo['title']; ?></title>

    <meta name="description" content="<?= $seo['description']; ?>">
    <meta name="keywords" content="<?= $seo['keywords']; ?>">

    <link rel="canonical" href="<?= $seo['url']; ?>">

    <meta property="og:title" content="<?= $seo['title']; ?>">
    <meta property="og:description" content="<?= $seo['description']; ?>">
    <meta property="og:url" content="<?= $seo['url']; ?>">
    <meta property="og:type" content="website">

    <!-- <title>Sign in</title> -->
    <link rel="stylesheet" type="text/css" href="/css/styles.css">
    <link rel="icon" href="/images/favicon.ico" type="image/x-icon">
</head>
<body>
<?php include_once 'navbar.html'; ?>
<div class="container">
    <h1>Sign in here</h1>
    <form class="form" action="login.php" method="post">
        <label>Email</label><br>
        <input type="text" name="email" required><br><br>
        <label>Password</label><br>
        <input type="text" name="password" required><br><br>
        <button type="submit" name="submitbtn" value="login">Sign in</button>
        <p>Don't have an account? <a href="registration.php" class="link-danger">Register</a></p>
        <p><a href="forget.php">Forget password</a></p>
    </form>    
</div>
<?php include_once 'footer.php'; ?>
</body>
</html>


