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

    <title>Error</title>
    <link rel="stylesheet" type="text/css" href="/css/styles.css">
    <link rel="icon" href="/images/favicon.ico" type="image/x-icon">
</head>
<body>
    <?php include_once 'navbar.html'; ?>
    <div class="container">
        <h1>You Broke Me!</h1>
        <img width="400" height="400" src="images/error.jpg" alt="HackDrac cybersecurity platform">
    </div>
    </body>
    <!-- <p><?php echo htmlspecialchars($_GET['message']); ?></p> -->
    <?php include_once 'footer.php'; ?>
</body>
</html>
