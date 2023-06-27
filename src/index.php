<?php
session_start();
require_once './index-logic.php';
if (isset($_SESSION['data'])) {
  $data = $_SESSION['data'];
}

if (isset($_SESSION['cart'])) {
  $json = json_encode($_SESSION['cart']);
} else {
  $json = json_encode(array());
}

if (isset($_SESSION['toggle_state'])) {
  $toggle_state = json_encode($_SESSION['toggle_state']);
} else {
  $toggle_state = json_encode(array());
}


if (isset($_SESSION['sort_id'])) {
  $sort_id = json_encode($_SESSION['sort_id']);
} else {
  $sort_id = json_encode(array());
}
?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css">
  <link rel="stylesheet" href="./css/output.css" />
  <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous" defer></script>
  <script src="./script/sort.js" defer></script>
  <script src="./script/scroll.js" defer></script>
  <title>トップページ</title>
</head>

<body>
  <header class="fixed w-full bg-[#2E78BA] z-20 h-20 top-0 left-0">
    <div class="flex gap-1 items-center justify-between h-20 px-4">
      <a href="/">
        <img class="md:block hidden md:h-6 h-5" src="./img/boozer_logo_white.png" alt="boozer">
      </a>
      <div class="md:w-1/3 w-1/2 border-b-2 border-white items-center">
        <h1 class="text-white font-bold text-2xl text-center">CRAFT</h1>
        <p class="text-white md:text-sm text-xs text-center">就活エージェント比較サイト</p>
      </div>
      <div>
        <button class="btn flex items-center bg-primary rounded px-3.5 py-3 md:px-8 md:py-4  inquiry-cta">
          <a href="./cart.php">
            <span class="">
              <span class="text-2xl">
                <i class="fas fa-cart-plus fa-lg text-white"></i>
              </span>
              <div class="absolute top-1 md:right-9 right-2 w-8 bg-[#f09d51] py-[5px] rounded-full text-white" id="cart-items">0</div>
              <p class="text-white text-xs">申し込み</p>
            </span>
          </a>
        </button>
      </div>
    </div>
  </header>

  <main class="md:px-44 px-8 py-32 bg-[#F2F2F2]">
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

      <div class="flex md:flex-row flex-col md:gap-40 gap-8 md:justify-center mb-10 items-center">
        <form action="./sort-items.php" method="POST" id="toggleForm" class="flex items-center justify-center gap-2 mt-2">
          <input type="hidden" name="toggle_state" id="toggleState" value="">
          <div>
            <div class="relative mx-2 shadow-xl">
              <div class="bg-gray-200 text-[#2E78BA] font-bold md:text-base text-xs rounded py-1 md:px-4 px-2 right-0 bottom-full border-2 border-[#2E78BA] text-center">
                どの業界にも対応
                <svg class="absolute text-[#2E78BA] h-2 w-full left-0 top-full" x="0px" y="0px" viewBox="0 0 255 255" xml:space="preserve">
                  <polygon class="fill-current" points="0,0 127.5,127.5 255,0" />
                </svg>
              </div>
            </div>
            <p class="font-medium text-lg text-center mt-1">総合型</p>
          </div>
          <div>
            <label class="relative inline-flex items-center cursor-pointer">
              <input type="checkbox" value="" class="sr-only peer" id="toggleButton">
              <div class="w-20 h-10 bg-[#FF8D06] peer-focus:outline-none rounded-full dark:bg-gray-700 peer-checked:after:translate-x-full after:content-[''] after:absolute after:top-[4px] after:left-[8px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-8 after:w-8 after:transition-all dark:border-gray-600 peer-checked:bg-[#2E78BA]"></div>
            </label>
          </div>
          <div>
            <div class="relative mx-2 shadow-xl">
              <div class="bg-gray-200 text-[#2E78BA] font-bold md:text-base text-xs rounded py-1 md:px-4 px-2 right-0 bottom-full border-2 border-[#2E78BA] text-center">
                ある業界に特化
                <svg class="absolute text-[#2E78BA] h-2 w-full left-0 top-full" x="0px" y="0px" viewBox="0 0 255 255" xml:space="preserve">
                  <polygon class="fill-current" points="0,0 127.5,127.5 255,0" />
                </svg>
              </div>
            </div>
            <p class="font-medium text-lg text-center mt-1">特化型</p>
          </div>
        </form>

        <!-- 並び替えボタン -->
        <div id="accordionPanel" class="relative">
          <button id="toggleAccordion" class="w-50 px-10 py-5 bg-[#2E78BA] rounded-lg text-white h-12 flex md:justify-center md:mx-0 mx-auto md:my-0 my-2 items-center">並び替え<i class="fa-solid fa-caret-down fa-xl mx-2" id="icon"></i></button>
          <div id="accordion" class="hidden absolute z-10 rounded-md w-full">
            <form action="./sort-items.php" method="POST">
              <input type="hidden" name="sort_id" value="1">
              <button type="submit" id="recommendButton" class="w-full px-4 py-3 text-center border-2 hover:bg-[#C2DFFF] border-[#CCCCCC] bg-[#F2F2F2] mt-0.5">おすすめ度</button>
            </form>
            <form action="./sort-items.php" method="POST">
              <input type="hidden" name="sort_id" value="2">
              <button type="submit" id="recruitingButton" class="w-full px-4 py-3 text-center border-2 hover:bg-[#C2DFFF] border-[#CCCCCC] bg-[#F2F2F2] mt-0.5">求人力</button>
            </form>
            <form action="./sort-items.php" method="POST">
              <input type="hidden" name="sort_id" value="3">
              <button type="submit" id="esButton" class="w-full px-4 py-3 text-center border-2 hover:bg-[#C2DFFF] border-[#CCCCCC] bg-[#F2F2F2] mt-0.5">ES添削</button>
            </form>
            <form action="./sort-items.php" method="POST">
              <input type="hidden" name="sort_id" value="4">
              <button type="submit" id="interviewButton" class="w-full px-4 py-3 text-center border-2 hover:bg-[#C2DFFF] border-[#CCCCCC] bg-[#F2F2F2] mt-0.5">面接対策</button>
            </form>
          </div>
        </div>
      </div>


      <!-- 部品 -->
      <?php
      foreach ($data as $key => $row) {
        // サービスごとのおすすめ度を取得
        foreach ($recommend_rates as $recommend_rate) {
          if ($recommend_rate['user_id'] == $row['user_id']) {
            $row['recommend_rate'] = $recommend_rate['rate'];
            break;
          }
        }
        // サービスごとの求人力を取得
        foreach ($recruiting_rates as $recruiting_rate) {
          if ($recruiting_rate['user_id'] == $row['user_id']) {
            $row['recruiting_rate'] = $recruiting_rate['rate'];
            break;
          }
        }
        // サービスごとのES添削を取得
        foreach ($ES_rates as $ES_rate) {
          if ($ES_rate['user_id'] == $row['user_id']) {
            $row['ES_rate'] = $ES_rate['rate'];
            break;
          }
        }
        // サービスごとの面接対策を取得
        foreach ($interview_rates as $interview_rate) {
          if ($interview_rate['user_id'] == $row['user_id']) {
            $row['interview_rate'] = $interview_rate['rate'];
            break;
          }
        }
        // サービスごとのエリアを取得
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
                <div class="flex md:flex-row flex-col md:gap-16 gap-2 <?= $row['type'] == 0 ? 'md:mt-16' : 'md:mt-9' ?> mt-0 md:mb-2 mb-3">
                  <span id="labels" class="text-md flex md:justify-center justify-start items-center md:font-normal font-bold">おすすめ度
                  </span>
                  <div id="recommendContent" class="flex justify-center items-center bg-white bg-opacity-50 px-10 py-5 rounded-xl">
                    <?php
                    $recommend_of_stars = $row['recommend_rate']; // 5つ星のうち何個星を表示するか
                    echo render_stars($recommend_of_stars);
                    ?>
                  </div>
                  <div id="recruitingContent" class="hidden flex justify-center items-center bg-white bg-opacity-50 px-10 py-5 rounded-xl">
                    <?php
                    $recruiting_of_stars = $row['recruiting_rate'];
                    echo render_stars($recruiting_of_stars);
                    ?>
                  </div>
                  <div id="esContent" class="hidden flex justify-center items-center bg-white bg-opacity-50 px-10 py-5 rounded-xl">
                    <?php
                    $ES_of_stars = $row['ES_rate'];
                    echo render_stars($ES_of_stars);
                    ?>
                  </div>
                  <div id="interviewContent" class="hidden flex justify-center items-center bg-white bg-opacity-50 px-10 py-5 rounded-xl">
                    <?php
                    $interview_of_stars = $row['interview_rate'];
                    echo render_stars($interview_of_stars);
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
                <div class="flex flex-row gap-4 md:justify-start justify-center items-center w-full">
                  <button class="text-[#F2F2F2] <?= $row['type'] == 0 ? 'bg-[#ffb907]' : 'bg-[#5AA7EB]' ?> rounded-2xl h-16 md:text-xl text-base bottom-6 md:w-auto md:px-4 px-5 font-bold shadow-xl <?= $row['type'] == 0 ? 'hover:bg-[#f09d31]' : 'hover:bg-[#5a8feb]' ?>">
                    <a href="./detail.php?id=<?= $row["user_id"]; ?>">
                      <span class="md:block hidden">詳細はこちら</span>
                      <span class="md:hidden block">詳細</span>
                    </a>
                  </button>
                  <form action="./cart-add-logic.php" method="POST" id="myForm">
                    <input type="hidden" name="user_id" value="<?= $row['user_id'] ?>">
                    <button type="submit" id="add-to-cart-btn-<?= $row['user_id'] ?>" class="flex justify-center items-center bg-[#2E78BA] h-16 px-5 py-5 text-[#F2F2F2] rounded-2xl md:w-auto w-full md:text-xl text-base font-bold shadow-xl hover:bg-[#2e5aba]">カートに追加<i class="fas fa-cart-plus fa-xl text-[#F2F2F2] mx-2 md:block hidden"></i></button>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      <?php
      }
      ?>
      <!-- 部品 -->
      <div id="page-top" class="z-10 fixed bottom-20 md:right-10 right-5">
        <a href="#" class="md:flex hidden bg-[#5AA7EC] md:text-left text-center font-bold text-white rounded-full md:h-40 md:w-40 w-20 h-20 items-center justify-center md:text-base text-xs md:px-0 px-2">ページトップへ戻る</a>
        <a href="#" class="md:hidden flex bg-[#5AA7EC] md:text-left text-center font-bold text-white rounded-full md:h-40 md:w-40 w-20 h-20 items-center justify-center md:text-base text-xs md:px-0 px-2">トップへ<br>戻る</a>
      </div>
  </main>

  <footer>
    <!-- ページ上部に戻るボタン -->
    <div>

    </div>

    <div class="md:h-96 h-64 bg-[#2E78BA] flex flex-col justify-center items-center">
      <div class="md:w-1/3 w-2/3 border-b-2 border-white">
        <h1 class="text-white font-bold md:text-4xl text-2xl text-center">CRAFT</h1>
        <p class="text-white text-sm text-center">就活エージェント比較サイト</p>
      </div>
      <div class="flex gap-4 h-10 mt-10">
        <img class="object-cover w-full h-6" src="./img/boozer_logo_white.png" alt="">
        <div class="w-full text-white">
          <small lang="en">©︎2023 boozer</small>
        </div>
      </div>
    </div>
  </footer>
  <script>
    // カートに追加機能
    var jsonString = '<?php echo $json; ?>';
    console.log(jsonString);
    var array = JSON.parse(jsonString);
    array.forEach(function(element) {
      var buttonId = 'add-to-cart-btn-' + element;
      var button = document.getElementById(buttonId);

      if (button) {
        button.innerHTML = 'カートに<br class="md:hidden block">追加しました<i class="md:block hidden mx-2 fa-solid fa-square-check fa-xl text-white"></i>';
        button.classList.remove("hover:bg-[#2e5aba]");
        button.classList.add("bg-[#FF8D06]", "cursor-not-allowed");
        button.disabled = true;
      }

      let cartItems = document.getElementById("cart-items");
      let cartItemsNum = array.length;
      cartItems.innerHTML = cartItemsNum;
    });

    // 星の表示
    const recommendContents = document.querySelectorAll('#recommendContent');
    const recruitingContents = document.querySelectorAll('#recruitingContent');
    const esContents = document.querySelectorAll('#esContent');
    const interviewContents = document.querySelectorAll('#interviewContent');
    const labels = document.querySelectorAll('#labels');
    var sortId = <?php echo $sort_id; ?>;
    if (sortId == 1) {
      for (let i = 0; i < recommendContents.length; i++) {
        labels[i].textContent = 'おすすめ度';
        recommendContents[i].classList.remove('hidden');
        recruitingContents[i].classList.add('hidden');
        esContents[i].classList.add('hidden');
        interviewContents[i].classList.add('hidden');
      }
    } else if (sortId == 2) {
      for (let i = 0; i < recommendContents.length; i++) {
        labels[i].textContent = '求人力　';
        recommendContents[i].classList.add('hidden');
        recruitingContents[i].classList.remove('hidden');
        esContents[i].classList.add('hidden');
        interviewContents[i].classList.add('hidden');
      }
    } else if (sortId == 3) {
      for (let i = 0; i < recommendContents.length; i++) {
        labels[i].textContent = 'ES添削　';
        recommendContents[i].classList.add('hidden');
        recruitingContents[i].classList.add('hidden');
        esContents[i].classList.remove('hidden');
        interviewContents[i].classList.add('hidden');
      }
    } else if (sortId == 4) {
      for (let i = 0; i < recommendContents.length; i++) {
        labels[i].textContent = '面接対策';
        recommendContents[i].classList.add('hidden');
        recruitingContents[i].classList.add('hidden');
        esContents[i].classList.add('hidden');
        interviewContents[i].classList.remove('hidden');
      }
    }

    // トグルボタンの切り替え
    const toggleButton = document.getElementById("toggleButton");
    const toggleForm = document.getElementById("toggleForm");
    const toggleState = document.getElementById("toggleState");

    toggleButton.addEventListener("change", function() {
      if (toggleButton.checked) {
        toggleState.value = "specialized";
        toggleForm.submit();
      } else {
        toggleState.value = "comprehensive";
        toggleForm.submit();
      }
    });

    var sessionToggleState = <?php echo $toggle_state; ?>;
    if (sessionToggleState == "specialized") {
      toggleButton.checked = true;
    } else {
      toggleButton.checked = false;
    }
  </script>
</body>

</html>
