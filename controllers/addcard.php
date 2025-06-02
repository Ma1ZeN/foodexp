<?php
session_start();
require_once("db.php");
$user_id=$_SESSION["id"];
$product_id=$_POST["product_id"];
$sql="INSERT INTO cart (product_id, User_id) VALUES ($product_id, $user_id)";
$conn->query($sql);
header("Location: ../menu.php"); 
?>