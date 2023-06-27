<?php
session_start();
include_once '../dbconnect.php';

if (!isset($_SESSION['admin'])) {
  header('Location: ../auth/login.php');
  exit();
}

$sql = "SELECT * FROM agents WHERE user_id = :id";
$stmt = $dbh->prepare($sql);
$stmt->bindValue(':id', $_GET['id'], PDO::PARAM_INT);
$stmt->execute();
$agent = $stmt->fetch(PDO::FETCH_ASSOC);

$sql = "SELECT * FROM agents_items WHERE agent_id = :id";
$stmt = $dbh->prepare($sql);
$stmt->bindValue(':id', $_GET['id'], PDO::PARAM_INT);
$stmt->execute();
$items = $stmt->fetchAll(PDO::FETCH_ASSOC);

$sql = "SELECT * FROM agent_good WHERE agent_id = :id";
$stmt = $dbh->prepare($sql);
$stmt->bindValue(':id', $_GET['id'], PDO::PARAM_INT);
$stmt->execute();
$goods = $stmt->fetchAll(PDO::FETCH_ASSOC);

$sql = "SELECT * FROM agent_bad WHERE agent_id = :id";
$stmt = $dbh->prepare($sql);
$stmt->bindValue(':id', $_GET['id'], PDO::PARAM_INT);
$stmt->execute();
$bads = $stmt->fetchAll(PDO::FETCH_ASSOC);

$sql = "SELECT * FROM recommend WHERE agent_id = :id";
$stmt = $dbh->prepare($sql);
$stmt->bindValue(':id', $_GET['id'], PDO::PARAM_INT);
$stmt->execute();
$recommends = $stmt->fetchAll(PDO::FETCH_ASSOC);

$sql = "SELECT * FROM agents_areas WHERE agent_id = :id";
$stmt = $dbh->prepare($sql);
$stmt->bindValue(':id', $_GET['id'], PDO::PARAM_INT);
$stmt->execute();
$areas = $stmt->fetchAll(PDO::FETCH_ASSOC);

$sql = "SELECT * FROM areas";
$stmt = $dbh->prepare($sql);
$stmt->execute();
$all_areas = $stmt->fetchAll(PDO::FETCH_ASSOC);

$sql = "SELECT * FROM sort_items";
$stmt = $dbh->prepare($sql);
$stmt->execute();
$sort_items = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>編集画面</title>
  <link href="../css/output.css" rel="stylesheet">
</head>

