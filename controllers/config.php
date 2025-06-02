<?php
$DB_NAME = "examen";
$DB_USER = "root";
$DB_PASS = "";
$DB_HOST = "localhost";
$DB_PORT = "3308";
try {
   $conn = new mysqli($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME, $DB_PORT);
} catch (\Throwable $th) {
    echo  $th->getMessage();
}
?>