<html>
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset ='utf-8'>
<meta name="viewport" content="width=device-width,initial-scale=1.0">
<title>エスケープしてブラウザに表示する</title>
</head>
<body>
<div>
<pre>
<?php
//h()関数を読み込む
require_once 'mission_6-4.php';

$string="<cite>就活CHAT</cite>";
	echo "そのまま表示: {$string}<br>\n";
	echo 'htmlspecialchars()関数でエスケープ処理: ' . h($string) . "\n";
?>
</pre>
</div>
</body>
</html>
