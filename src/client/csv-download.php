<?php
session_start();
include_once '../dbconnect.php';

function createCsv($filename,$header,$records){
  header('Content-Type: application/octet-stream');
  header("Content-Disposition: attachment; filename=$filename.csv");

  mb_convert_variables('SJIS','UTF-8',$header);  
  mb_convert_variables('SJIS','UTF-8',$records);

  $stream = fopen('php://output', 'w');
  fputcsv($stream, $header);
  foreach($records as $record){
    fputcsv($stream, $record);
  }
  exit();
}

$end_at = date('Y/m/d', strtotime($_POST['end_at'] . ' +1 day'));

$sql = "SELECT s.*, a.company_name FROM students s LEFT JOIN agents_students m ON s.id = m.student_id LEFT JOIN agents a ON m.agent_id = a.user_id WHERE a.user_id = :user_id AND m.is_valid = true AND s.created_at >= :start_at AND s.created_at <= :end_at";
$stmt = $dbh->prepare($sql);
$stmt->bindValue(':user_id', $_GET['agent_id'], PDO::PARAM_INT);
$stmt->bindValue(':start_at', $_POST['start_at'], PDO::PARAM_STR);
$stmt->bindValue(':end_at', $end_at, PDO::PARAM_STR);
$stmt->execute();
$students = $stmt->fetchAll(PDO::FETCH_ASSOC);

$sql = "SELECT * FROM agents WHERE user_id = :user_id";
$stmt = $dbh->prepare($sql);
$stmt->bindValue(':user_id', $_GET['agent_id'], PDO::PARAM_INT);
$stmt->execute();
$agent = $stmt->fetch(PDO::FETCH_ASSOC);

if (count($students) == 0) {
  $_SESSION['error_message'] = '該当する学生が存在しません';
  $_SESSION['agent'] = $agent;
  header('Location: ../client/client-admin.php');
  exit();
}else{
  $filename = $students[0]['company_name'] . '_' . $_POST['start_at'] . '_' . $_POST['end_at'] . '_students';
  $header = ['名前(漢字)','名前(カナ)','性別','学校名','学部学科','卒業年度','お住まいの地域','電話番号','メールアドレス'];
  $records = [];
  foreach($students as $student) {
    $phone_number = '"' . $student["phone"] . '"'; 
    $records[] = [$student["name"],$student["name_kana"],$student["gender"]==0?'男性':'女性',$student["university"],$student["faculty"],$student["graduate_year"],$student["prefecture"],$phone_number,$student["email"]];
  }
  createCsv($filename,$header,$records);
}
?>