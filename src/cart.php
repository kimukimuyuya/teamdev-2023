<?php
session_start();
$cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : array();
require_once './cart-logic.php';
?>
<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css">
  <link rel="stylesheet" href="./css/output.css" />
  <title>トップページ</title>
</head>

<body>
  <header class="fixed w-full bg-[#2E78BA] z-10 h-20 top-0 left-0">
    <div class="relative">
      <div class="flex gap-1 items-center justify-between h-20 px-4">
        <div>
          <a href="/">
            <img class="md:block hidden md:h-6 h-5" src="./img/boozer_logo_white.png" alt="boozer">
          </a>
        </div>
        <div class="md:w-1/3 w-1/2 border-b-2 border-white absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2">
          <h1 class="text-white font-bold text-2xl text-center">CRAFT</h1>
          <p class="text-white text-sm text-center">就活エージェント比較サイト</p>
        </div>
      </div>
    </div>
  </header>

  <main class="md:px-44 px-8 py-32 bg-[#F2F2F2] min-h-screen">
    <div class="mt-50">

      <!-- プログレスバー -->
      <div class="max-w-xl mx-auto my-4 border-b-2 pb-4">
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
              <div class="bg-[#2E78BA] w-[80%] text-xs leading-none py-1 text-center text-grey-darkest rounded "></div>
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

    </div>
    <div class="mt-20">
      <!-- 部品 -->
      <?php
      if (count($cart) > 0) {
      ?>
        <div class="text-center md:text-3xl text-2xl text-[#2E78BA] font-bold mt-4 mb-10">カートの中身を確認</div>
        <?php foreach ($data as $key => $row) {
          // サービスごとのおすすめ度を取得
          foreach ($recommend_rates as $rate) {
            if ($rate['user_id'] == $row['user_id']) {
              $row['recommend_rate'] = $rate['rate'];
              break;
            }
          }
          // // サービスごとのエリアを取得
          $user_id = $row['user_id'];
          $row['areas'] = $areas_by_user_id[$user_id];
          $area_names = implode('、', $row['areas']);

          foreach ($good as $agent_good) {
            if ($agent_good['user_id'] == $row['user_id']) {
              $row['good'] = $agent_good['first_good'];
              break;
            }
          }
        ?>
          <div class="mb-4 shadow-lg rounded-3xl">
          <div class="relative <?= $row['type'] == 0 ? 'bg-[#FF8D06]' : 'bg-[#2E78BA]' ?> rounded-3xl p-1">
            <label class="absolute <?= $row['type'] == 0 ? 'bg-[#FF8D06]' : 'bg-[#2E78BA]' ?> rounded-bl-3xl rounded-tr-3xl right-0 md:w-32 w-24 md:h-16 h-12 flex justify-center items-center md:text-xl text-lg text-white" for=""><?= $row['type'] == 0 ? '総合型' : '特化型' ?></label>
            <?php if ($row['type'] == 1) { ?>
              <div class="md:hidden flex h-12 justify-start border-b-[#2E78BA] border-b-4">
                <div class="w-1/2 pt-2 py-1 px-2 text-center text-xl rounded-b-none rounded-t-3xl bg-[rgba(255,255,255,0.6)]"><?= $row['specialization'] ?></div>
              </div>
              <div class="px-8 pb-8 pt-4 grid md:grid-cols-2 grid-cols-1 md:gap-8 gap-0 bg-white bg-opacity-60 md:rounded-3xl rounded-b-3xl rounded-tr-none rounded-tl-none">
            <?php } else { ?>
              <div class="px-8 pb-8 pt-4 grid md:grid-cols-2 grid-cols-1 md:gap-8 gap-0 bg-white bg-opacity-60 rounded-3xl">
            <?php } ?>

              <div class="flex-col">
                <div class="mb-5">
                  <div class="md:flex md:flex-row flex-col gap-2 items-center">
                    <h1 class="md:text-2xl text-xl font-bold items-center">
                      <?= $row['service_name'] ?>
                    </h1>
                    <div class="flex gap-2 items-center justify-between">
                      <span class="text-[#A3A3A3] text-base">
                        <?= $row['company_name'] ?>
                      </span>
                    </div>
                  </div>
                  <p class="md:text-lg text-base font-bold <?= $row['type'] == 0 ? 'text-[#DB2F24]' : 'text-[#5F00D9]'?>"><?= $row['good'] ?></p>
                </div>

                <div class="flex flex-col justify-center items-center">
                  <figure class="max-w-[496px] md:block hidden">
                    <img class="max-h-[171px]" src="./img/<?= $row['image'] ?>" alt="">
                  </figure>
                </div>
              </div>

              <div class="">
                <?php if ($row['type'] == 1) { ?>
                  <div class="md:flex hidden justify-end w-2/3">
                    <div class="w-1/2 py-1 px-4 text-center border-[#2E78BA] border-4  text-xl rounded-full shadow-lg bg-white"><?= $row['specialization'] ?></div>
                  </div>
                <?php } ?>
                <div class="flex md:flex-row flex-col md:gap-16 gap-2 <?= $row['type'] == 0 ? 'md:mt-28' : 'md:mt-9' ?> md:mb-2 mb-3">
                  <span id="labels" class="text-md flex md:justify-center justify-start items-center md:font-normal font-bold">おすすめ度
                  </span>
                  <div id="recommendContent" class="flex justify-center items-center bg-white bg-opacity-50 px-10 py-5 rounded-xl">
                    <?php
                    $recommend_of_stars = $row['recommend_rate']; // 5つ星のうち何個星を表示するか
                    echo render_stars($recommend_of_stars);
                    ?>
                  </div>
                </div>
                <div class="flex md:flex-row flex-col md:gap-5 gap-2 md:items-center">
                  <div class="min-w-3/4 whitespace-nowrap">
                    <span class="text-md md:font-normal font-bold">対応可能エリア</span>
                  </div>
                  <div class="w-auto md:px-6 px-4 py-2 bg-white bg-opacity-50 rounded-xl mb-3">
                    <?= $area_names ?>&emsp;<?= $row['is_online'] ? '※オンライン対応可' : '' ?>
                  </div>
                </div>
                <div class="mt-2 flex md:justify-end justify-end items-center"><a href="./cart-delete-logic.php?id=<?= $row['user_id']; ?>" class="text-[#6f6f6f] text-lg underline hover:no-underline">削除する</a></div>
              </div>
            </div>
          </div>
        </div>
        <?php } ?>
        <div class="flex md:flex-row flex-col items-center justify-around mt-20 md:gap-20 gap-8 md:mx-20 mx-4">
          <a href="./index.php" class="w-full">
            <button class="bg-[#2E78BA] hover:opacity-80 text-white rounded text-lg py-4 w-full">一覧に戻る</button>
          </a>
          <a href="./student-form.php" class="w-full">
            <button class="bg-[#2E78BA] hover:opacity-80 text-white rounded text-lg py-4 w-full">個人情報入力画面へ</button>
          </a>
        </div>
      <?php
      } else {
      ?>
        <div class="flex justify-center items-center">
          <h1 class="mt-20 text-3xl">企業が選択されていません。</h1>
        </div>
        <div class="flex justify-center mt-32">
          <a href="./index.php">
            <button class="bg-[#2E78BA] hover:opacity-80 text-white rounded text-lg px-36 py-4">企業を探す</button>
          </a>
        </div>
      <?php
      }
      ?>
      <!-- 部品 -->
    </div>
  </main>
</body>
