<?php
session_start();
require_once './dbconnect.php';
if (!isset($_SESSION['cart'])) {
  header('Location: /');
  exit;
}
$cart = $_SESSION['cart'];

$sql = "SELECT user_id, service_name FROM agents WHERE user_id IN (" . implode(',', $cart) . ")";
$stmt = $dbh->prepare($sql);
$stmt->execute();
$data = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css">
  <link rel="stylesheet" href="./css/output.css" />
  <script src="./script/student-form.js" defer></script>
  <title>個人情報入力</title>
</head>
<body>
  <header class="fixed w-full bg-[#2E78BA] z-10 h-20">
    <div class="relative">
      <div class="flex gap-1 items-center justify-between h-20 px-4">
        <div>
          <a href="/">
            <img class="md:block hidden h-6" src="./img/boozer_logo_white.png" alt="boozer">
          </a>
        </div>
        <div class="md:w-1/3 w-1/2 border-b-2 border-white absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2">
          <h1 class="text-white font-bold text-2xl text-center">CRAFT</h1>
          <p class="text-white text-sm text-center">就活エージェント比較サイト</p>
        </div>
      </div>
    </div>
  </header>
  <main class="md:px-44 px-8 py-32 bg-[#EDF2F7]">
    <div class="mt-50">

      <!-- プログレスバー -->
      <div class="max-w-xl mx-auto my-4 border-b-2 pb-4">
        <div class="flex pb-3">
          <div class="flex-1">
          </div>

          <div class="flex-1">
            <div class="w-10 h-10 bg-green mx-auto rounded-full text-lg text-white flex items-center bg-[#2E78BA]">
              <span class="text-white text-center w-full">
              <i class="fa fa-check w-full fill-current white"></i>
              </span>
            </div>
          </div>


          <div class="w-1/6 align-center items-center align-middle content-center flex">
            <div class="w-full bg-[#DAE4E8] rounded items-center align-middle align-center flex-1">
              <div class="bg-[#2E78BA] w-full text-xs leading-none py-1 text-center text-grey-darkest rounded "></div>
            </div>
          </div>


          <div class="flex-1">
            <div class="w-10 h-10 bg-[#2E78BA] border-2 border-grey-light mx-auto rounded-full text-lg text-white flex items-center">
              <span class="text-white text-center w-full">2</span>
            </div>
          </div>

          <div class="w-1/6 align-center items-center align-middle content-center flex ">
            <div class="w-full bg-[#DAE4E8] rounded items-center align-middle align-center flex-1">
              <div class="bg-[#2E78BA] w-[40%] text-xs leading-none py-1 text-center text-grey-darkest rounded"></div>
            </div>
          </div>

          <div class="flex-1">
            <div class="w-10 h-10 bg-white border-2 border-grey-light mx-auto rounded-full text-lg text-white flex items-center">
              <span class="text-black text-center w-full">3</span>
            </div>
          </div>

          <div class="flex-1">
          </div>
        </div>

        <div class="flex text-xs text-center w-auto md:gap-5 gap-3 md:px-9 px-5">
          <div class="w-1/3">
            比較して<br class="md:hidden block">カートに<br class="md:hidden block">入れる
          </div>

          <div class="w-1/3">
            個人情報入力
          </div>

          <div class="w-1/3">
            申請完了
          </div>

        </div>
      </div>
      <!-- プログレスバー -->

    </div>
  
