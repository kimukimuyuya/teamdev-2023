<?php
require_once './dbconnect.php';
require_once './index-logic.php';

$sql = "SELECT * FROM agents WHERE user_id = :user_id AND agents.is_valid = true";
$stmt = $dbh->prepare($sql);
$stmt->bindValue(':user_id', $_GET['id'], PDO::PARAM_INT);
$stmt->execute();
$agent = $stmt->fetch(PDO::FETCH_ASSOC);

// おすすめ度を取得
$sql = "SELECT a.user_id, ai.rate FROM agents a
        INNER JOIN agents_items ai ON a.user_id = ai.agent_id
        WHERE a.user_id = :user_id AND ai.sort_id = 1;
      ";
$stmt = $dbh->prepare($sql);
$stmt->bindValue(':user_id', $_GET['id'], PDO::PARAM_INT);
$stmt->execute();
$recommend_rate = $stmt->fetch(PDO::FETCH_ASSOC);

// areasからデータを取得する
$sql = "SELECT agents.user_id, areas.area
        FROM agents_areas
        INNER JOIN agents ON agents_areas.agent_id = agents.user_id
        INNER JOIN areas ON agents_areas.area_id = areas.id
        WHERE agents.user_id = :user_id AND agents.is_valid = true;
      ";
$stmt = $dbh->prepare($sql);
$stmt->bindValue(':user_id', $_GET['id'], PDO::PARAM_INT);
$stmt->execute();
$areas = $stmt->fetchAll(PDO::FETCH_ASSOC);

// 取得した$areasを句読点で区切って表示する
$area_names = array_column($areas, 'area');
$area_names = implode('、', $area_names);

// 求人力を取得
$sql = "SELECT a.user_id, ai.rate FROM agents a
        INNER JOIN agents_items ai ON a.user_id = ai.agent_id
        WHERE a.user_id = :user_id AND ai.sort_id = 2 AND a.is_valid = true;
      ";
$stmt = $dbh->prepare($sql);
$stmt->bindValue(':user_id', $_GET['id'], PDO::PARAM_INT);
$stmt->execute();
$recruiting_rate = $stmt->fetch(PDO::FETCH_ASSOC);

// ES添削を取得
$sql = "SELECT a.user_id, ai.rate FROM agents a
        INNER JOIN agents_items ai ON a.user_id = ai.agent_id
        WHERE a.user_id = :user_id AND ai.sort_id = 3 AND a.is_valid = true;
      ";
$stmt = $dbh->prepare($sql);
$stmt->bindValue(':user_id', $_GET['id'], PDO::PARAM_INT);
$stmt->execute();
$ES_rate = $stmt->fetch(PDO::FETCH_ASSOC);

// 面接対策を取得
$sql = "SELECT a.user_id, ai.rate FROM agents a
        INNER JOIN agents_items ai ON a.user_id = ai.agent_id
        WHERE a.user_id = :user_id AND ai.sort_id = 4 AND a.is_valid = true;
      ";
$stmt = $dbh->prepare($sql);
$stmt->bindValue(':user_id', $_GET['id'], PDO::PARAM_INT);
$stmt->execute();
$interview_rate = $stmt->fetch(PDO::FETCH_ASSOC);

// good pointsを取得
$sql = "SELECT a.user_id, ag.good, ag.good_detail FROM agents a
        INNER JOIN agent_good ag ON a.user_id = ag.agent_id
        WHERE a.user_id = :user_id AND a.is_valid = true;
      ";
$stmt = $dbh->prepare($sql);
$stmt->bindValue(':user_id', $_GET['id'], PDO::PARAM_INT);
$stmt->execute();
$good_points = $stmt->fetchAll(PDO::FETCH_ASSOC);

// bad pointsを取得
$sql = "SELECT a.user_id, ab.bad FROM agents a
        INNER JOIN agent_bad ab ON a.user_id = ab.agent_id
        WHERE a.user_id = :user_id AND a.is_valid = true;
      ";
$stmt = $dbh->prepare($sql);
$stmt->bindValue(':user_id', $_GET['id'], PDO::PARAM_INT);
$stmt->execute();
$bad_points = $stmt->fetchAll(PDO::FETCH_ASSOC);

// recommendを取得
$sql = "SELECT a.user_id, r.recommend FROM agents a
        INNER JOIN recommend r ON a.user_id = r.agent_id
        WHERE a.user_id = :user_id AND a.is_valid = true;
      ";
$stmt = $dbh->prepare($sql);
$stmt->bindValue(':user_id', $_GET['id'], PDO::PARAM_INT);
$stmt->execute();
$recommends = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
