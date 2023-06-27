<?php
session_start();
include_once './dbconnect.php';

$name = $_POST['name'];
$name_kana = $_POST['name_kana'];
$gender = $_POST['gender'];
$university = $_POST['university'];
$faculty = $_POST['faculty'];
$graduate_year = $_POST['graduate_year'];
$prefecture = $_POST['prefecture'];
$phone = $_POST['phone'];
$email = $_POST['email'];

$sql = "INSERT INTO students (name, name_kana, phone, email, gender, university, faculty, graduate_year, prefecture) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
$stmt = $dbh->prepare($sql);
$stmt->execute([
  $name, $name_kana, $phone, $email, $gender, $university, $faculty, $graduate_year, $prefecture
]);

$lastInsertId = $dbh->lastInsertId();

$sql = "INSERT INTO agents_students (student_id, agent_id) VALUES (?, ?)";
$stmt = $dbh->prepare($sql);
foreach($_SESSION['cart'] as $agent_id){
  $stmt->execute([
    $lastInsertId, $agent_id
  ]);
}

$cart = $_SESSION['cart'];
$sql = "SELECT service_name, email FROM agents where user_id IN (" . implode(',', $cart) . ")";
$stmt = $dbh->prepare($sql);
$stmt->execute();
$data = $stmt->fetchAll();

function send_invitation($email, $subject, $mailBody)
{
  mb_language("Japanese");
  mb_internal_encoding("UTF-8");
  
  $mailToAddress = $email;
  $mailSubject = $subject;
  $mailFromAddress = "boozer@example.jp";
  $mailHeader = "Content-Type: text/plain; charset=UTF-8 \n" .
  "From: " . $mailFromAddress . "\n" .
  "Sender: " . $mailFromAddress . " \n" .
  "Return-Path: " . $mailFromAddress . " \n" .
  "Reply-To: " . $mailFromAddress . " \n" .
  "Content-Transfer-Encoding: BASE64\n";
  
  return mb_send_mail($mailToAddress, $mailSubject, $mailBody, $mailHeader, "-f " . $mailFromAddress);
}

$mailBody = "
この度は、CRAFT 就活エージェント比較サイトからのご申請、誠にありがとうございます。
以下の内容で申請を承りました。
ご確認いただき誤りがございましたら、本日中にご連絡いただきますようよろしくお願いいたします.

—-------------------------------------------------------------------
【申請内容】\n";

foreach($data as $row) {
  $service_name = $row['service_name'];
  $mailBody .= "・{$service_name}\n";
}

$mailBody .= "
【今後の流れ】
本日からおよそ２日〜５日ほどで、ご申請いただいた各企業様からお客様がご登録されたメールアドレスに連絡がございますので、随時ご確認いただきますようお願いいたします。



何かご不明点がございましたら、お気軽にお問合せください。
この度は、CRAFT 就活エージェント比較サイトをご利用いただき、誠にありがとうございます。
またのご利用をお待ちしております。
";
send_invitation($_POST['email'], "申請完了のご連絡", $mailBody);

// 企業に対してもメールを送信する
$sql = "SELECT created_at FROM students WHERE id = ?";
$stmt = $dbh->prepare($sql);
$stmt->execute([$lastInsertId]);
$created_at = $stmt->fetchColumn();
$formatted_date = date('n/j H:i', strtotime($created_at));

$mailBody =  "";
$mailBody.= "{$formatted_date}に、CRAFT 就活エージェント比較サイトから学生が申請を行いました。\n";
$mailBody.= "
http://localhost:8080/client/client-detail-student.php

こちらから、学生の情報をご確認ください。
";

foreach($data as $row) {
  $mail = $row['email'];
  send_invitation($mail, "学生新規登録のご連絡", $mailBody);
}



unset($_SESSION['cart']);
unset($_SESSION['data']);
unset($_SESSION['sort_id']);
unset($_SESSION['toggle_state']);

header('Location: ./student-thanks.php');
exit();
?>