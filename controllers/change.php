<?php
require_once("config.php");
$request_id = $_POST["request_id"];
$status = $_POST["status"];
$cancel_reason = $_POST["cancel_reason"];
$sql = "UPDATE request SET status = '$status', cancel_reason = '$cancel_reason' where id = '$request_id'";
if ($conn->query($sql)) {
    echo "Статус изменен";
    header("location: ../pages/adminpanel.php");
} else {
    echo "Не удалось изменить статус";
}