<div class="w-full max-w-2xl mx-auto my-10">
  <form class="bg-white shadow-md rounded-2xl md:px-32 px-8 pt-10 pb-8 mb-4" action="./student-form-logic.php" method="POST" id="myForm">
    <div class="text-center md:text-2xl text-xl text-[#2E78BA] font-bold mt-4 mb-10">個人情報入力フォーム</div>
    <div class="mb-4">
    <div class="text-gray-700 font-bold mb-2 text-[#2E78BA]">申請するエージェント企業</div>
    <div class="shadow appearance-none border  rounded w-full py-2 px-3 leading-tight bg-[#8CC8FF]" style="border-color: #2E78BA;">
      <?php foreach ($data as $index => $row) { ?>
        <div class="inline-block align-middle text-black">
        <?= $row['service_name'] ?>
      <?php if ($index !== count($data) - 1) { ?>
        ,
      <?php } ?>
        </div>
      <?php } ?>

    </div>

    </div>
    <div class="mb-4">
      <label class="block text-gray-700 text-base font-bold mb-2" for="name">
        お名前
      </label>
      <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="name" name="name" type="text" placeholder="山田太郎">
      <span class="pt-2 text-base text-red-600" style="display: none;">必須項目です</span>
    </div>
    <div class="mb-4">
      <label class="block text-gray-700 text-base font-bold mb-2" for="name_kana">
        フリガナ
      </label>
      <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="name_kana" name="name_kana" type="text" placeholder="ヤマダタロウ">
      <span class="pt-2 text-base text-red-600" style="display: none;">必須項目です</span>
    </div>
    <div class="mb-4">
      <p class="block text-gray-700 text-base font-bold mb-2" for="gender">
        性別
      </p>
      <div class="flex gap-4 mx-3 mb-4 my-2">
        <div>
          <label for="male" class="text-base">
            <input type="radio" name="gender" value="0" id="male" checked>
            男性
          </label>
        </div>
        <div>
          <label for="female" class="text-base">
            <input type="radio" name="gender" value="1" id="female">
            女性
          </label>
        </div>
      </div>
    </div>
    <div class="mb-4">
      <label class="block text-gray-700 text-base font-bold mb-2" for="university">
        学校名
      </label>
      <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="university" name="university" type="text" placeholder="慶應義塾大学">
      <span class="pt-2 text-base text-red-600" style="display: none;">必須項目です</span>
    </div>
    <div class="mb-4">
      <label class="block text-gray-700 text-base font-bold mb-2" for="faculty">
        学部学科名
      </label>
      <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="faculty" name="faculty" type="text" placeholder="法学部政治学科">
      <span class="pt-2 text-base text-red-600" style="display: none;">必須項目です</span>
    </div>
    <div class="mb-4">
      <p class="block text-gray-700 text-base font-bold mb-2">
        卒業年度
      </p>
      <div class="flex gap-4 md:mx-3 mx-0 mb-4 my-2">
        <div>
          <label for="2024" class="text-base">
            <input type="radio" name="graduate_year" value="2024" id="2024" checked>
            2024年
          </label>
        </div>
        <div>
          <label for="2025" class="text-base">
            <input type="radio" name="graduate_year" value="2025" id="2025">
            2025年
          </label>
        </div>
        <div>
          <label for="2026" class="text-base">
            <input type="radio" name="graduate_year" value="2026" id="2026">
            2026年
          </label>
        </div>
      </div>
    </div>
    <div class="mb-4">
      <label class="block text-gray-700 text-base font-bold mb-2" for="prefecture">
        お住まいの地域(都道府県)
      </label>
      <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="prefecture" name="prefecture" type="text" placeholder="東京都">
      <span class="pt-2 text-base text-red-600" style="display: none;">必須項目です</span>
    </div>
    <div class="mb-4">
      <label class="block text-gray-700 text-base font-bold mb-2" for="phone">
        電話番号
      </label>
      <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" maxlength="11" id="phone" name="phone" type="text" placeholder="09012345678">
      <span class="pt-2 text-base text-red-600" style="display: none;">必須項目です</span>
    </div>
    <div class="mb-4">
      <label class="block text-gray-700 text-base font-bold mb-2" for="email">
        メールアドレス
      </label>
      <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" maxlength="255" id="email" name="email" type="text" placeholder="sample@gmail.com">
      <span class="py-2 text-base text-red-600" style="display: none;">必須項目です</span>
    </div>
    <div class="flex items-center mb-4 mt-10 justify-center">
    <input id="checkbox" type="checkbox" class="w-4 h-4">
    <label for="checkbox" class="ml-2 text-md">個人情報の入力に間違いがないことを確認しました</label>
    </div>
    <div class="text-center my-10">
      <!-- <button class="text-xl bg-[#2E78BA] hover:opacity-80 text-white font-bold py-4 px-20 rounded focus:outline-none focus:shadow-outline" type="submit" id="submitButton">登録する</button> -->
      <button id="submitButton" class="text-xl bg-[#2E78BA] opacity-60 text-white font-bold py-4 px-20 rounded focus:outline-none focus:shadow-outline cursor-not-allowed" type="submit" disabled>登録する</button>
    </div>
  </form>
</div>
  </main>
</body>
</html>
