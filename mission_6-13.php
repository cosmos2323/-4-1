<?php
//h()関数を読み込む
require_once 'mission_6-4.php';
//checkInput()関数を読み込む
require_once 'mission_6-10.php';
//メール送信用のsendmail()関数を読み込む
require_once 'mission_6-12.php';

//メールの宛先
$mailTo = 'mailaddress';
//メールのタイトル
$subject = '【就活CHAT】会員登録用URLのお知らせ';

//Return-Pathに指定するメールアドレス
$returnMail = $mailTo;

//クリックジャッキング対策
header('X-FRAME-OPTIONS: SAMEORIGIN');

//セッションを開始する
session_start();

//POSTされたデータをチェック
$_POST = checkInput($_POST);

//トークンを確認する
if (isset($_POST['token']) && isset($_SESSION['token'])){
      $token = $_POST['token'];
      if ($token != $_SESSION['token']){
         echo '不正アクセスの疑いがあります。';
      }
  }else{
      echo '不正アクセスの疑いがあります。';
  }


//変数にセッション変数を代入する
$name    = $_SESSION['name'];
$email   = $_SESSION['email'];
$comment = $_SESSION['comment'];
$boby    = mt_rand(1000, 9999);
mb_language('japanese');
mb_internal_encoding('UTF-8');

//mbstringの日本語設定を行う
mb_language('ja');
mb_internal_encoding('UTF-8');

//送信結果をお知らせする変数を初期化する
$message = '';

//メールの送信と結果の判定をする
$result = sendmail($name, $email, $mailTo, $subject, $comment, $body, $returnMail);
if ($result){
  $message = 'メールをお送りしました。';
//セッション変数を破棄する
  $_SESSION = array();
  session_destroy();
}else{
  $message = 'メールの送信に失敗しました。';
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width,initial-scale=1.0">
<title>メール送信</title>
</head>
<body>
<div id="mailbox">
  <h1>メール送信フォーム</h1>
  <p><?php echo h($message); ?></p>
</div>
</body>
</html>
