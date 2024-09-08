<?php
// 0. SESSION開始！！
session_start();
require_once('funcs.php');
loginCheck();

//1. POSTデータ取得
$book_name = $_POST['book_name']; // 書籍名を取得
$book_url = $_POST['book_url']; // 書籍のURLを取得
$book_comment = $_POST['book_comment']; // 内容を取得

//SESSOINからUser_id番号を取ってくる
// $id = $_SESSION['id']; // セッションからユーザーIDを取得
$user_id = $_SESSION['user_id']; // セッションからユーザーIDを取得

// 2. URLのバリデーション
if (filter_var($book_url, FILTER_VALIDATE_URL)) {
    // 正しいURLの場合の処理
    // データベースに登録などの処理を追加してください

// 画像アップロードの処理
// $image = $_FILES['image'];

// 画像パスを保存する用の変数を用意。空っぽにするのは、保存失敗時にもプログラムが動くようにするため
$image_path = '';

// そもそもファイルデータがない場合は画像保存に関する一連の処理は不要なのでif文を使う 
if (isset($_FILES['image'])) {

    // imageの部分はinput type="file"のname属性に相当します。
    // 必要に応じて書き換えるべき場所です。
    $upload_file = $_FILES['image']['tmp_name'];

    //画像の拡張子を取得,jpgとかpngとかの部分のこと
    $extension = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);

    // 画像名を取得。今回はuniqid()をつかって　保存時の時刻情報をファイル名とする
    $file_name = uniqid() . '.' . $extension;

    // フォルダ名を取得。今回は直書き。
    $dir_name = 'img/';

    // image_pathを確認、画像の保存場所を設定
    $image_path = $dir_name . $file_name;

    // move_uploaded_file()で、一時的に保管されているファイルをimage_pathに移動させる。
    // if文の中で関数自体が実行される書き方をする場合、成功か失敗かが条件に設定される。
    // 失敗した場合はエラー表示を出して終了にする
    // if (move_uploaded_file($upload_file, $image_path)) {
    // }
    if (!move_uploaded_file($upload_file, $image_path)) {
        exit('ファイルの保存に失敗しました。');
    }
}


//2. DB接続します
require_once('funcs.php');
$pdo = db_conn();

//３．データ登録SQL作成
$stmt = $pdo->prepare("INSERT INTO gs_bookmark_table(user_id, book_name, book_url, book_comment, image, date) VALUES(:user_id, :book_name, :book_url, :book_comment, :image, NOW())");
$stmt->bindValue(':book_name', $book_name, PDO::PARAM_STR);
$stmt->bindValue(':book_url', $book_url, PDO::PARAM_STR);
$stmt->bindValue(':book_comment', $book_comment, PDO::PARAM_STR);
$stmt->bindValue(':image', $image_path, PDO::PARAM_STR);
$stmt->bindValue(':user_id', $user_id, PDO::PARAM_INT);


$status = $stmt->execute(); //実行

//４．データ登録処理後
if ($status == false) {
    sql_error($stmt);
} else {
    redirect('index.php');
}
} else {
    // 正しくないURLの場合の処理
    echo '無効なURLです。<br>'; // 改行を追加
    echo '<a href="index.php">ブックマーク登録画面に戻る</a>'; // リンクを表示
}
?>