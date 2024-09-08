<?php
// 0. SESSION開始
session_start();

//１．関数群の読み込み
require_once('funcs.php');
loginCheck();

$id = $_GET['id']; //?id~**を受け取る
$pdo = db_conn();

//２．データ登録SQL作成
// $stmt = $pdo->prepare('SELECT * FROM gs_bookmark_table WHERE id=:id');
// $stmt->bindValue(':id', $id, PDO::PARAM_INT);
// $status = $stmt->execute();
$stmt = $pdo->prepare('SELECT
    gs_bookmark_table.*,
    gs_user_table.name AS name
FROM gs_bookmark_table JOIN gs_user_table ON gs_bookmark_table.user_id = gs_user_table.id');
// $stmt = $pdo->prepare('SELECT * FROM gs_bookmark_table');
$status = $stmt->execute();


//３．データ表示
if ($status == false) {
    sql_error($stmt);
} else {
    // $row = $stmt->fetch();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
}

// $view = '';
// if ($status === false) {
//     $error = $stmt->errorInfo();
//     exit('SQLError:' . print_r($error, true));
// }
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>ブックマーク更新</title>
    <link href="css/style.css" rel="stylesheet">

</head>

<body>

    <!-- Head[Start] -->
    <nav class="navbar">
        <div class="container-fluid">
            <div class="navbar-header"><a class="navbar-brand" href="select.php">ブックマーク一覧</a></div>
        </div>
    </nav>
    <!-- Head[End] -->

    <!-- Main[Start] -->
    <div class="container">
        <h1>編集</h1>

        <form method="POST" action="update.php" enctype="multipart/form-data">
            <div class="jumbotron">
                <fieldset>
                    <!-- <label>作品名：<input type="text" name="book_name" value="<?= $row['book_name'] ?>"></label><br>
                    <label>URL：<input type="text" name="book_url" value="<?= $row['book_url'] ?>"></label><br>
                    <label>感想：<textArea name="book_comment" rows="4" cols="40"><?= $row['book_comment'] ?></textArea></label><br> -->
                    <label for="date">日付:</label>
                    <input type="text" name="date" value="<?= htmlspecialchars($result['date'], ENT_QUOTES, 'UTF-8') ?>"><br>
                    <label for="name">ユーザー名:</label>
                    <input type="text" name="name" value="<?= htmlspecialchars($result['name'], ENT_QUOTES, 'UTF-8') ?>">
                    <label for="book_name">作品名:</label>
                    <input type="text" name="book_name" value="<?= htmlspecialchars($result['book_name'], ENT_QUOTES, 'UTF-8') ?>"><br>
                    <label for="book_url">URL:</label>
                    <input type="text" name="book_url" value="<?= htmlspecialchars($result['book_url'], ENT_QUOTES, 'UTF-8') ?>"><br>
                    <label for="book_comment">感想:</label>
                    <textarea name="book_comment"><?= htmlspecialchars($result['book_comment'], ENT_QUOTES, 'UTF-8') ?></textarea><br>
                    <label for="image">画像:</label><input type="file" name="image">
                    <?php
                    if (!empty($result['image'])) {
                        // if (!empty($row['image'])) {
                        echo '<img src="' . h($result['image']) . '" class="image-class">';
                    }
                    ?>

                    <input type="submit" value="更新">
                    <input type="hidden" name="id" value="<?= $id ?>">
                </fieldset>
            </div>
        </form>
    </div>
    <!-- Main[End] -->

</body>

</html>