<!DOCTYPE html>
<html>
<head>
    <title>Registration Page</title>
    <link rel="icon" href="/images/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" type="text/css" href="/css/styles.css">
</head>

<body>
<?php include_once 'navbar.html'; ?>
<div class="container">
    <h1>Register here.</h1>
    <form class="form" action="registration.php" method="post">
        <label>Email Id</label><br>
        <input name="email" type="text" placeholder="Enter your Email ID" required><br><br>
       
        <label>User Name</label><br>
        <input name="username" type="text" placeholder="Enter your name" required><br><br> 
        <label>Password</label><br>
        <input name="password" type="password" placeholder="Enter your Password" required><br><br>
        <label>Confirm Password</label><br>
        <input name="confirm_password" type="password" placeholder="Confirm your Password" required><br><br>
        <button type="submit" value="submit">Register</button><br><br>
        <p>Already have an account? <a href="login.php" class="link-danger">Login</a></p>
    </form>
    
</div>
</body>
<?php include_once 'footer.php'; ?>

</html>

<?php
require_once("config.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (
        isset($_POST['email']) && isset($_POST['username']) && isset($_POST['password']) && isset($_POST['confirm_password'])
    ) {
        $email = $_POST['email'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $confirmPassword = $_POST['confirm_password'];

        if (!empty($email) && !empty($username) && !empty($password) && !empty($confirmPassword)) {
            // Check if the username already exists in the database
            $checkSql = "SELECT * FROM users WHERE email = '$email'";
            $checkResult = mysqli_query($conn, $checkSql);

            if (mysqli_num_rows($checkResult) > 0) {
                echo "<script>alert('Username already exists. Please choose a different username.');</script>";
            } else {
                if ($password === $confirmPassword) {
                    $sql = "INSERT INTO users (email, username, Password) VALUES ('$email', '$username', '$password')";
                    if (mysqli_query($conn, $sql)) {
                        echo "<script>alert('Record Added Successfully');</script>";
                        header("Location: login.php");
                    } else {
                        echo "Error: " . mysqli_error($conn);
                    }
                } else {
                    echo "<script>alert('Passwords do not match. Please try again.');</script>";
                }
            }
        } else {
            echo "<script>alert('Please fill in all the required fields.');</script>";
        }
    }
}

mysqli_close($conn);
?>
