<?php
// データベースから企業情報を取得
require_once './dbconnect.php';


// クエリを実行してデータを取得する
if (!empty($cart)) {
$sql = "SELECT user_id, company_name, service_name, image, service_url, type, is_online, specialization FROM agents where user_id IN (" . implode(',', $cart) . ")";
$stmt = $dbh->prepare($sql);
$stmt->execute();
$data = $stmt->fetchAll();
// agents_itemsからデータを取得する(おすすめ度)
$sql = "SELECT a.user_id, ai.rate FROM agents a
        INNER JOIN agents_items ai ON a.user_id = ai.agent_id
        WHERE  ai.sort_id = 1 AND a.user_id IN (" . implode(',', $cart) . ")
        GROUP BY a.user_id, ai.rate;
      ";
$stmt = $dbh->prepare($sql);
$stmt->execute();
$recommend_rates = $stmt->fetchAll(PDO::FETCH_ASSOC);

// areasからデータを取得する
$sql = "SELECT agents.user_id, areas.area
        FROM agents_areas
        INNER JOIN agents ON agents_areas.agent_id = agents.user_id
        INNER JOIN areas ON agents_areas.area_id = areas.id
        WHERE agents.user_id IN (" . implode(',', $cart) . ")
        ORDER BY areas.id;
      ";
$stmt = $dbh->prepare($sql);
$stmt->execute();
$areas = $stmt->fetchAll(PDO::FETCH_ASSOC);

// user_idごとのエリアを配列に格納する
$areas_by_user_id = array();
foreach ($areas as $area) {
    $user_id = $area['user_id'];
    $area_name = $area['area'];
    if (!array_key_exists($user_id, $areas_by_user_id)) {
        $areas_by_user_id[$user_id] = array();
    }
    array_push($areas_by_user_id[$user_id], $area_name);
}

// agents_goodからデータを取得する
$sql = "SELECT a.user_id, SUBSTRING_INDEX(GROUP_CONCAT(ag.good ORDER BY ag.id), ',', 1) as first_good
        FROM agents a
        INNER JOIN agent_good ag ON a.user_id = ag.agent_id
        WHERE a.user_id IN (" . implode(',', $cart) . ")
        GROUP BY a.user_id;
      ";
$stmt = $dbh->prepare($sql);
$stmt->execute();
$good = $stmt->fetchAll(PDO::FETCH_ASSOC);
}



// 星を描画する関数
function render_stars($number_of_stars)
{
  $star_html = '';
  for ($i = 0; $i < $number_of_stars; $i++) {
    $star_html .= '<i class="fa-sharp fa-solid fa-star fa-xl" style="color: #f2d307;"></i>';
  }
  for ($i = 0; $i < 5 - $number_of_stars; $i++) {
    $star_html .= '<i class="fa-sharp fa-solid fa-star fa-xl" style="color: #8a8a8a;"></i>';
  }
  return $star_html;
}
?>
