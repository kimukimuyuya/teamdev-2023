<?php
include_once '../dbconnect.php';

$student_id = $_GET["student_id"];
$agent_id = $_GET["agent_id"];

$sql = "UPDATE agents_students SET is_valid = false WHERE student_id = :id AND agent_id = :agent_id";
$stmt = $dbh->prepare($sql);
$stmt->execute(['id' => $student_id, 'agent_id' => $agent_id]);

// $sql = "SELECT * FROM agents_students WHERE student_id = :id";
// $stmt = $dbh->prepare($sql);
// $stmt->execute(['id' => $student_id]);
// $agent_student = $stmt->fetch(PDO::FETCH_ASSOC);

header('Location: /boozer/detail.php?id=' . $agent_id);
?>