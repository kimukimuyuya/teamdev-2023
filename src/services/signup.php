<?php
session_start();
include_once('../dbconnect.php');

$email = $_GET['email'];
$password = $_POST['password'];
$confirm_password = $_POST['confirm_password'];

$sql = "SELECT * FROM agents WHERE email = :email";
$stmt = $dbh->prepare($sql);
$stmt->bindValue(':email', $email, PDO::PARAM_STR);
$stmt->execute();
$agent = $stmt->fetch(PDO::FETCH_ASSOC);

if ($password !== $confirm_password) {
  $_SESSION['error_message'] = "パスワードが一致していません";
  header('Location: ../auth/signup.php?email=' . $email);
  exit();
} else {
  $sql = "UPDATE agents SET password = :password WHERE email = :email";
  $stmt = $dbh->prepare($sql);
  $stmt->bindValue(':password', password_hash($password, PASSWORD_DEFAULT), PDO::PARAM_STR);
  $stmt->bindValue(':email', $email, PDO::PARAM_STR);
  $stmt->execute();
  header('Location: ../auth/login.php');
  exit();
}
?>