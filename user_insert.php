<?php
// 0. SESSION開始！！
session_start();
require_once('funcs.php');
loginCheck();

//1. POSTデータ取得
// フォームから送信されたデータを取得
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
$name = $_POST['name'];
$lid = $_POST['lid'];
// $lpw = password_hash($_POST['lpw'], PASSWORD_DEFAULT); // パスワードをハッシュ化
$lpw = $_POST['lpw']; 
$kanri_flg = $_POST['kanri_flg'];

// if ($_SERVER['REQUEST_METHOD'] === 'POST') {
//     // フォームから送信されたデータを取得
//     $name = $_POST['name'];
//     $lid = $_POST['lid'];
//     $lpw = password_hash($_POST['lpw'], PASSWORD_DEFAULT); // パスワードをハッシュ化
//     $kanri_flg = $_POST['kanri_flg'];

//2. DB接続します
$pdo = db_conn();

//３．データ登録SQL作成
$sql = "INSERT INTO gs_user_table(name,lid,lpw,kanri_flg,life_flg)VALUES(:name,:lid,:lpw,:kanri_flg,0)";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':name', $name, PDO::PARAM_STR); //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':lid', $lid, PDO::PARAM_STR); //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':lpw', $lpw, PDO::PARAM_STR); //Integer（数値の場合 PDO::PARAM_INT)::PARAM_STR); //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':kanri_flg', $kanri_flg, PDO::PARAM_INT); //Integer（数値の場合 PDO::PARAM_INT)
//実行
$status = $stmt->execute();

//４．データ登録処理後
if ($status == false) {
    sql_error($stmt);
} else {
    redirect("user.php");
}
}