<?php
session_start();
if (!isset($_SESSION['admin'])) {
  header('Location: ../auth/login.php');
  exit();
}
?>
<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>エージェント企業情報登録フォーム</title>
  <link href="../css/output.css" rel="stylesheet">
  <script src="../script/agent-form.js" defer></script>
</head>

<body class="bg-gray-100">
  <div class="container mx-auto py-6">
    <h1 class="text-2xl font-bold mb-6">エージェント企業情報登録フォーム</h1>
    <form action="agent-form-logic.php" method="POST" enctype="multipart/form-data">

      <div class="mb-4">
        <label class="block text-gray-700 font-bold mb-2" for="company_name">運営会社名</label>
        <input class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="company_name" name="company_name" type="text" placeholder="運営会社名" required>
      </div>

      <div class="mb-4">
        <label class="block text-gray-700 font-bold mb-2" for="company_url">運営会社url</label>
        <input class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="company_url" name="company_url" type="text" placeholder="運営会社url" required>
      </div>

      <div class="mb-4">
        <label class="block text-gray-700 font-bold mb-2" for="service_name">サービス名</label>
        <input class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="service_name" name="service_name" type="text" placeholder="サービス名" required>
      </div>

      <div class="mb-4">
        <label class="block text-gray-700 font-bold mb-2" for="service_url">サービスurl</label>
        <input class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="service_url" name="service_url" type="text" placeholder="サービスurl" required>
      </div>

      <div class="mb-4">
        <label class="block text-gray-700 font-bold mb-2" for="image">画像</label>
        <input class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="image" name="image" type="file" placeholder="画像" required>
      </div>

      <div class="mb-4">
        <label class="block text-gray-700 font-bold mb-2" for="interview_location">面接会場</label>
        <input class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="interview_location" name="interview_location" type="text" placeholder="北海道、青森、東京、......" required>
      </div>

      <div class="mb-4">
        <h2 class="block text-gray-700 font-bold mb-2">対応可能エリア</h2>
        <input type="checkbox" name="area[]" id="area1" value="1" class="mr-1" checked><label for="area1" class="text-md mr-3">全国</label>
        <input type="checkbox" name="area[]" id="area2" value="2" class="mr-1"><label for="area2" class="text-md mr-3">北海道地方</label>
        <input type="checkbox" name="area[]" id="area3" value="3" class="mr-1"><label for="area3" class="text-md mr-3">東北地方</label>
        <input type="checkbox" name="area[]" id="area4" value="4" class="mr-1"><label for="area4" class="text-md mr-3">関東地方</label>
        <input type="checkbox" name="area[]" id="area5" value="5" class="mr-1"><label for="area5" class="text-md mr-3">中部地方</label>
        <input type="checkbox" name="area[]" id="area6" value="6" class="mr-1"><label for="area6" class="text-md mr-3">関西地方</label>
        <input type="checkbox" name="area[]" id="area7" value="7" class="mr-1"><label for="area7" class="text-md mr-3">中国地方</label>
        <input type="checkbox" name="area[]" id="area8" value="8" class="mr-1"><label for="area8" class="text-md mr-3">四国地方</label>
        <input type="checkbox" name="area[]" id="area9" value="9" class="mr-1"><label for="area9" class="text-md mr-3">九州地方・沖縄</label>
      </div>

      <label class="block text-gray-700 font-bold mb-2" for="type">総合or特化</label>
      <div class="flex gap-4 mt-2.5 mb-4 my-2">
        <div>
          <label for="comprehensive" class="text-md">
            <input type="radio" name="type" value="0" id="comprehensive" checked>
            総合型
          </label>
        </div>
        <div>
          <label for="specialized" class="text-md">
            <input type="radio" name="type" value="1" id="specialized">
            特化型
          </label>
        </div>
      </div>

      <div class="mb-4 hidden" id="specialized_field">
        <label class="block text-gray-700 font-bold mb-2" for="specialization">何に特化しているのか</label>
        <input class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="specialization" name="specialization" type="text" placeholder="体育会系、IT系">
      </div>

      <label class="block text-gray-700 font-bold mb-2" for="online">オンライン対応</label>
      <div class="flex gap-4 mt-2.5 mb-4 my-2">
        <div>
          <label for="possible" class="text-md">
            <input type="radio" name="online" value="1" id="possible" checked>
            可
          </label>
        </div>
        <div>
          <label for="impossible" class="text-md">
            <input type="radio" name="online" value="0" id="impossible">
            不可
          </label>
        </div>
      </div>

      <div class="mb-4">
        <label class="block text-gray-700 font-bold mb-2" for="">おすすめ度</label>
        <select class="block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" name="evaluation">
          <option value="1">1</option>
          <option value="2">2</option>
          <option value="3">3</option>
          <option value="4">4</option>
          <option value="5">5</option>
        </select>
      </div>
      <div class="mb-4">
        <label class="block text-gray-700 font-bold mb-2" for="">求人力</label>
        <select class="block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" name="recruiting">
          <option value="1">1</option>
          <option value="2">2</option>
          <option value="3">3</option>
          <option value="4">4</option>
          <option value="5">5</option>
        </select>
      </div>
      <div class="mb-4">
        <label class="block text-gray-700 font-bold mb-2" for="">ES添削</label>
        <select class="block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" name="ES">
          <option value="1">1</option>
          <option value="2">2</option>
          <option value="3">3</option>
          <option value="4">4</option>
          <option value="5">5</option>
        </select>
      </div>

      <div class="mb-4">
        <label class="block text-gray-700 font-bold mb-2" for="">面接対策</label>
        <select class="block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" name="interview">
          <option value="1">1</option>
          <option value="2">2</option>
          <option value="3">3</option>
          <option value="4">4</option>
          <option value="5">5</option>
        </select>
      </div>

      <div class="mb-4">
        <label class="block text-gray-700 font-bold mb-2" for="good_point">goodポイント</label>
        <div class="grid grid-rows-3 gap-4">
          <input type="text" name="good[]" class="py-2 px-3 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500" placeholder="1." required>
          <input type="text" name="good_detail[]" class="py-2 px-3 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500" placeholder="1の詳細な説明" required>
          <input type="text" name="good[]" class="py-2 px-3 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500" placeholder="2." required>
          <input type="text" name="good_detail[]" class="py-2 px-3 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500" placeholder="2の詳細な説明" required>
          <input type="text" name="good[]" class="py-2 px-3 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500" placeholder="3." required>
          <input type="text" name="good_detail[]" class="py-2 px-3 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500" placeholder="3の詳細な説明" required>
        </div>
      </div>

      <div class="mb-4">
        <label class="block text-gray-700 font-bold mb-2" for="bad_point">badポイント</label>
        <div class="grid grid-rows-3 gap-4">
          <input type="text" name="bad[]" class="py-2 px-3 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500" placeholder="1." required>
          <input type="text" name="bad[]" class="py-2 px-3 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500" placeholder="2." required>
          <input type="text" name="bad[]" class="py-2 px-3 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500" placeholder="3." required>
        </div>
      </div>

      <div class="mb-4">
        <label class="block text-gray-700 font-bold mb-2" for="recommend">おすすめの人</label>
        <div class="grid grid-rows-2 gap-4">
          <input type="text" name="recommend[]" class="py-2 px-3 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500" placeholder="1." required>
          <input type="text" name="recommend[]" class="py-2 px-3 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500" placeholder="2." required>
        </div>
      </div>

      <div class="mb-4 flex">
        <div class="mr-4">
          <label class="block text-gray-700 font-bold mb-2" for="start_at">開始日</label>
          <input class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="start_at" name="start_at" type="date" placeholder="開始日" required>
        </div>
        <div>
          <label class="block text-gray-700 font-bold mb-2" for="end_at">終了日</label>
          <input class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="end_at" name="end_at" type="date" placeholder="終了日">
        </div>
      </div>

      <div class="mb-4">
        <label class="block text-gray-700 font-bold mb-2" for="email">メールアドレス</label>
        <input class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="email" name="email" type="email" placeholder="sample@gmail.com" required>
      </div>

      <div class="mb-4">
        <label class="block text-gray-700 font-bold mb-2" for="phone">電話番号</label>
        <input class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="phone" name="phone" type="phone" placeholder="012-345-6789" required>
      </div>

      <div class="flex justify-end">
        <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">登録</button>
      </div>
    </form>

  </div>
</body>

</html>