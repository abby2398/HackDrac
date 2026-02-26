<!-- <footer>
    &copy; <?php echo date("Y"); ?> HACKDRAC
    <br>
    For any queries, Contact : admin@hackdrac.com
</footer>
<style>
    footer {
        background-color: #333;
        color: #fff;
        padding: 10px;
        text-align: center;
    }
</style> -->
<?php include 'seo.php'; ?>
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
  <title>Your Page Title</title>
  <link rel="icon" href="/images/favicon.ico" type="image/x-icon">
  <style>
    /* Define a CSS reset for margin and padding */
    html, body {
      margin: 0;
      padding: 0;
      height: 100%;
    }

    /* Create a container for the whole page content */
    .wrapper {
      display: flex;
      flex-direction: column;
      min-height: 60vh; /* Take at least the full viewport height */
    }

    /* Content area */
    .content {
      flex: 1; /* Take remaining space */
    }

    /* Footer styles */
    footer {
      background-color: #333;
      color: #fff;
      padding: 10px;
      text-align: center;
    }
  </style>
</head>
<body>
  <div class="wrapper">
    <div class="content">
      <!-- Your main content here -->
    </div>
    <footer>
      &copy; <?php echo date("Y"); ?> HACKDRAC
      <br>
      For any queries, Contact : admin@hackdrac.com
    </footer>
  </div>
</body>
</html>
