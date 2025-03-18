<html>
<head>
    <title>Sign in</title>
    <link rel="stylesheet" type="text/css" href="/css/styles.css">
    <link rel="icon" href="/images/favicon.ico" type="image/x-icon">
</head>

<body>
<?php include_once 'navbar.html'; ?>
<div class="container">
        <h1>Forget password?</h1>
        <form class="form" action="reset-password.php" method="post" >
            <label>Email</label><br>
            <input type="text" name="email"><br><br>
            <button type="submit" name="submitbtn" value="login">Reset Password</button>
            <p>Don't have an account? <a href="registration.php" class="link-danger">Register</a></p>
        <p><a href="login.php">Login</a></p>
        </form>    
    </div>
    <?php include_once 'footer.php'; ?>
</body>
</html>