<!-- codes for database configuration -->
 
<?php
$host = "ls-5b1561e643c25cb5b8be6b62eccce44fab09e23e.cjkuemg0o8gl.ca-central-1.rds.amazonaws.com";
$dbname = "toronto_web";
$username = "toronto_user";
$password = "t1166kfm";

$dsn = "mysql:host=$host;dbname=$dbname";

try {
    // Create a PDO instance (connect to the database)
    $pdo = new PDO($dsn, $username, $password);
    
    // Set the PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    //echo "Connected successfully"; 
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>