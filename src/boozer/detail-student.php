<?php
session_start();
include_once '../dbconnect.php';

if (!isset($_SESSION['admin'])) {
  header('Location: ../auth/login.php');
  exit();
}

$sql = "SELECT * FROM students WHERE id = :id";
$stmt = $dbh->prepare($sql);
$stmt->bindValue(":id", $_GET["id"], PDO::PARAM_INT);
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

<body class="container mx-auto">
  <div class="relative overflow-x-auto shadow-md sm:rounded-lg my-24">
    <table class="w-full text-base text-left text-gray-500 dark:text-gray-400">
      <tbody>
        <tr class="border-b border-gray-200 dark:border-gray-700">
          <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap bg-gray-50 dark:text-white dark:bg-gray-800">
            学生ID
          </th>
          <td class="px-6 py-4">
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
          <td class="px-6 py-4">
            <?= $student["name_kana"]; ?>
          </td>
        </tr>
        <tr class="border-b border-gray-200 dark:border-gray-700">
          <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap bg-gray-50 dark:text-white dark:bg-gray-800">
            性別
          </th>
          <td class="px-6 py-4">
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
          <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap bg-gray-50 dark:text-white dark:bg-gray-800">
            登録日
          </th>
          <td class="px-6 py-4">
            <?= $formatted_date; ?>
          </td>
        </tr>
        <tr class="border-b border-gray-200 dark:border-gray-700">
          <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap bg-gray-50 dark:text-white dark:bg-gray-800">
            学校名
          </th>
          <td class="px-6 py-4">
            <?= $student["university"]; ?>
          </td>
        </tr>
        <tr class="border-b border-gray-200 dark:border-gray-700">
          <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap bg-gray-50 dark:text-white dark:bg-gray-800">
            学部学科
          </th>
          <td class="px-6 py-4">
            <?= $student["faculty"]; ?>
          </td>
        </tr>
        <tr class="border-b border-gray-200 dark:border-gray-700">
          <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap bg-gray-50 dark:text-white dark:bg-gray-800">
            卒業年度
          </th>
          <td class="px-6 py-4">
            <?= $student["graduate_year"]; ?>
          </td>
        </tr>
        <tr class="border-b border-gray-200 dark:border-gray-700">
          <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap bg-gray-50 dark:text-white dark:bg-gray-800">
            お住まいの地域
          </th>
          <td class="px-6 py-4">
            <?= $student["prefecture"]; ?>
          </td>
        </tr>
        <tr class="border-b border-gray-200 dark:border-gray-700">
          <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap bg-gray-50 dark:text-white dark:bg-gray-800">
            電話番号
          </th>
          <td class="px-6 py-4">
            <?= $student["phone"]; ?>
          </td>
        </tr>
        <tr class="border-b border-gray-200 dark:border-gray-700">
          <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap bg-gray-50 dark:text-white dark:bg-gray-800">
            メールアドレス
          </th>
          <td class="px-6 py-4">
            <?= $student["email"]; ?>
          </td>
        </tr>
      </tbody>
    </table>
  </div>

</body>

</html>