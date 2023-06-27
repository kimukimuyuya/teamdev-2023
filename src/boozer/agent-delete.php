<?php
include_once '../dbconnect.php';

$id = $_GET["id"];

$sql = "UPDATE agents SET is_valid = false WHERE user_id = :id";
$stmt = $dbh->prepare($sql);
$stmt->execute(['id' => $id]);

header('Location: index.php');
?>
