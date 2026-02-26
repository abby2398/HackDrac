<?php
header("Content-Type: application/xml; charset=UTF-8");

$baseUrl = "https://hackdrac.in";

/*
 ONLY public pages
*/
$pages = [
    "/",
    "/about.php",
    "/contact.php",
    "/login.php",
    "/registration.php",
    "/forget.php",
    "/reset-password.php",
    "/thank_you.php",
    "/error.php"
];

echo '<?xml version="1.0" encoding="UTF-8"?>';
?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
<?php foreach ($pages as $page): ?>
  <url>
    <loc><?= $baseUrl . $page ?></loc>
    <lastmod><?= date("Y-m-d"); ?></lastmod>
    <changefreq>weekly</changefreq>
    <priority><?= $page === "/" ? "1.0" : "0.8"; ?></priority>
  </url>
<?php endforeach; ?>
</urlset>