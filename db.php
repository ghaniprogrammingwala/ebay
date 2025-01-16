<?php
$host = "localhost";
$dbname = "dbjdo3ulsdoq9x";
$username = "ufjxcuglyxh0v";
$password = "9ns8h6qtlbgn";

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}
?>
