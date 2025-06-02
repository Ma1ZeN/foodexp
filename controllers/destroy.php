<?php
session_destroy();
echo $_SESSION["role"];
// header("Location: ../login.php");