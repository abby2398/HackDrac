<html>
    <head>
        <title>About Us</title>
        <link rel="icon" href="/images/favicon.ico" type="image/x-icon">
        <style>
            .container {
    width: 80%;
    margin: auto;
    text-align: center;
    margin-top: 10px;
}
.btn {
    display: inline-block;
    padding: 10px 20px;
    text-decoration: none;
    background-color: #333;
    color: #fff;
    border: 1px solid #fff;
    border-radius: 5px;
    transition: all 0.3s ease;
}

.btn:hover {
    background-color: #fff;
    color: #333;
}
        </style>
    </head>
    <body>
        <?php include_once 'navbar.html'; ?>
        <section id="vulnerabilities">
            <div class="container">
                <h2>Explore Vulnerabilities</h2>
                <p>SQL Injection <br> 
                Malicious File Upload<br>
                Directory Listing<br>
                Insecure HTTP Methods<br>
                Brute Force Attacks<br>
                DoS Attacks<br></p>
                <a href="/index.php" class="btn">Go Back</a>
                
            </div>
    </section>

        <?php include_once 'footer.php'; ?>
    </body>
</html>
