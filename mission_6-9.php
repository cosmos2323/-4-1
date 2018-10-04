<?php
//h()関数の読み込み
require_once 'mission_6-4.php';

//クリックジャッキング対策をする
header('X-FRAME-OPTIONS: SAMEORIGIN');

//セッションを開始する
session_start();

//固定トークンを生成してセッション変数に保存する
//隠しフィールドを出力する
if(! isset($_SESSION['token'])){
   $_SESSION['token'] = hash('sha256', session_id());
}
$token=$_SESSION['token'];
?>
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width,initial-scale=1.0">
<title>メール送信フォーム</title>
</head>
<body>
<div id="mailbox">
  <h1>お問い合わせフォーム</h1>
<?php
//エラーがあったら表示する
if(isset($_SESSION['error'])){
  foreach($_SESSION['error'] as $value){
    echo ' <span style="color:red;">' . h($value) . '</span><br>' . "\n";
  }
}

//三項演算子を使用して、セッションに保存されたデータ
//がある場合、変数に代入する
$name=isset($_SESSION['name'])  ? $_SESSION['name']   :'';
$email=isset($_SESSION['email'])  ? $_SESSION['email']  :'';
$comment=isset($_SESSION['comment'])  ? $_SESSION['comment']  :'';
?>

   <p>*印は必須入力事項です。タグは無効化します。</p>
   <form action="mission_6-11.php" method="post">
     <dl>
        <dt><label for="name">お名前(*):</label></dt>
	<dd><input type="text" name="name" id="name"
	     value="<?php echo h($name); ?>" maxlength="100" required></dd>
     </dl>
     <dl>
	<dt><label for="email">メールアドレス(*):</label></dt>
	<dd><input type="email" name="email" id="email"
	     value="<?php echo h($email); ?>" maxlength="256" required></dd>
     </dl>
     <dl>
        <dt><label for="comment">コメント(*)(500文字以内):</label></dt>
 	<dd><textarea rows="6" cols="30" id="comment" name="comment"
	    maxlength="500" required><?php echo h($comment); ?></textarea></dd>
     </dl>
     <input type="hidden" name="token" value="<?php echo h($token); ?>">
     <input type="submit" name="submit" value="入力内容チェック">
   </form>
</div>
</body>
</html>