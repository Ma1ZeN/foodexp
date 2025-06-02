<?php
require_once("db.php");
$loginInput = $_POST["login"];
$passwordInput = $_POST["password"];
$sql = "SELECT * FROM Users where login = '$loginInput' AND password = '$passwordInput'";
$result = $conn->query($sql);
if ($result->num_rows > 0){
  $row = $result->fetch_assoc();
  $role = $row["role"];
  $id = $row["id"];
  session_start();
  $_SESSION["role"] = $role;
  $_SESSION["id"] = $id;
  echo $_SESSION["role"];
  if ($role === "user"){
    header("Location: ../profile.php");
  } else if ($role = "admin") {
    header("Location: ../adminpanel.php");
  }
} else {
    echo "Неверный логин или пароль";
}
?>