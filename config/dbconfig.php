<!-- codes for database configuration -->

<?php
$host='localhost';
$dbname='toronto_web';
$user='root';
$password='m1166kfm';
$dsn="mysql:host=$host;dbname=$dbname";  # ;port=3307  when you use other port number 

try {
    $pdo = new PDO ($dsn, $user, $password);

// If there is an error in database connection, this message will be printed
} catch (PDOException $e) {
    echo "Database Connection Failed: ". $e->getMessage();
}


/*
$host = "ls-5b1561e643c25cb5b8be6b62eccce44fab09e23e.cjkuemg0o8gl.ca-central-1.rds.amazonaws.com";
$dbname = "toronto_web";
$username = "toronto_user";
$password = "t1166kfm";

$dsn = "mysql:host=$host;dbname=$dbname;charset=utf8";

try {
    // Create a PDO instance (connect to the database)
    $pdo = new PDO($dsn, $username, $password);
    
    // Set the PDO error mode to exception
    //$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    //echo "Connected successfully"; 
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

$servername = "localhost";
$username = "toronto_user";
$password = "t1166kfm";
$dbname = "toronto_web";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully";
*/