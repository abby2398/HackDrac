<?php
$seo = [
  "title" => "HackDrac | Learn Cybersecurity, Ethical Hacking & Real-World Attacks",
  "description" => "HackDrac is a hands-on cybersecurity platform to learn ethical hacking, vulnerabilities, penetration testing, and real-world attack techniques.",
  "keywords" => "cybersecurity, ethical hacking, penetration testing, infosec learning",
  "url" => "https://hackdrac.in/"
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <title><?= $seo['title']; ?></title>

    <meta name="description" content="<?= $seo['description']; ?>">
    <meta name="keywords" content="<?= $seo['keywords']; ?>">
    <meta name="author" content="HackDrac">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="canonical" href="<?= $seo['url']; ?>">
    <link rel="icon" href="/images/favicon.ico" type="image/x-icon">

    <!-- Open Graph -->
    <meta property="og:title" content="<?= $seo['title']; ?>">
    <meta property="og:description" content="<?= $seo['description']; ?>">
    <meta property="og:url" content="<?= $seo['url']; ?>">
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="HackDrac">

    <!-- Twitter -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<?= $seo['title']; ?>">
    <meta name="twitter:description" content="<?= $seo['description']; ?>">

    <link rel="stylesheet" href="/css/index_styles.css">
</head>
<body>
<?php include_once 'navbar.html'; ?>
    <section id="hero">
        <div class="hero-content">
            <h1>HackDrac – Practical Cybersecurity & Ethical Hacking Platform</h1>
            <h2>Welcome to HackDrac</h2>
            <p>A hands-on playground to explore and learn various vulnerabilities in a safe environment.</p>
            <p>
                HackDrac helps learners and security professionals understand real-world cyber attacks,
                web vulnerabilities, penetration testing techniques, and defensive security concepts
                through practical labs and research-based notes.
            </p>
            <a href="/about.php" class="btn">Get Started</a>
        </div>
    </section>
    <?php include_once 'footer.php'; ?>
</body>
</html>
