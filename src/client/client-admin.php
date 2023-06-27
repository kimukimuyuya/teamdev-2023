<?php
session_start();
include_once '../dbconnect.php';

if (!isset($_SESSION['agent']) && !isset($_POST['return_button'])) {
  header('Location: ../auth/login.php');
  exit();
}

$agent = $_SESSION['agent'];

$sql_students = "SELECT s.*, a.company_name FROM students s LEFT JOIN agents_students m ON s.id = m.student_id LEFT JOIN agents a ON m.agent_id = a.user_id WHERE a.user_id = :user_id AND m.is_valid = true ORDER BY s.created_at DESC";
$stmt = $dbh->prepare($sql_students);
$stmt->bindValue(':user_id', $agent['user_id'], PDO::PARAM_INT);
$stmt->execute();
$students = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>クライアント管理者画面</title>
  <link href="../css/output.css" rel="stylesheet">
</head>

<body>
  <header class="fixed w-full bg-[#2E78BA] z-10 h-20 top-0 left-0">
    <div class="relative">
      <div class="flex gap-1 items-center justify-between h-20 px-4">
        <div>
            <img class="h-6" src="../img/boozer_logo_white.png" alt="boozer">
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
  <main class="container mx-auto mt-32">
    <div class="text-4xl my-12 text-center">
      <?= $agent['company_name']; ?>管理者画面
    </div>

    <?php if (count($students) > 0) { ?>
      <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-base text-left text-gray-500 dark:text-gray-400">
          <thead class="text-base text-gray-700 uppercase dark:text-gray-400 border-b border-gray-200 dark:border-gray-700">
            <tr>
              <th scope="col" class="px-6 py-3 bg-gray-50 dark:bg-gray-800 text-center">
                学生ID
              </th>
              <th scope="col" class="px-6 py-3 bg-gray-50 dark:bg-gray-800 text-center">
                名前
              </th>
              <th scope="col" class="px-6 py-3 bg-gray-50 dark:bg-gray-800 text-center">
                登録日
              </th>
              <th scope="col" class="px-6 py-3 bg-gray-50 dark:bg-gray-800 text-center">
                メールアドレス
              </th>
              <th scope="col" class="px-6 py-3 bg-gray-50 dark:bg-gray-800 text-center">
                電話番号
              </th>
              <th scope="col" class="px-6 py-3 bg-gray-50 dark:bg-gray-800 text-center">
                詳細画面
              </th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($students as $key => $student) { ?>
              <tr class="border-b border-gray-200 dark:border-gray-700">
                <td class="px-6 py-4 whitespace-nowrap text-center">
                  <?= $student["id"]; ?>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-center">
                  <?= $student["name"]; ?>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-center">
                  <?= $formatted_date = date('Y/m/d', strtotime($student['created_at'])); ?>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-center">
                  <?= $student["email"]; ?>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-center">
                  <?= $student["phone"]; ?>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-center">
                  <form action="./client-detail-student.php" method="POST">
                    <input type="hidden" name="id" value="<?= $student["id"]; ?>">
                    <button type="submit" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">詳細</button>
                  </form>
                </td>

              </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>
      <form action="./csv-download.php?agent_id=<?= $agent["user_id"] ?>" method="POST" enctype="multipart/form-data">
        <div class="mt-32">
          <?php if (isset($_SESSION['error_message'])) { 
            $error_message = $_SESSION['error_message'];
            unset($_SESSION['error_message']);
            ?>
            <p class="text-xl text-red-600 mb-5 text-center"><?php echo $error_message; ?></p>
          <?php } ?>
          <div class="flex justify-center items-center mb-20">
            <div class="mr-20">
              <label class="block text-gray-700 font-bold mb-2" for="start_at">開始日</label>
              <input class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="start_at" name="start_at" type="date" placeholder="開始日" required>
            </div>
            <div>
              <label class="block text-gray-700 font-bold mb-2" for="end_at">終了日</label>
              <input class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="end_at" name="end_at" type="date" placeholder="終了日" required>
            </div>
            <div class="text-center ml-28">
              <button class="w-48 h-16 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-xl px-4 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800" type="submit">CSVダウンロード</button>
            </div>
          </div>
        </div>
      </form>
    <?php } else { ?>
      <div class="text-2xl my-12">
        現在、登録されている学生はいません。
      </div>
    <?php } ?>

  </main>
</body>

</html>
