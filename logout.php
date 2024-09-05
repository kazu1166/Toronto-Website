<!-- codes for logging out (No HTML content) -->

<?php
session_start();

$_SESSION = []; // unset all session variables

session_destroy(); // destroy the session

header("Location: index.php"); // go back to home page
exit;

