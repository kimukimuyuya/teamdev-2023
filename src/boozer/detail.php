<?php
session_start();
include_once '../dbconnect.php';

if (!isset($_SESSION['admin'])) {
  header('Location: ../auth/login.php');
  exit();
}

$sql = "SELECT * FROM agents WHERE user_id = :user_id";
$stmt = $dbh->prepare($sql);
$stmt->bindValue(':user_id', $_GET['id'], PDO::PARAM_INT);
$stmt->execute();
$agent = $stmt->fetch(PDO::FETCH_ASSOC);

$sql_students = "SELECT s.*, a.company_name FROM students s LEFT JOIN agents_students m ON s.id = m.student_id LEFT JOIN agents a ON m.agent_id = a.user_id WHERE a.user_id = :user_id AND m.is_valid = true";
$stmt = $dbh->prepare($sql_students);
$stmt->bindValue(':user_id', $_GET['id'], PDO::PARAM_INT);
$stmt->execute();
$students = $stmt->fetchAll(PDO::FETCH_ASSOC);

$count_student = "SELECT COUNT(*) FROM students s LEFT JOIN agents_students m ON s.id = m.student_id LEFT JOIN agents a ON m.agent_id = a.user_id WHERE a.user_id = :user_id AND m.is_valid = true";
$stmt = $dbh->prepare($count_student);
$stmt->bindValue(':user_id', $_GET['id'], PDO::PARAM_INT);
$stmt->execute();
$count = $stmt->fetchColumn();
?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>boozer管理者画面詳細</title>
  <link href="../css/output.css" rel="stylesheet">
  <script src="../script/delete-confirm.js" defer></script>
</head>

<body class="container mx-auto">
  <div class="text-4xl my-12">
    企業名：<?= $agent['company_name']; ?>
  </div>

  <div class="text-4xl my-12">
    請求対象の学生人数：<?= $count ?>名
  </div>

  <?php if (count($students) > 0) { ?>
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg mb-20">
      <table class="w-full text-base dark:text-gray-400">
        <thead class="text-base text-gray-500 uppercase dark:text-gray-400 border-b border-gray-200 dark:border-gray-700">
          <tr>
            <th scope="col" class="px-6 py-3 bg-gray-50 dark:bg-gray-800 text-center">
              学生ID
            </th>
            <th scope="col" class="px-6 py-3 bg-gray-50 dark:bg-gray-800 text-center">
              名前
            </th>
            <th scope="col" class="px-6 py-3 bg-gray-50 dark:bg-gray-800 text-center">
              メールアドレス
            </th>
            <th scope="col" class="px-6 py-3 bg-gray-50 dark:bg-gray-800 text-center">
              電話番号
            </th>
            <th scope="col" class="px-6 py-3 bg-gray-50 dark:bg-gray-800 text-center">
            </th>
            <th scope="col" class="px-6 py-3 bg-gray-50 dark:bg-gray-800 text-center">
            </th>

          </tr>
        </thead>
        <tbody>
          <?php foreach ($students as $key => $student) { ?>
            <tr class="border-b border-r border-gray-200 dark:border-gray-700">
              <td class="px-6 py-4 whitespace-nowrap text-center">
                <?= $student["id"]; ?>
              </td>
              <td class="px-6 py-4 whitespace-nowrap text-center">
                <?= $student["name"]; ?>
              </td>
              <td class="px-6 py-4 whitespace-nowrap text-center">
                <?= $student["email"]; ?>
              </td>
              <td class="px-6 py-4 whitespace-nowrap text-center">
                <?= $student["phone"]; ?>
              </td>
              <td class="px-2 py-2 whitespace-nowrap text-center">
                <a href="./detail-student.php?id=<?=$student["id"]; ?>" class="px-2 py-1 text-blue-500 border border-blue-500 font-semibold rounded hover:bg-blue-100">詳細</a>
              </td>
              <td class="px-2 py-2 whitespace-nowrap text-center">
                <a href="./student-delete.php?student_id=<?=$student["id"]; ?>&agent_id=<?=$_GET['id']?>" onclick="return confirmLink()" class="px-2 py-1 text-red-500 border border-red-500 font-semibold rounded hover:bg-red-100">削除</a>
              </td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
  <?php } else { ?>
    <div class="text-2xl my-12">
      現在、登録されている学生はいません。
    </div>
  <?php } ?>


</body>

</html>