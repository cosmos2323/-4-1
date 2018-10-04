<?php
//h()関数を読み込む
require_once 'mission_6-4.php';

	if(isset($_POST['submit'])){
	   $password=$_POST['password'];

//ハッシュ処理の計算コストを指定する。ソルトは自動生成とする。
  $options=array('cost'=>10);
//ハッシュ化方式にPASSWORD_DEFAULTを指定し、パスワードをハッシュ化する
　$hash=password_hash($password, PASSWORD_DEFAULT, $options);
}
?>
<html>
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset ='utf-8'>
<meta name="viewport" content="width=device-width,initial-scale=1.0">
<title>ハッシュ化済みパスワードを取得するスクリプト</title>
</head>
<body>
<div>
<?php
if(isset($hash)){
	echo '生パスワード: ' . h($password) . '<br>';
	echo 'ハッシュ化済みパスワード: '. h($hash);
}
?>
 <hr>
 <form action="password_hash.php" method="post">
    <label for="password">ハッシュ化したいパスワード文字列:</label>
    <input type="text" name="password" id="password" value="">
    <input type="submit" name="submit" value="ハッシュ化">
 </form>
</div>
</body>
</html>
