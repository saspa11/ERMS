<?php 
// These variables will be pulled from Render's environment settings
$host = getenv('DB_HOST'); 
$dbname = getenv('DB_NAME'); 
$username = getenv('DB_USER'); 
$password = getenv('DB_PASSWORD'); 
$charset = 'utf8mb4'; 

try { 
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=$charset", $username, $password, [ 
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, 
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, 
        PDO::ATTR_EMULATE_PREPARES => false, 
    ]); 
} catch (PDOException $e) { 
    // On the live server, we don't want to show detailed errors to users
    die('Database connection failed. Please check environment variables.'); 
} 
?>
