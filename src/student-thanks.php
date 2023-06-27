<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css">
  <link rel="stylesheet" href="./css/output.css" />
  <title>thanksページ</title>
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
              <span class="text-white text-center w-full">
                <i class="fa fa-check w-full fill-current white"></i>
              </span>
            </div>
          </div>

          <div class="w-1/6 align-center items-center align-middle content-center flex ">
            <div class="w-full bg-[#DAE4E8] rounded items-center align-middle align-center flex-1">
              <div class="bg-[#2E78BA] w-full text-xs leading-none py-1 text-center text-grey-darkest rounded"></div>
            </div>
          </div>

          <div class="flex-1">
            <div class="w-10 h-10 bg-[#2E78BA] border-2 border-grey-light mx-auto rounded-full text-lg text-white flex items-center">
              <span class="text-white text-center w-full">
                <i class="fa fa-check w-full fill-current white"></i>
              </span>
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
    <div class="text-center mt-20">
      <div class="font-medium md:text-3xl text-2xl mb-10">申請が完了いたしました</div>
      <div class="text-base leading-loose md:mb-0 mb-2">
        ご登録いただいたメールアドレスに、<br class="md:hidden block">申請完了メールをお送り致しましたので<br class="md:hidden block">ご確認ください。<br>
      </div>
      <div class="text-base leading-loose md:mb-0 mb-2">
        本日からおよそ２日〜５日ほどで、<br class="md:hidden block">ご申請いただいた各企業様から<br class="md:hidden block">お客様がご登録されたメールアドレスに<br class="md:hidden block">連絡がございます。
      </div>
      <div class="text-base leading-loose md:mb-0 mb-2">
        随時ご確認いただきますよう<br class="md:hidden block">お願いいたします。
      </div>
    </div>
    <div class="flex justify-center mt-16">
      <a href="./index.php">
        <button class="bg-[#2E78BA] hover:opacity-80 text-white rounded text-lg md:px-36 px-12 py-4">トップページへ戻る</button>
      </a>
    </div>
  </main>
</body>
