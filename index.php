<?php
// 0. SESSION開始
session_start();

// 1.  関数群の読み込み
require_once('funcs.php');
loginCheck();
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>ブックマーク登録</title>
    <link href="css/style.css" rel="stylesheet">

</head>

<body>
    <nav class="navbar">
        <a href="select.php">ブックマーク一覧</a>
        <a href="user.php">ユーザー登録</a>
        <form class="logout-form" action="logout.php" method="post">
            <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
            <form class="logout-form" action="logout.php" method="post" onsubmit="return confirm('本当にログアウトしますか？');">
                <button type="submit" class="logout-button">ログアウト</button>
            </form>
        </form>
    </nav>

    <div class="container">
        <h1>ブックマーク</h1>

        <form method="POST" action="insert.php" enctype="multipart/form-data">
            <fieldset>
                <div class="form-group">
                    <label for="book_name">作品名：</label>
                    <input type="text" id="book_name" name="book_name">
                </div>
                <div class="form-group">
                    <label for="book_url">URL：</label>
                    <input type="text" id="book_url" name="book_url"  required placeholder="https://xxx.com">
                </div>
                <div class="form-group">
                    <label for="book_comment">感想：</label>
                    <textarea id="book_comment" name="book_comment" rows="4" required placeholder="コメントを記載してください"></textarea>
                </div>
                <div>
                    <label for="image">画像：</label>
                    <input type="file" id="image" name="image">
                </div>
                <input type="submit" value="送信">
            </fieldset>

        </form>
    </div>
</body>

</html>