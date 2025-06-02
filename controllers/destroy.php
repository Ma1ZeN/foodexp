<?php
session_start();
session_destroy();
// echo $_SESSION["role"];
header("Location: ../login.php");