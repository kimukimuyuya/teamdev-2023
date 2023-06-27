<?php
session_start();
require_once './dbconnect.php';
if(isset($_POST['toggle_state'])){
    $_SESSION['toggle_state'] = $_POST['toggle_state'];
} else if(isset($_SESSION['sort_id'])) {
    $_SESSION['toggle_state'] = $_SESSION['toggle_state'];
} else {
    $_SESSION['toggle_state'] = 'comprehensive';
}

if(isset($_POST['sort_id'])){
    $_SESSION['sort_id'] = $_POST['sort_id'];
} else if(isset($_SESSION['sort_id'])) {
    $_SESSION['sort_id'] = $_SESSION['sort_id'];
} else {
    $_SESSION['sort_id'] = 1;
}

if($_SESSION['toggle_state'] == 'specialized'){
        $sql = "SELECT a.user_id, a.company_name, a.service_name, a.image, a.service_url, a.type, a.is_online, a.specialization, ai.rate FROM agents a
        INNER JOIN agents_items ai ON a.user_id = ai.agent_id
        WHERE a.is_valid = true AND ai.sort_id = :sort_id AND a.type = 1 AND a.start_at <= NOW()
        GROUP BY a.user_id, ai.rate
        ORDER BY ai.rate DESC;
        ";
        $stmt = $dbh->prepare($sql);
        $stmt->bindValue(':sort_id', $_SESSION['sort_id'], PDO::PARAM_INT);
        $stmt->execute();
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
}else if($_SESSION['toggle_state'] == 'comprehensive'){
        $sql = "SELECT a.user_id, a.company_name, a.service_name, a.image, a.service_url, a.type, a.is_online, a.specialization, ai.rate FROM agents a
        INNER JOIN agents_items ai ON a.user_id = ai.agent_id
        WHERE a.is_valid = true AND ai.sort_id = :sort_id AND a.type = 0 AND a.start_at <= NOW()
        GROUP BY a.user_id, ai.rate
        ORDER BY ai.rate DESC;
        ";
        $stmt = $dbh->prepare($sql);
        $stmt->bindValue(':sort_id', $_SESSION['sort_id'], PDO::PARAM_INT);
        $stmt->execute();
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
}

$_SESSION['data'] = $data;
header('Location: index.php');
exit;
