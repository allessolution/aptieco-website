<?php 
//sitemap.php to sitemap.xml using .htaccess file 
require_once('include/db.php');
$courses = $db->query('SELECT * FROM courses ORDER BY id ASC');
               

//define your base URLs 
//Main URL 
$base_url = "http://aptieco.com";
//Page base URL 
$courses_base_url = "https://aptieco.com/courses?id=";



header("Content-Type: application/xml; charset=utf-8");

echo '<!--?xml version="1.0" encoding="UTF-8"?-->'.PHP_EOL; 

echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemalocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">' . PHP_EOL;
echo '<url>' . PHP_EOL;
echo '<loc>'.$base_url.'</loc>' . PHP_EOL;
echo '<changefreq>daily</changefreq>' . PHP_EOL;
echo '</url>' . PHP_EOL;

echo '<url>' . PHP_EOL;
echo '<loc>'.'https://aptieco.com/courses'.'</loc>' . PHP_EOL;
echo '<changefreq>daily</changefreq>' . PHP_EOL;
echo '</url>' . PHP_EOL;

echo '<url>' . PHP_EOL;
echo '<loc>'.'https://aptieco.com/aboutus'.'</loc>' . PHP_EOL;
echo '<changefreq>daily</changefreq>' . PHP_EOL;
echo '</url>' . PHP_EOL;

echo '<url>' . PHP_EOL;
echo '<loc>'.'https://aptieco.com/contactus'.'</loc>' . PHP_EOL;
echo '<changefreq>daily</changefreq>' . PHP_EOL;
echo '</url>' . PHP_EOL;

while($data = $courses->fetch()){
 echo '<url>' . PHP_EOL;
 echo '<loc>'.$courses_base_url.$data["id"] .'</loc>' . PHP_EOL;
 echo '<changefreq>daily</changefreq>' . PHP_EOL;
 echo '</url>' . PHP_EOL;
}

echo '</urlset>' . PHP_EOL;

?>