<?php
require_once("db.php");
$loginInput = $_POST["login"];
$passwordInput = $_POST["password"];
$fname = $_POST["fname"];
$lname = $_POST["lname"];
$numberInput = $_POST["number"];
$sql = "INSERT INTO Users(fname, lname, phonenumber, login, password, role) VALUES ('$fname','$lname','$numberInput','$loginInput','$passwordInput','user')";
if ($conn->query($sql)){
    header("location: ../profile.php");
} else {
    echo "Регистрация не успешна";
};