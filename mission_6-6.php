<?php
//h()関数を読み込む
require_once 'mission_6-4.php';
//クリックジャッキング対策をする
header('X-FRAME-OPTIONS: SAMEORIGIN');

//セッションを開始する
session_start();

//ユーザー名とパスワードを設定する（複数名分）
$userid[] ='admin'; //ユーザーID
$username[]='管理人'; //名前
$password[]='password'; //パスワード

//エラーメッセージの変数を初期化
$error='';

//認証済みかどうかのセッション変数を初期化
if(!isset($_SESSION['auth'])){
  $_SESSION['auth']=false;
}

if(isset($_POST['userid'])&& isset($_POST['password'])){
  foreach($userid as $key =>$value){
     if($_POST['userid']===$userid[$key]){

//セッション固定化攻撃を防ぐためにセッションIDを変更
	session_regenerate_id(true);
	$_SESSION['auth']=true;
	$_SESSION['username']=$username[$key];
	break;
      }
}
if($_SESSION['auth']===false){
	$error='ユーザーIDかパスワードに誤りがあります。';
  }
}

if($_SESSION['auth']!==true){
?>

<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width,initial-scale=1.0">
<title>簡単なログインフォームを作成したい</title>
</head>
<body>
<div id="login">
  <h1>認証フォーム</h1>
  <?php
   if($error){ //エラー文がセットされていれば赤で表示
	echo '<p style="color:red;">'. h($error).'</p>';
    }
    ?>
  <form action="<?php echo h($_SERVER['SCRIPT_NAME']); ?>" method="post">
    <dl>
      <dt><label for="userid">ユーザーID:</label></dt>
      <dd><input type="text" name="userid" id="userid" value=""></dd>
    </dl>
    <dl>
      <dt><label for="password">パスワード:</label></dt>
      <dd><input type="password" name="password" id="password" value=""></dd>
    </dl>
    <input type="submit" name="submit" value="ログイン">
  </form>

  <h1>メール認証フォーム（仮登録）</h1>
  <form action="mission_6-6-1.php" method="post">
    <dl>
      <dt><label for="mail">受信を希望するメールアドレス:</label></dt>
      <dd><input type="text" name="mail" id="mail" value=""></dd>
    </dl>
    <input type="submit" name="submit" value="送信">
  </form>




</div>
</body>
</html>
<?php
//スクリプトを終了し、認証が必要なページが表示されないようにする
	exit();
}
/*?>終了タグ省略*/


