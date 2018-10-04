<html>
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset ='utf-8'>
<title>他のファイルを取り込んで利用</title>
</head>
<body>
<div>
<pre>
<?php
//mission_6-2.phpを取り込んで利用する
require_once 'mission_6-2.php';

	echo 'サイト名: '. $site . '<br>';
	echo '管理者名: '. $admin . '<br>';
	echo 'メールアドレス: '. $email .'<br>';
?>
</pre>
</div>
</body>
</html>
