<html>
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset ='utf-8'>
<title>掲示板を作りたい！</title>
</head>
<body>
<div>
<pre>
<?php

//①データベースへの接続
$dsn='データベース名'; //データベース
$user='ユーザー名'; //ユーザー名
$password='パスワード'; //パスワード
$pdo=new PDO($dsn,$user,$password);
$tb="table1";


//②データベース内にテーブルを作成する(3-2)
$sql ="CREATE TABLE table1"
."("
."id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,"
."name char(32),"
."comment char(32),"
."time TEXT,"
.");";
$stmt = $pdo->query($sql);


/*③テーブル一覧を表示するコマンドを使って作成ができたか確認する。
$sql='SHOW TABLE';
$result=$pdo->query($sql);
foreach((array)$result as $row){
 	echo $row[0];
 	echo '<br>';
}
//④テーブルの中身を確認するコマンドを使って、意図した内容のテーブルが作成されているか確認する。
$result=$pdo->query('SHOW CREATE TABLE table1');
	while($re=$result->fetch(PDO::FETCH_ASSOC)){
	var_dump($re);
	}
echo "テーブル作成が確認できました。<hr>";
*/


//③phpと組み合わせる(データの送受信）

$name=$_POST['name'];
$comment=$_POST['comment'];
$pass="cosmos";

	$dsn='mysql:dbname=tt_127_99sv_coco_com;host=localhost'; //データベース
	$user='tt-127.99sv-coco'; //ユーザー名
	$password='dS6njmg9'; //パスワード
	$pdo=new PDO($dsn,$user,$password);
	$tb="table1";

//④コメント編集
if(!empty($_POST['name']) && !empty($_POST['comment']) && !empty($_POST['hide'])){//名前・コメント・編集対象番号が入力されている時

   	$id=$_POST['hide'];
   	$name2=$name;
   	$comment2=$comment;
   	$result=$pdo->query("update table1 set name='$name2',comment='$comment2' where id=$id");//編集の場所

}

//⑤コメント書き込み
	if(!empty($_POST['name'])){
		if(!empty($_POST['comment'])){
			if(empty($_POST['hide'])){
				if($_POST['pw']==$pass){//名前・コメントが入力されていて、編集対象番号が空の時パスワード入力して送信
		
					//投稿内容を受け取る場所
					$sql=$pdo->prepare("INSERT INTO table1(name,comment,date) VALUES (:name,:comment,:date)");
					$prepare=$pdo->query('SELECT*FROM table1 ORDER BY id;');
						foreach($prepare as $row){
		  				}

						$name=$_POST['name'];
						$comment=$_POST['comment'];
						$hide=$_POST['hide'];
						$pass="cosmos";
						$date=date("Y-m-d H:i:s");

						$sql->bindParam(':name',$name,PDO::PARAM_STR);
						$sql->bindParam(':comment',$comment,PDO::PARAM_STR);
						$sql->bindParam(':date',$date,PDO::PARAM_STR);
						$sql-> execute();
	 
		}else{
			echo "Wrong Password.";
    		}
	  }
     }
}


//⑥編集対象番号
	if(!empty($_POST['edit'])){//編集対象番号が入力された時
  		 if($_POST['pw']==$pass){
			$name2=$_POST['edit'];

   			//編集の場所
			$sql='SELECT*FROM table1 ORDER BY id';
			$results=$pdo->query($sql);
		  		foreach($results as $row){
				//編集対象番号と一致する場合は配列の値の名前とコメントを取得する
					if($row['id']==$name2){
						$num3=$row['id'];
						$name3=$row['name'];
						$comment3=$row['comment'];
			}else{
		     }
 	 	 }
    }else{
	echo "Wrong Password.";
    }
}


//⑦削除対象番号
if(!empty($_POST['delete'])){//削除対象番号が入力された時
   		if($_POST['pw']==$pass){
			$id_d=$_POST['delete'];
			$sql=$pdo->query("delete from table1 where id=$id_d");
			$prepare=$pdo->prepare("TRUNCATE TABLE table1");
			$result=$pdo->query("ALTER TABLE table1 AUTO_INCREMENT=1");

	}else{
		echo "Wrong Password.";
	}
}

?>

</pre>
</div>
</body>
</html>
<!--⑧入力フォーム作成-->
<form action ="mission_4-1.php" method="POST">
＊カービィゲッターズのみんなへおねがい＊
<br><br>
＊名前とコメントの入力をお願いします！
<br>
＊パスワードは「cosmos」です
<br>
＊名前/コメント/削除/編集はパスワードを入力すると動作します！
<br>
＊おかしいところがあったら教えてもらえると嬉しいです(=^・^=)
<br>
＊ご協力よろしくお願いします！by みっきー
<br><br>

<!--入力フォームの中身の設定-->
<input type="text" name="name" placeholder="名前" value="<?php echo $name3; ?>">
<br><input type="text" name="comment" placeholder="コメント" value="<?php echo $comment3; ?>">
<br><input type="password" name="pw" placeholder="パスワード">
<input type="submit"name="button1" value="送信">
<br><input type="hidden" name="hide" min="1" placeholder="" value="<?php echo $num3; ?>">
</form>

<form action="mission_4-1.php" method="post">
<input type="number" name="delete" min="1" placeholder="削除対象番号">
<br><input type="password" name="pw" placeholder="パスワード">
<input type="submit" name="button2" value="削除">
</form>

<form action="mission_4-1.php" method="post">
<input type="number" name="edit" min="1" placeholder="編集対象番号">
<br><input type="password" name="pw" placeholder="パスワード">
<input type="submit" name="button3" value="編集">
</form>
<?php
//⑨入力したデータをselectによって表示する(3-6)

	$sql='SELECT*FROM table1 ORDER BY id';
	$results=$pdo->query($sql);
//	$all=$results->fetchAll();	//fetchAllで結果を全件配列で取得する
		foreach($results as $row){
			//$rowの中にはテーブルのカラム名が入る
			echo $row['id'].',';
			echo $row['name'].',';
			echo $row['comment'].',';
			echo $row['date'].'<hr>';
}
?>
