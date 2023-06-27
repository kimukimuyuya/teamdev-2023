<?php
session_start();
include_once '../dbconnect.php';

// ログインしていなければログイン画面に遷移する
if (!isset($_SESSION['admin'])) {
    header('Location: ../auth/login.php');
    exit();
}

// クエリを実行してデータを取得する
$sql = "SELECT user_id, company_name, service_name, email, phone, start_at, end_at FROM agents where is_valid = true order by end_at is null, end_at, start_at";
$stmt = $dbh->prepare($sql);
$stmt->execute();
$data = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRAFT管理画面</title>
    <!-- Tailwind CSSのリンクを追加 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.1.2/dist/tailwind.min.css">
    <script src="../script/delete-confirm.js" defer></script>
</head>

<body class="bg-gray-100">
    <h1 class="font-bold text-3xl text-center mt-5">CRAFT 管理画面</h1>
    <div class="container mx-auto py-10">
        <div class="flex flex-col">
            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                    <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider ">ID</th>
                                    <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">企業名</th>
                                    <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">サービス名</th>
                                    <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">メールアドレス</th>
                                    <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">電話番号</th>
                                    <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">開始日</th>
                                    <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">終了日</th>
                                    <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">編集</th>
                                    <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">詳細</th>
                                    <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">削除</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                <?php foreach ($data as $row) : ?>
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-center"><?= $row['user_id'] ?></td>
                                        <td class="px-6 py-4 whitespace-nowrap text-center"><?= $row['company_name'] ?></td>
                                        <td class="px-6 py-4 whitespace-nowrap text-center"><?= $row['service_name'] ?></td>
                                        <td class="px-6 py-4 whitespace-nowrap text-center"><?= $row['email'] ?></td>
                                        <td class="px-6 py-4 whitespace-nowrap text-center"><?= $row['phone'] ?></td>
                                        <td class="px-6 py-4 whitespace-nowrap text-center"><?= $row['start_at'] ?></td>
                                        <td class="px-6 py-4 whitespace-nowrap text-center"><?= $row['end_at'] ?></td>
                                        <td class="px-6 py-4 whitespace-nowrap text-center"><button class="px-2 py-1 text-green-500 border border-green-500 font-semibold rounded hover:bg-green-100"><a href="./edit.php?id=<?= $row["user_id"]; ?>">編集</a></button></td>
                                        <td class="px-6 py-4 whitespace-nowrap text-center"><button class="px-2 py-1 text-blue-500 border border-blue-500 font-semibold rounded hover:bg-blue-100"><a href="./detail.php?id=<?= $row["user_id"]; ?>">詳細</a></button></td>
                                        <td class="px-6 py-4 whitespace-nowrap text-center"><button class="px-2 py-1 text-red-500 border border-red-500 font-semibold rounded hover:bg-red-100"><a href="./agent-delete.php?id=<?= $row["user_id"]; ?>" onclick="return confirmLink()">削除</a></button></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer>
        <div class="w-full text-center z-10 mb-10">
            <button class="w-40 h-16 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-xl px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800"><a href="./agent-form.php">新規登録</a></button>
        </div>
    </footer>
</body>

</html>