<?php
// 0. SESSION開始！！
session_start();

// 1. ログインチェック処理！
// 以下、セッションID持ってたら、ok
// 持ってなければ、閲覧できない処理にする。

// ログイン処理の時に代入した$_SESSION['chk_ssid']を持っているか？
// もしくはサーバーのSESSION IDと一緒か？
// if (!isset($_SESSION['chk_ssid']) || $_SESSION['chk_ssid'] != session_id()) {
//     header('Location: login.php');
//     exit('LOGIN ERROR');
// }
// // SESSION idを変更して保存し直す
// session_regenerate_id();
// $_SESSION['chk_ssid'] = session_id();

//１．関数群の読み込み
require_once('funcs.php');
loginCheck();

//２．データ登録SQL作成
$pdo = db_conn();
$stmt = $pdo->prepare('SELECT
    gs_bookmark_table.*,
    gs_user_table.name AS name
FROM gs_bookmark_table JOIN gs_user_table ON gs_bookmark_table.user_id = gs_user_table.id');
// $stmt = $pdo->prepare('SELECT * FROM gs_bookmark_table');
$status = $stmt->execute();

//３．データ表示
if ($status == false) {
    sql_error($stmt);
}
?>


<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ブックマーク表示</title>
    <link href="css/style.css" rel="stylesheet">

</head>

<body id="main">
    <nav class="navbar">
        <!-- <a class="navbar-brand" href="index.php">ブックマーク登録</a> -->
        <a href="index.php">ブックマーク登録</a>
        <a href="user.php">ユーザー登録</a>

        <div class="navbar-header user-name">
            <p><?= $_SESSION['user_name'] ?></p>
        </div>

        <form class="logout-form" action="logout.php" method="post" onsubmit="return confirm('本当にログアウトしますか？');">
            <button type="submit" class="logout-button">ログアウト</button>
        </form>
    </nav>

    <div class="container">
        <h1>ブックマーク一覧</h1>
        <div class="card-container">
            <?php while ($r = $stmt->fetch(PDO::FETCH_ASSOC)) : ?>
                <div class="card">
                        <p>日付: <?= h($r['date']) ?></p>
                        <p>ユーザー名: <?= h($r['name']) ?></p>
                    <div class="card-title">作品名：<?= h($r['book_name']) ?></div>
                    <div class="card-content">
                        <p>URL: <?= h($r['book_url']) ?></p>
                        <p>感想: <?= h($r['book_comment']) ?></p>
                        <div>
                            <img src="<?= h($r['image']) ?>" alt="">
                        </div>
                    </div>
                    <div class="card-actions">
                        <a class="btn btn-primary" href="detail.php?id=<?= $r['id'] ?>">詳細</a>

                        <form action="delete.php" method="POST">
                            <input type="hidden" name="id" value="<?= $r['id'] ?>">
                            <input type="submit" value="削除" class="btn btn-danger">
                        </form>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    </div>
</body>
</html>

