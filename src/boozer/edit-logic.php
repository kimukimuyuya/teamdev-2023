<?php
require_once '../dbconnect.php';

$id = $_POST['id'];

$end_at = isset($_POST['end_at']) && $_POST['end_at'] !== '' ? $_POST['end_at'] : null;
$specialization = isset($_POST['specialization']) && $_POST['specialization'] !== '' ? $_POST['specialization'] : null;
$is_online = isset($_POST['online']) && $_POST['online'] === '1' ? 1 : 0;
$params = [
  'company_name' => $_POST['company_name'],
  'company_url' => $_POST['company_url'],
  'service_name' => $_POST['service_name'],
  'service_url' => $_POST['service_url'],
  'interview_location' => $_POST['interview_location'],
  'specialization' => $specialization,
  'is_online' => $is_online,
  'start_at' => $_POST['start_at'],
  'end_at' => $end_at,
  'email' => $_POST['email'],
  'phone' => $_POST['phone'],
  'id' => $_POST['id'],
];

$set_query = "SET company_name = :company_name, company_url = :company_url, service_name = :service_name, service_url = :service_url, interview_location = :interview_location, specialization = :specialization, is_online = :is_online, start_at = :start_at, end_at = :end_at, email = :email, phone = :phone";
if ($_FILES["image"]["tmp_name"] !== ""){
  $set_query .= ", image = :image";
  $params["image"] = "";
}

$sql = "UPDATE agents $set_query WHERE user_id = :id";

if(isset($params["image"])){
  $image_name = uniqid(mt_rand(), true) . '.' . substr(strrchr($_FILES['image']['name'], '.'), 1);
  $image_path = dirname(__FILE__) . '/../img/' . $image_name;
  move_uploaded_file(
    $_FILES['image']['tmp_name'],
    $image_path
  );
  $params["image"] = $image_name;
}

$stmt = $dbh->prepare($sql);
$stmt->execute($params);

// $sql = "INSERT INTO agents_items (agent_id, sort_id, rate) VALUES (?, ?, ?), (?, ?, ?), (?, ?, ?), (?, ?, ?)";
$sql = "UPDATE agents_items SET rate = ? WHERE agent_id = ? AND sort_id = ?";
$stmt = $dbh->prepare($sql);
$stmt->execute([$_POST['1'], $id, 1]);
$stmt->execute([$_POST['2'], $id, 2]);
$stmt->execute([$_POST['3'], $id, 3]);
$stmt->execute([$_POST['4'], $id, 4]);

$stmt = $dbh->prepare('DELETE FROM agent_good WHERE agent_id = :agent_id');
$stmt->execute([':agent_id' => $id]);
$stmt = $dbh->prepare('INSERT INTO agent_good(agent_id, good, good_detail) VALUES (:agent_id, :good, :good_detail)');
for($i = 0; $i < count($_POST['good']); $i++) {
  $stmt->execute([
    ':agent_id' => $id,
    ':good' => $_POST['good'][$i],
    ':good_detail' => $_POST['good_detail'][$i],
  ]);
}

$stmt = $dbh->prepare('DELETE FROM agent_bad WHERE agent_id = :agent_id');
$stmt->execute([':agent_id' => $id]);
$stmt = $dbh->prepare('INSERT INTO agent_bad(agent_id, bad) VALUES (:agent_id, :bad)');
foreach ($_POST['bad'] as $bad) {
  $stmt->execute([
    ':agent_id' => $id,
    ':bad' => $bad,
  ]);
}

$stmt = $dbh->prepare('DELETE FROM recommend WHERE agent_id = :agent_id');
$stmt->execute([':agent_id' => $id]);
$stmt = $dbh->prepare('INSERT INTO recommend(agent_id, recommend) VALUES (:agent_id, :recommend)');
foreach ($_POST['recommend'] as $recommend) {
  $stmt->execute([
    ':agent_id' => $id,
    ':recommend' => $recommend,
  ]);
}

$stmt = $dbh->prepare('DELETE FROM agents_areas WHERE agent_id = :agent_id');
$stmt->execute([':agent_id' => $id]);
$stmt = $dbh->prepare('INSERT INTO agents_areas (agent_id, area_id) VALUES (:agent_id, :area_id)');
foreach ($_POST['area'] as $area) {
  $stmt->execute([
    ':agent_id' => $id,
    ':area_id' => $area,
  ]);
}

header('Location: /boozer/index.php');



?>