<body class="bg-gray-100">
  <div class="container mx-auto py-6">
    <h1 class="text-2xl font-bold mb-6">エージェント企業情報編集</h1>
    <form action="./edit-logic.php" method="POST" enctype="multipart/form-data">

      <div class="mb-4">
        <label class="block text-gray-700 font-bold mb-2" for="company_name">運営会社名</label>
        <input class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="company_name" name="company_name" type="text" placeholder="運営会社名" value="<?= $agent["company_name"]; ?>" required>
      </div>

      <div class="mb-4">
        <label class="block text-gray-700 font-bold mb-2" for="company_url">運営会社url</label>
        <input class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="company_url" name="company_url" type="text" placeholder="運営会社url" value="<?= $agent["company_url"]; ?>" required>
      </div>

      <div class="mb-4">
        <label class="block text-gray-700 font-bold mb-2" for="service_name">サービス名</label>
        <input class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="service_name" name="service_name" type="text" placeholder="サービス名" value="<?= $agent["service_name"]; ?>" required>
      </div>

      <div class="mb-4">
        <label class="block text-gray-700 font-bold mb-2" for="service_url">サービスurl</label>
        <input class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="service_url" name="service_url" type="text" placeholder="サービスurl" value="<?= $agent["service_url"]; ?>" required>
      </div>

      <div class="mb-4">
        <label class="block text-gray-700 font-bold mb-2" for="image">画像</label>
        <input class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="image" name="image" type="file" placeholder="画像">
      </div>

      <div class="mb-4">
        <label class="block text-gray-700 font-bold mb-2" for="interview_location">面接会場</label>
        <input class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="interview_location" name="interview_location" type="text" placeholder="北海道、青森、東京、......" value="<?= $agent["interview_location"]; ?>" required>
      </div>

      <div class="mb-4">
        <h2 class="block text-gray-700 font-bold mb-2">対応可能エリア</h2>
        <?php foreach ($all_areas as $key => $all_area) { ?>
          <input type="checkbox" name="area[]" id="area<?= $all_area["id"]; ?>" value="<?= $key +  1; ?>" class="mr-1" 
          <?php foreach ($areas as $area) {
            if ($area["area_id"] === $key + 1) {
              echo 'checked';
            }
          } ?>><label for="area<?= $all_area["id"]; ?>" class="text-md mr-3"><?= $all_area["area"]; ?></label>
        <?php } ?>
      </div>


      <label class="block text-gray-700 font-bold mb-2" for="type">総合or特化</label>
      <div class="flex gap-4 mt-2.5 mb-4 my-2">
        <div>
          <label for="comprehensive" class="text-md">
            <input type="radio" name="type" value="0" id="comprehensive" <?= $agent["type"] == 0 ? 'checked' : '' ?> disabled>
            総合型
          </label>
        </div>
        <div>
          <label for="specialized" class="text-md">
            <input type="radio" name="type" value="1" id="specialized" <?= $agent["type"] == 1 ? 'checked' : '' ?> disabled>
            特化型
          </label>
        </div>
      </div>

      <?php if ($agent["specialization"]) { ?>
        <div class="mb-4">
          <label class="block text-gray-700 font-bold mb-2" for="specialization">何に特化しているのか</label>
          <input class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="specialization" name="specialization" type="text" placeholder="体育会系、IT系" value="<?= $agent["specialization"]; ?>">
        </div>
      <?php } ?>

      <label class="block text-gray-700 font-bold mb-2" for="type">オンライン対応</label>
      <div class="flex gap-4 mt-2.5 mb-4 my-2">
        <div>
          <label for="possible" class="text-md">
            <input type="radio" name="online" value="1" id="possible" <?= $agent["is_online"] == 1 ? 'checked' : '' ?>>
            可
          </label>
        </div>
        <div>
          <label for="impossible" class="text-md">
            <input type="radio" name="online" value="0" id="impossible" <?= $agent["is_online"] == 0 ? 'checked' : '' ?>>
            不可
          </label>
        </div>
      </div>

      <?php for ($i = 0; $i < 4; $i++) { ?>
        <div class="mb-4">
          <label class="block text-gray-700 font-bold mb-2" for=""><?= $sort_items[$i]["sort_item"]; ?></label>
          <select class="block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" name="<?= $i + 1 ?>">
            <?php for ($j = 1; $j <= 5; $j++) { ?>
              <?php if ($j == $items[$i]['rate']) { ?>
                <option value="<?= $j ?>" selected><?= $j ?></option>
              <?php } else { ?>
                <option value="<?= $j ?>"><?= $j ?></option>
              <?php } ?>
            <?php } ?>
          </select>
        </div>
      <?php } ?>

      <div class="mb-4">
        <label class="block text-gray-700 font-bold mb-2" for="good_point">goodポイント</label>
        <div class="grid grid-rows-3 gap-4">
          <?php for ($i = 0; $i < 3; $i++) { ?>
            <input type="text" name="good[]" class="py-2 px-3 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500" value="<?= $goods[$i]["good"] ?>" required>
          <?php } ?>
        </div>
      </div>

      <div class="mb-4">
        <label class="block text-gray-700 font-bold mb-2" for="good_point">goodポイントの詳細な情報</label>
        <div class="grid grid-rows-3 gap-4">
          <?php for ($i = 0; $i < 3; $i++) { ?>
            <input type="text" name="good_detail[]" class="py-2 px-3 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500" value="<?= $goods[$i]["good_detail"] ?>" required>
          <?php } ?>
        </div>
      </div>

      <div class="mb-4">
        <label class="block text-gray-700 font-bold mb-2" for="bad_point">badポイント</label>
        <div class="grid grid-rows-3 gap-4">
          <?php foreach ($bads as $bad) { ?>
            <input type="text" name="bad[]" class="py-2 px-3 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500" value="<?= $bad["bad"] ?>" required>
          <?php } ?>
        </div>
      </div>

      <div class="mb-4">
        <label class="block text-gray-700 font-bold mb-2" for="recommend">おすすめの人</label>
        <div class="grid grid-rows-2 gap-4">
          <?php foreach ($recommends as $recommend) { ?>
            <input type="text" name="recommend[]" class="py-2 px-3 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500" value="<?= $recommend["recommend"] ?>" required>
          <?php } ?>
        </div>
      </div>

      <div class="mb-4 flex">
        <div class="mr-4">
          <label class="block text-gray-700 font-bold mb-2" for="start_at">開始日</label>
          <input class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="start_at" name="start_at" type="date" placeholder="開始日" value="<?= $agent["start_at"]; ?>" required>
        </div>
        <div>
          <label class="block text-gray-700 font-bold mb-2" for="end_at">終了日</label>
          <input class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="end_at" name="end_at" type="date" placeholder="終了日" value="<?= $agent["end_at"]; ?>">
        </div>
      </div>

      <div class="mb-4">
        <label class="block text-gray-700 font-bold mb-2" for="email">メールアドレス</label>
        <input class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="email" name="email" type="email" placeholder="" value="<?= $agent["email"]; ?>" required>
      </div>

      <div class="mb-4">
        <label class="block text-gray-700 font-bold mb-2" for="phone">電話番号</label>
        <input class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="phone" name="phone" type="phone" placeholder="" value="<?= $agent["phone"]; ?>" required>
      </div>

      <input type="hidden" name="id" value="<?= $_GET["id"] ?>">

      <div class="flex justify-end">
        <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">変更</button>
      </div>
    </form>

  </div>
</body>

</html>