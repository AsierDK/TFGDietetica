<?php
define('DB_SERVER', 'sql203.infinityfree.com');
define('DB_USERNAME', 'if0_38644371');
define('DB_PASSWORD', 'q5jPkzZwIEQJK');
define('DB_DATABASE', 'if0_38644371_dieta');
function conexionbbdd()
{
    try {
        $conn = new PDO("mysql:host=" . DB_SERVER . ";dbname=" . DB_DATABASE."", DB_USERNAME, DB_PASSWORD);
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }
    return $conn;
}
?>