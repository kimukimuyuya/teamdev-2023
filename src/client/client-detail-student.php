<?php
session_start();
include_once '../dbconnect.php';

if (!isset($_POST['id'])) {
  header('Location: ../auth/login.php');
  exit();
}


$sql = "SELECT * FROM students WHERE id = :id";
$stmt = $dbh->prepare($sql);
$stmt->bindValue(":id", $_POST["id"], PDO::PARAM_INT);
$stmt->execute();
$student = $stmt->fetch(PDO::FETCH_ASSOC);

$formatted_date = date('Y/m/d', strtotime($student['created_at']));
?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>クライアント管理者画面詳細</title>
  <link href="../css/output.css" rel="stylesheet">
</head>

<body>
  <header class="fixed w-full bg-[#2E78BA] z-10 h-20 top-0 left-0">
    <div class="relative">
      <div class="flex gap-1 items-center justify-between h-20 px-4">
        <div>
          <div>
            <img class="h-6" src="../img/boozer_logo_white.png" alt="boozer">
          </div>
        </div>
        <div class="w-1/3 border-b-2 border-white absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2">
          <h1 class="text-white font-bold text-2xl text-center">CRAFT</h1>
          <p class="text-white text-sm text-center">就活エージェント比較サイト</p>
        </div>
        <div class="flex items-center justify-center mr-12 gap-8">
            <a href="https://forms.gle/QSrB9cAHjTSPWuG56" class="text-white text-lg hover:underline">無効申請フォーム</a>
            <a href="https://forms.gle/zxwJpm7x5gH33PJB6" class="text-white text-lg hover:underline">お問い合わせ</a>
        </div>
      </div>
    </div>
  </header>
  <main class="container mx-auto">
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg mt-28">
      <table class="w-full text-base text-left text-gray-500 dark:text-gray-400">
        <tbody>
          <tr class="border-b border-gray-200 dark:border-gray-700">
            <th scope="row" class="px-6 py-3.5 font-medium text-gray-900 whitespace-nowrap bg-gray-50 dark:text-white dark:bg-gray-800">
              学生ID
            </th>
            <td class="px-6 py-3.5">
              <?= $student["id"]; ?>
            </td>
          </tr>
          <tr class="border-b border-gray-200 dark:border-gray-700">
            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap bg-gray-50 dark:text-white dark:bg-gray-800">
              名前（漢字）
            </th>
            <td class="px-6 py-4">
              <?= $student["name"]; ?>
            </td>
          </tr>
          <tr class="border-b border-gray-200 dark:border-gray-700">
            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap bg-gray-50 dark:text-white dark:bg-gray-800">
              名前（カナ）
            </th>
            <td class="px-6 py-3.5">
              <?= $student["name_kana"]; ?>
            </td>
          </tr>
          <tr class="border-b border-gray-200 dark:border-gray-700">
            <th scope="row" class="px-6 py-3.5 font-medium text-gray-900 whitespace-nowrap bg-gray-50 dark:text-white dark:bg-gray-800">
              性別
            </th>
            <td class="px-6 py-3.5">
            <?php
              if ($student["gender"] == 0) {
                echo "男性";
              } else {
                echo "女性";
              }
              ?>
            </td>
          </tr>
          <tr class="border-b border-gray-200 dark:border-gray-700">
            <th scope="row" class="px-6 py-3.5 font-medium text-gray-900 whitespace-nowrap bg-gray-50 dark:text-white dark:bg-gray-800">
              登録日
            </th>
            <td class="px-6 py-3.5">
              <?= $formatted_date; ?>
            </td>
          </tr>
          <tr class="border-b border-gray-200 dark:border-gray-700">
            <th scope="row" class="px-6 py-3.5 font-medium text-gray-900 whitespace-nowrap bg-gray-50 dark:text-white dark:bg-gray-800">
              学校名
            </th>
            <td class="px-6 py-3.5">
              <?= $student["university"]; ?>
            </td>
          </tr>
          <tr class="border-b border-gray-200 dark:border-gray-700">
            <th scope="row" class="px-6 py-3.5 font-medium text-gray-900 whitespace-nowrap bg-gray-50 dark:text-white dark:bg-gray-800">
              学部学科
            </th>
            <td class="px-6 py-3.5">
              <?= $student["faculty"]; ?>
            </td>
          </tr>
          <tr class="border-b border-gray-200 dark:border-gray-700">
            <th scope="row" class="px-6 py-3.5 font-medium text-gray-900 whitespace-nowrap bg-gray-50 dark:text-white dark:bg-gray-800">
              卒業年度
            </th>
            <td class="px-6 py-3.5">
              <?= $student["graduate_year"]; ?>
            </td>
          </tr>
          <tr class="border-b border-gray-200 dark:border-gray-700">
            <th scope="row" class="px-6 py-3.5 font-medium text-gray-900 whitespace-nowrap bg-gray-50 dark:text-white dark:bg-gray-800">
              お住まいの地域
            </th>
            <td class="px-6 py-3.5">
              <?= $student["prefecture"]; ?>
            </td>
          </tr>
          <tr class="border-b border-gray-200 dark:border-gray-700">
            <th scope="row" class="px-6 py-3.5 font-medium text-gray-900 whitespace-nowrap bg-gray-50 dark:text-white dark:bg-gray-800">
              電話番号
            </th>
            <td class="px-6 py-3.5">
              <?= $student["phone"]; ?>
            </td>
          </tr>
          <tr class="border-b border-gray-200 dark:border-gray-700">
            <th scope="row" class="px-6 py-3.5 font-medium text-gray-900 whitespace-nowrap bg-gray-50 dark:text-white dark:bg-gray-800">
              メールアドレス
            </th>
            <td class="px-6 py-3.5">
              <?= $student["email"]; ?>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
    <div class="fixed inset-x-0 bottom-4 flex items-center justify-center">
  <div class="flex justify-center">
    <form action="./client-admin.php" method="POST">
      <button name="return_button" class="bg-[#2E78BA] hover:bg-[#245c92] text-white rounded text-lg px-36 py-4 z-10">一覧へ戻る</button>
    </form>
  </div>
</div>


  </main>

</body>

</html>