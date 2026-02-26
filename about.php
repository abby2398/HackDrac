<?php
$seo = [
  "title" => "About HackDrac | Cybersecurity Research & Learning Platform",
  "description" => "Learn about HackDrac, a cybersecurity research and learning platform focused on ethical hacking, vulnerabilities, and hands-on security labs.",
  "keywords" => "about hackdrac, cybersecurity researcher, ethical hacking platform",
  "url" => "https://hackdrac.in/about"
];
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
    <title>HackDrac - Vulnerable Application</title>
    <link rel="icon" href="/images/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" type="text/css" href="/css/about.css">
</head>
<body>
    
    <?php include_once 'navbar.html'; ?>
    <!-- Modal -->
    <div id="myModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <h2>You need Burp Suite</h2>
            <p>Find your login page on your own.<br>
            <strong>Email:</strong> find it yourself<br>
            <strong>Password:</strong> you need to brute force it!</p>
        </div>
    </div>

    <!-- Button to open the modal -->
    

    <!-- Your existing HTML content -->
    <section id="about">
        <div class="container">
            <h1>About HackDrac</h1>
            <p>"HackDrac is a beginner-friendly vulnerable application designed as a hands-on learning platform for cybersecurity enthusiasts. 
                Explore various vulnerabilities in a safe environment, empowering newcomers to delve into the world of ethical hacking. 
                With a range of simulated vulnerabilities, HackDrac offers a practical playground for enthusiasts to learn and sharpen 
                their cybersecurity skills, fostering a safe and educational space to understand and address potential security threats."</p>
                <button class ="btn" onclick="openModal()">HINT</button>
        </div>
    </section>
    <?php include_once 'footerabout.php'; ?>

    <!-- JavaScript to handle modal display -->
    <script>
        function openModal() {
            document.getElementById('myModal').style.display = 'block';
        }

        function closeModal() {
            document.getElementById('myModal').style.display = 'none';
        }
    </script>
</body>
</html>
