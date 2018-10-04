<?php
//セッションを開始する
session_start();
//セッションを破棄する
$_SESSION=array();
session_destroy();
?>
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width,initial-scale=1.0">
<title>ログアウト</title>
</head>
<body>
<div>
   <p>ログアウトしました。</p>
   <p><a href="mission_6-7.php">戻る</a></p>
</div>
</body>
</html>