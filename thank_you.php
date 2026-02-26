<!-- thank_you.php -->
 <?php include 'seo.php'; ?>
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
    <title>Thank You</title>
    <link rel="icon" href="/images/favicon.ico" type="image/x-icon">
</head>
<body>
    <?php include_once 'navbar.html'; ?>
    <div class="container">
        <h1>Thank You</h1>
        <p>Your message has been sent successfully!</p>
        <p><a href="contact.php">Return to Contact Form</a></p>
    </div>
    <?php include_once 'footer.php'; ?>
</body>
</html>
