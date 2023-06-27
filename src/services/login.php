<?php
session_start();
include_once('../dbconnect.php');

$email = $_POST['email'];
$password = $_POST['password'];

$sql = "SELECT * FROM agents WHERE email = :email";
$stmt = $dbh->prepare($sql);
$stmt->bindValue(':email', $email, PDO::PARAM_STR);
$stmt->execute();
$agent = $stmt->fetch(PDO::FETCH_ASSOC);

$sql = "SELECT * FROM admin WHERE email = :email";
$stmt = $dbh->prepare($sql);
$stmt->bindValue(':email', $email, PDO::PARAM_STR);
$stmt->execute();
$admin = $stmt->fetch(PDO::FETCH_ASSOC);

if ($agent) {
  if (password_verify($password, $agent['password'])) {
    $_SESSION['agent'] = $agent;
    header('Location: ../client/client-admin.php');
    exit();
  } else {
    $_SESSION['error_message'] = 'パスワードが間違っています';
    header('Location: ../auth/login.php');
    exit();
  }
} else if ($admin) {
  if (password_verify($password, $admin['password'])) {
    $_SESSION['admin'] = $admin;
    header('Location: ../boozer/index.php');
    exit();
  } else {
    $_SESSION['error_message'] = 'パスワードが間違っています';
    header('Location: ../auth/login.php');
    exit();
  }
} else {
  $_SESSION['error_message'] = 'メールアドレスが存在しません';
  header('Location: ../auth/login.php');
  exit();
}
?>