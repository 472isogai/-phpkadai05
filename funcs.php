<?php

//XSS対応（ echoする場所で使用！それ以外はNG ）
function h($str)
{
    return htmlspecialchars($str, ENT_QUOTES);
}

//DB接続
function db_conn(){
    try {
        $db_name = 'gs_db_class'; //データベース名
        $db_id = 'root'; //アカウント名
        $db_pw = ''; //パスワード：MAMPは‘root’
        $db_host = 'localhost'; //DBホスト     

        $pdo = new PDO('mysql:dbname=' . $db_name . ';charset=utf8;host=' . $db_host, $db_id, $db_pw);
        return $pdo;
    } catch (PDOException $e) {
        exit('DB Connection Error:' . $e->getMessage());
    }
}

// $db_name・・・データベース名を入れる
// $db_id ・・・データベースユーザー名を入れる
// $db_pw・・・データベースパスワードを入れる
// $db_host・・・データベースサーバを入れる
// （～.db.sakura.ne.jpとなっているほうです）


//SQLエラー
function sql_error($stmt)
{
    //execute（SQL実行時にエラーがある場合）
    $error = $stmt->errorInfo();
    exit('SQLError:' . $error[2]);
}

//リダイレクト
function redirect($file_name)
{
    header('Location: ' . $file_name);
    exit();
}


// ログインチェク処理 loginCheck()
function loginCheck()
{
    if (!isset($_SESSION['chk_ssid']) || $_SESSION['chk_ssid'] != session_id()) {
        header('Location: login.php');
        exit('LOGIN ERROR');
    }
    // SESSION idを変更して保存し直す
    session_regenerate_id();
    $_SESSION['chk_ssid'] = session_id();
}

?>
