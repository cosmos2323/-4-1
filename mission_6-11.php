<?php
//h()関数の読み込み
require_once 'mission_6-4.php';
//checkInput()関数の読み込み
require_once 'mission_6-10.php';

//クリックジャッキング対策
header('X-FRAME-OPTIONS: SAMEORIGIN');

//セッションを開始する
session_start();

//POSTされたデータをチェックする
$_POST = checkInput($_POST);

//トークンを確認する
if(isset($_POST['token']) && isset($_SESSION['token'])){
   $token = $_POST['token'];
     if($token != $_SESSION['token']){
        echo '不正アクセスの疑いがあります。';
     }
  }else{
    echo '不正アクセスの疑いがあります。';
}

//変数にPOSTされたデータを代入
$name   =isset($_POST['name'])    ? $_POST['name']    :'';
$email  =isset($_POST['email'])   ? $_POST['email']   :'';
$comment=isset($_POST['comment']) ? $_POST['comment'] :'';

//エラーメッセージを保存する配列を初期化する
$error = array();

//名前欄をチェックする
if (trim($name) == ''){
    $error[] = 'お名前は必須項目です。';
  }elseif (mb_strlen($name) > 100){
    $error[] = 'お名前は100文字以内でお願いいたします。';
}
//メールアドレス欄をチェック
if (trim($email) == ''){
    $error[] = 'メールアドレスは必須項目です。';
  }elseif (mb_strlen($email) > 256){
    $error[] = 'メールアドレスは256文字以内でお願いいたします。';
  }else{
   $pattern = '/\A([a-z0-9_\-\+\/\?]+)(\.[a-z0-9_\-\+\/\?]+)*' .
	      '@([a-z0-9\-]+\.)+[a-z]{2,6}\z/i';
     if (! preg_match($pattern, $email)){
        $error[] = 'メールアドレスの形式が正しくありません。';
     }
}
//コメント欄をチェックする
if (trim($comment) == ''){
     $error[] = 'コメントは必須項目です。';
  }elseif (mb_strlen($comment) > 500){
     $error[] = 'コメントは500文字以内でお願いいたします。';
}

//POSTされたデータとエラーメッセージをセッション変数に保存する
$_SESSION['name']    =$name;
$_SESSION['email']   =$email;
$_SESSION['comment'] =$comment;
$_SESSION['error']   =$error;

//エラー数を確認する
if (count($error) > 0){
//エラーがある場合は、mission_6-9の入力フォームに戻す
  $dirname = dirname($_SERVER['SCRIPT_NAME']);
  $dirname = ($dirname == DIRECTORY_SEPARATOR) ? '' : $dirname;
  $uri = 'http://' . $_SERVER['SERVER_NAME'] .
	 $dirname . '/mission_6-9.php';
  header('HTTP/1.1 303 See Other');
  header('Location: ' .$uri);

//確認画面を表示する
}else{
?>
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1.0">
<title>内容確認</title>
</head>
<body>
<div id="mailbox">
  <p>以下の内容でよろしければ送信ボタンを押してください。</p>
  <dl>
     <dt>お名前：</dt>
     <dd><?php echo h($name);?></dd>
  </dl>
  <dl>
     <dt>メールアドレス：</dt>
     <dd><?php echo h($email);?></dd>
  </dl>
  <dl>
     <dt>コメント：</dt>
     <dd><?php echo h($comment);?></dd>
  </dl>
  <form action="mission_6-9.php" method="post">
     <input type="submit" name="back" value="入力画面に戻る">
  </form>
  <form action="mission_6-13.php" method="post">
     <input type="hidden" name="token" value="<?php echo h($token);?>">
     <input type="submit" name="submit" value="送信する">
  </form>
</div>
</body>
</html>

<?php
}
/* ?>終了タグ省略*/