<?php
// 0. SESSION開始
session_start();
require_once('funcs.php');
loginCheck();

?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ユーザー登録</title>
  <link href="css/style.css" rel="stylesheet" />
</head>

    <nav class="navbar">
      <span><?= htmlspecialchars($_SESSION['name'], ENT_QUOTES, 'UTF-8') ?>さん</span>
      <a href="select.php">ブックマーク一覧</a>
      <!-- <a href="user_list.php">ユーザー一覧</a> -->
      <form class="logout-form" action="logout.php" method="post" onsubmit="return confirm('本当にログアウトしますか？');">
        <button type="submit" class="logout-button">ログアウト</button>
      </form>
    </nav> 

      <form method="post" action="user_insert.php">
        <div class="jumbotron">
          <fieldset>
            <legend>ユーザー登録</legend>
            <label>名前：<input type="text" name="name"></label><br>
            <label>ID：<input type="text" name="lid"></label><br>
            <label>パスワード：<input type="text" name="lpw"></label><br>
            <label>管理FLG：
              一般<input type="radio" name="kanri_flg" value="0">　
              管理者<input type="radio" name="kanri_flg" value="1">
            </label>
            <br>
            <input type="submit" value="送信">
          </fieldset>
        </div>
      </form>
    </body>

</html>