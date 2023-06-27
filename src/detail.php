<?php
session_start();
require_once './detail-logic.php';

if(isset($_SESSION['cart'])){
  $json = json_encode($_SESSION['cart']);
}
?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>企業詳細ページ</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css">
  <link href="../css/output.css" rel="stylesheet">
</head>

<body>
  <header class="fixed w-full bg-white bg-opacity-60 z-10 py-5">
    <form action="./cart-add-logic.php" method="POST" id="myForm">
      <input type="hidden" name="user_id" value="<?= $_GET['id'] ?>">
        <button type="submit" onclick="addToCart(<?= $_GET['id'] ?>)" id="add-to-cart-btn-<?= $_GET['id']?>" class="flex flex-col justify-center items-center bg-[#2E78BA] md:w-1/3 w-2/3 h-16 px-5 py-5 text-[#F2F2F2] rounded-2xl text-xl font-bold shadow-xl mx-auto hover:bg-[#2e5aba]">
          <span class="text-xs text-white">あとでまとめて申請！！</span>
          <div class="flex gap-2 justify-center items-center">
            <span>カートに入れる</span>
            <i class="md:block hidden fas fa-cart-plus fa-lg text-[#F2F2F2] mx-2"></i>
          </div>
        </button>
    </form>
  </header>

  <main class="bg-[#F2F2F2] md:px-56 px-8 py-32">

    <!-- プログレスバー -->
    <div class="max-w-xl mx-auto mt-4 md:mb-12 mb-8 border-b-2 pb-4">
        <div class="flex pb-3">
          <div class="flex-1">
          </div>

          <div class="flex-1">
            <div class="w-10 h-10 bg-green mx-auto rounded-full text-lg text-white flex items-center bg-[#2E78BA]">
              <span class="text-white text-center w-full">
                1
              </span>
            </div>
          </div>


          <div class="w-1/6 align-center items-center align-middle content-center flex">
            <div class="w-full bg-[#DAE4E8] rounded items-center align-middle align-center flex-1">
              <div class="bg-[#2E78BA] w-[40%] text-xs leading-none py-1 text-center text-grey-darkest rounded "></div>
            </div>
          </div>


          <div class="flex-1">
            <div class="w-10 h-10 bg-white border-2 border-grey-light mx-auto rounded-full text-lg text-white flex items-center">
              <span class="text-black text-center w-full">2</span>
            </div>
          </div>

          <div class="w-1/6 align-center items-center align-middle content-center flex ">
            <div class="w-full bg-[#DAE4E8] rounded items-center align-middle align-center flex-1">
              <div class="text-xs leading-none py-1 text-center text-grey-darkest rounded"></div>
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

    <div class="bg-[#e6e3e3] rounded-t-3xl">
      <div class="flex md:flex-row flex-col md:px-16 px-8 py-5 justify-between">
        <div class="flex md:flex-col flex-col gap-2 items-center md:mb-0 mb-4">
          <h1 class="md:text-2xl text-xl font-bold items-center"><?= $agent['service_name'] ?></h1>
          <span class="text-[#979797] md:text-lg text-base"><?= $agent['company_name'] ?></span>
        </div>
        <div class="flex md:flex-row flex-col md:gap-6 gap-2 mb-2">
          <span class="text-md flex md:justify-center justify-start items-center">おすすめ度
          </span>
          <div class="flex justify-center items-center bg-white bg-opacity-50 px-10 py-5 rounded-xl">
            <?php
            $recommend_of_stars = $recommend_rate['rate']; // 5つ星のうち何個星を表示するか
            echo render_stars($recommend_of_stars);
            ?>
          </div>
        </div>
      </div>
    </div>
    <figure class="w-full">
      <img class="object-cover w-full max-h-[340px]" src="./img/<?= $agent['image'] ?>" alt="">
    </figure>
    <div class="bg-[#e6e3e3]">
      <a href="<?= $agent['service_url'] ?>?referral=craft" class="flex justify-end">
        <span class="text-[#6f6f6f] md:text-base text-xs underline hover:no-underline">公式サイトはこちら</span>
      </a>
    </div>
    <div class="bg-[#e6e3e3] md:px-44 px-8 py-5 rounded-b-3xl">
      <div class="flex md:flex-row flex-col md:gap-10 gap-0 justify-between w-full">
        <div class="flex md:gap-8 gap-4 justify-center items-center md:px-10 px-4 py-2 bg-white bg-opacity-80 rounded-xl mb-6">
          <h1 class="md:text-xl tex-lg font-bold">タイプ</h1>
          <div class="py-2 px-4 border border-blue-500 rounded-full shadow"><?= $agent['type'] == 0 ? '総合型' : '特化型' ?></div>
        </div>
        <div class="flex items-center justify-center gap-8 md:px-10 px-4 py-2 bg-white bg-opacity-80 rounded-xl mb-6">
          <h1 class="md:text-xl tex-lg font-bold">オンライン対応</h1>
          <div class="py-2 px-4 border border-blue-500 rounded-full shadow">○</div>
        </div>
        <!-- <?= $agent['area'] ?>&emsp;※オンライン対応可 -->
      </div>
      <div class="flex flex-col md:px-10 px-6 py-2 bg-white bg-opacity-80 rounded-xl mb-6">
        <h1 class="md:text-xl tex-lg font-bold">対応可能エリア</h1>
        <span class="font-lg"><?= $area_names ?></span>
      </div>
      <div class="flex flex-col px-10 py-2 bg-white bg-opacity-80 rounded-xl mb-6">
        <h1 class="md:text-xl tex-lg font-bold">面接会場</h1>
        <span class="font-lg"><?= $agent['interview_location'] ?></span>
      </div>
      <div class="flex flex-col md:px-10 px-4 py-2 bg-white bg-opacity-80 rounded-xl mb-6">
        <h1 class="md:text-xl tex-lg font-bold mb-3">サポートサービス</h1>
        <div class="flex flex-col md:gap-0 gap-4">
          <div class="flex md:flex-row flex-col md:gap-12 gap-4 mb-3 w-full justify-around">
            <div class="py-2 px-4 border border-blue-500 rounded-full shadow text-center">求人力</div>
            <div class="flex justify-center items-center bg-white bg-opacity-50 rounded-xl">
              <?php
              $recommend_of_stars = $recruiting_rate['rate']; // 5つ星のうち何個星を表示するか
              echo render_stars($recommend_of_stars);
              ?>
            </div>
          </div>

          <div class="flex md:flex-row flex-col md:gap-12 gap-4 mb-3 w-full justify-around">
            <div class="py-2 px-4 border border-blue-500 rounded-full shadow text-center">ES対策</div>
            <div class="flex justify-center items-center bg-white bg-opacity-50 rounded-xl">
              <?php
              $recommend_of_stars = $ES_rate['rate']; // 5つ星のうち何個星を表示するか
              echo render_stars($recommend_of_stars);
              ?>
            </div>
          </div>

          <div class="flex md:flex-row flex-col md:gap-10 gap-4 mb-3 w-full justify-around">
            <div class="py-2 px-4 border border-blue-500 rounded-full shadow text-center">面接対策</div>
            <div class="flex justify-center items-center bg-white bg-opacity-50 rounded-xl">
              <?php
              $recommend_of_stars = $interview_rate['rate']; // 5つ星のうち何個星を表示するか
              echo render_stars($recommend_of_stars);
              ?>
            </div>
          </div>
        </div>
      </div>

      <!-- good points -->
      <div class="flex flex-col w-full rounded-xl mb-6">
        <div class="px-10 py-4 bg-[#6EC871] rounded-t-3xl">
          <div class="flex gap-1 items-center justify-center">
            <div class="bg-white rounded-full">
              <i class="fa-solid fa-square-check fa-2xl text-white" style="color: #3dbf0d;"></i>
            </div>
            <h1 class="text-xl text-white font-bold">Good Point</h1>
          </div>
        </div>
        <div class="bg-[#E7FFDC] md:px-10 px-4 md:py-10 pt-10 pb-2 rounded-b-3xl">
          <ul class="flex flex-col">
            <?php
            $count = 1;
            foreach ($good_points as $good_point) {
              $number = '<span class="md:block hidden text-[#11A314] text-xl">①</span>';
              if ($count === 2) {
                $number = '<span class="md:block hidden text-[#11A314] text-xl">②</span>';
              } elseif ($count === 3) {
                $number = '<span class="md:block hidden text-[#11A314] text-xl">③</span>';
              }
            ?>
              <li class="md:text-xl text-lg flex md:items-center font-bold mb-2"> 
                <p class="md:flex hidden text-[#11A314] md:text-xl text-sm"><?= $number ?><?= $good_point['good'] ?></p>
                <p class="md:hidden flex text-[#11A314] md:text-xl text-sm"><span class=" text-[#11A314] text-sm">・</span><?= $good_point['good'] ?></p>
              </li>
                <p class="md:text-sm text-xs mb-8"><?= $good_point['good_detail'] ?></p>
            <?php
              $count++;
            } ?>
          </ul>
        </div>
      </div>

      <!-- bad points -->
      <div class="border-2 border-[#FFA500] px-4 py-4 mb-6 bg-[#FFE0BC]">
        <div class="flex gap-1 items-center justify-center">
          <i class="fa-solid fa-triangle-exclamation md:fa-xl fa-lg" style="color: #FFA500;"></i>
          <h1 class="md:text-xl text-lg text-[#FFA500] font-bold">留意点</h1>
        </div>
        <div class="md:px-10 px-4 py-4 rounded-b-3xl">
          <ul>
            <?php
            $count = 1;
            foreach ($bad_points as $bad_point) {
              $number = '<span class="md:block hidden text-[#000000] text-xl">①</span>';
              if ($count === 2) {
                $number = '<span class="md:block hidden text-[#000000] text-xl">②</span>';
              } elseif ($count === 3) {
                $number = '<span class="md:block hidden text-[#000000] text-xl">③</span>';
              }
            ?>
              <li class="md:text-xl text-lg flex md:items-center mb-2">
                <p class="md:flex hidden text-[#000000] md:text-lg text-xs"><?= $number ?><?= $bad_point['bad'] ?></p>
                <p class="md:hidden flex text-[#000000] md:text-lg text-xs"><span class=" text-black md:text-xl text-xs">・</span><?= $bad_point['bad'] ?></p>
              </li>
            <?php
              $count++;
            } ?>
          </ul>
        </div>
      </div>

      <!-- おすすめの人 -->
      <div class="border-2 border-[#2E78BA] px-4 py-4 mb-6 bg-[#C8E5FF]">
        <div class="flex gap-1 items-center justify-center">
        <i class="fa-solid fa-star md:fa-xl fa-lg" style="color: #2E78BA"></i>
          <h1 class="md:text-xl text-lg text-[#2E78BA] font-bold">おすすめの人</h1>
        </div>
        <div class="md:px-10 px-4 py-4 rounded-b-3xl">
          <ul>
            <?php
            $count = 1;
            foreach ($recommends as $recommend) {
              $number = '<span class="md:block hidden text-[#000000] text-xl">①</span>';
              if ($count === 2) {
                $number = '<span class="md:block hidden text-[#000000] text-xl">②</span>';
              }
            ?>
              <li class="md:text-xl text-lg flex md:items-center mb-2">
                <p class="md:flex hidden text-[#000000] md:text-lg text-xs"><?= $number ?><?= $recommend['recommend'] ?></p>
                <p class="md:hidden flex text-[#000000] md:text-lg text-xs"><span class="text-[#000000] text-xs">・</span><?= $recommend['recommend'] ?></p>
              </li>
            <?php
              $count++;
            } ?>
          </ul>
        </div>
      </div>

  </main>
  <script> 
  var jsonString = '<?php echo $json; ?>';
  var array = JSON.parse(jsonString);
  console.log(array); 
  array.forEach(function(element) {
    var buttonId = 'add-to-cart-btn-' + element;
    var button = document.getElementById(buttonId);
    
    if (button) {
      button.innerHTML = '<span class="text-xs text-white">あとでまとめて申請！！</span>' +
                        '<div class="flex gap-2 justify-center items-center">' +
                        '  <span class="md:text-xl text-base">カートに追加済みです</span>' +
                        '  <i class="md:block hidden mx-2 fa-solid fa-square-check fa-xl text-white" style="color: text-white;"></i>' +
                        '</div>';

      button.classList.remove("hover:bg-[#2e5aba]");
      button.classList.add("bg-[#FF8D06]", "cursor-not-allowed");
      button.disabled = true;
    }
  });
  </script>
</body>

</html>
