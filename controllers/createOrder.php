<?php
require_once("config.php");
session_start();
$adressInput = $_POST["adress"];
$contactInput = $_POST["contact"];
$dateInput = $_POST["date"];
$serviceInput = $_POST["service"];
$serviceAnotherInput = $_POST["serviceAnother"];
$paymentInput = $_POST["payment"];
$service = $serviceInput . " (" .$serviceAnotherInput.")";
$idUser = $_SESSION["id"];
$sql = "INSERT INTO request(adress, contact, date, service, pay, status, id_login) VALUES ('$adressInput','$contactInput','$dateInput','$service','$paymentInput','В работе','$idUser')";
if ($result = $conn->query($sql)){
    header("Location: ../pages/profile.php");
} else {
    echo "Ошибка";
}
?>