<?php 
function db_connection($host, $port, $dbname, $username, $password)
{
    $dsn = "mysql:host=$host;port=$port;dbname=$dbname";
    try {
        $conn = new PDO($dsn, $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conn;
    } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }
}
?>
