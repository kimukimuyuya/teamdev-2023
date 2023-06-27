<?php
session_start();
include_once '../dbconnect.php';

$image_name = uniqid(mt_rand(), true) . '.' . substr(strrchr($_FILES['image']['name'], '.'), 1);
$image_path = dirname(__FILE__) . '/../img/' . $image_name;
move_uploaded_file(
  $_FILES['image']['tmp_name'],
  $image_path
);

$stmt = $dbh->prepare('INSERT INTO agents (company_name, company_url, service_name, service_url, image, interview_location, type, is_online, specialization, start_at, end_at, email, phone) VALUES (:company_name, :company_url, :service_name, :service_url, :image, :interview_location, :type, :is_online, :specialization, :start_at, :end_at, :email, :phone)');
$end_at = isset($_POST['end_at']) && $_POST['end_at'] !== '' ? $_POST['end_at'] : null;
$is_online = isset($_POST['online']) && $_POST['online'] === '1' ? 1 : 0;
$specialization = isset($_POST['specialization']) && $_POST['specialization'] !== '' ? $_POST['specialization'] : null;
$stmt->execute([
  ':company_name' => $_POST['company_name'],
  ':company_url' => $_POST['company_url'],
  ':service_name' => $_POST['service_name'],
  ':service_url' => $_POST['service_url'],
  ':image' => $image_name,
  ':interview_location' => $_POST['interview_location'],
  ':type' => $_POST['type'],
  ':is_online' => $is_online,
  ':specialization' => $specialization,
  ':start_at' => $_POST['start_at'],
  ':end_at' => $end_at,
  ':email' => $_POST['email'],
  ':phone' => $_POST['phone'],
]);

$lastInsertId = $dbh->lastInsertId();

$sql = "INSERT INTO agents_items (agent_id, sort_id, rate) VALUES (?, ?, ?), (?, ?, ?), (?, ?, ?), (?, ?, ?)";
$stmt = $dbh->prepare($sql);
$stmt->execute([
  $lastInsertId, 1, $_POST['evaluation'],
  $lastInsertId, 2, $_POST['recruiting'],
  $lastInsertId, 3, $_POST['ES'],
  $lastInsertId, 4, $_POST['interview'],
]);

$stmt = $dbh->prepare('INSERT INTO agent_good(agent_id, good, good_detail) VALUES (:agent_id, :good, :good_detail)');
for($i = 0; $i < count($_POST['good']); $i++) {
  $stmt->execute([
    ':agent_id' => $lastInsertId,
    ':good' => $_POST['good'][$i],
    ':good_detail' => $_POST['good_detail'][$i],
  ]);
}

$stmt = $dbh->prepare('INSERT INTO agent_bad(agent_id, bad) VALUES (:agent_id, :bad)');
foreach ($_POST['bad'] as $bad) {
  $stmt->execute([
    ':agent_id' => $lastInsertId,
    ':bad' => $bad,
  ]);
}

$stmt = $dbh->prepare('INSERT INTO recommend (agent_id, recommend) VALUES (:agent_id, :recommend)');
foreach ($_POST['recommend'] as $recommend) {
  $stmt->execute([
    ':agent_id' => $lastInsertId,
    ':recommend' => $recommend,
  ]);
}

$stmt = $dbh->prepare('INSERT INTO agents_areas (agent_id, area_id) VALUES (:agent_id, :area_id)');
foreach ($_POST['area'] as $area) {
  $stmt->execute([
    ':agent_id' => $lastInsertId,
    ':area_id' => $area,
  ]);
}



function send_invitation($email)
{
  mb_language("Japanese");
  mb_internal_encoding("UTF-8");
  
  define("MAIL_TO_ADDRESS", $email);
  define("MAIL_SUBJECT", "新規登録完了のご連絡");
  define("MAIL_BODY", "こちらからパスワードを設定してください。 http://localhost:8080/auth/signup.php?email=$email");
  define("MAIL_FROM_ADDRESS", "boozer@example.jp");
  define("MAIL_HEADER", "Content-Type: text/plain; charset=UTF-8 \n" .
  "From: " . MAIL_FROM_ADDRESS . "\n" .
  "Sender: " . MAIL_FROM_ADDRESS . " \n" .
  "Return-Path: " . MAIL_FROM_ADDRESS . " \n" .
  "Reply-To: " . MAIL_FROM_ADDRESS . " \n" .
  "Content-Transfer-Encoding: BASE64\n");
  return mb_send_mail(MAIL_TO_ADDRESS, MAIL_SUBJECT, MAIL_BODY, MAIL_HEADER, "-f " . MAIL_FROM_ADDRESS);
}
  
send_invitation($_POST['email']);
  
$_SESSION['admin'] = 'admin';
header('Location: /boozer/index.php');
exit();