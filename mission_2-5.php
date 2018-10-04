<!DOCTYPE>
<htmllang="ja">
<head>
<meta charset="UTF-8">
<body>

<pre>

<?php

$name=$_POST['name'];
$comment=$_POST['comment'];
$hide=$_POST['hide'];
$date=date('Y年m月d日　H時i分s秒');
$filename='mission_2-5_honda.txt';
$pass="cosmos";


//条件分岐①→コメント編集
if(isset($_POST['hide'])&&($_POST['hide'])!=""){//編集対象番号が入力されている時
 $line=file($filename);//テキストファイルの中身を配列に取り込む
 $clock=count($line);//ファイルの行数を読み込み
 $fp=fopen($filename,'r+');//ファイルの中身の読み取り
 ftruncate($fp,0);//ファイルを空にする
 fclose($fp);//ファイルを閉じる
 for($i=0;$i<$clock;$i++){ //ファイルの行数分ループ処理させる
 	if($i == $hide-1){//編集対象番号が一致する場合の差し替え
		$fp = fopen($filename,'a+');
		fwrite($fp, $hide);
		fwrite($fp, "<>".$name."<>".$comment."<>".date("Y年m月d日H時i分s秒")."\n");//投稿番号抜きで書き込む
 		fclose($fp);//ファイルを閉じる

	}else{//一致しない場合の書き込み
            $fp=fopen($filename,'a');//ファイルの読み取り
            fwrite($fp,$line[$i]);//書き込む
            fclose($fp);//ファイルを閉じる
	     }
	} 
	
 }


//条件分岐②→コメント
if(!empty($_POST["comment"]) && empty($_POST["hide"])){//コメントが入力されていて、編集対象番号が空の時のみ
 	$filename='mission_2-5_honda.txt';//ファイルの指定
 	$fp=fopen($filename, 'a');//ファイルを開いて読み取り
 	$line1=file($filename);//テキストファイルの中身を配列に取り込む
 	$num=1;//投稿番号のずれを防ぐ
 	$num=count($line1);//投稿番号付け
 	$num++;
 	fwrite($fp, $num."<>".$name."<>".$comment."<>".date("Y年m月d日H時i分s秒")."\n");//書き込む
 	fclose($fp);//ファイルを閉じる

}

//条件分岐③→削除対象番号
if(isset($_POST["delete"])&&($_POST["delete"])!=""){//削除対象番号が入力されたか確認
   if($_POST["pw"]==$pass){
 	$filename='mission_2-5_honda.txt';//ファイルの指定
 	$line2=file($filename);//テキストファイルの中身を配列に取り込む
 	$fp2=fopen($filename,'r+');//ファイルの中身の読み込み
 	ftruncate($fp2,0);//ファイルを空にする
 	fclose($fp2);//ファイルを閉じる
 		foreach($line2 as $value1){ //ループ処理
 		$line2=explode("<>",$value1); //読み込んだファイルの中身の文字列の分割・取り出し

			//削除番号と一致する場合は空欄にして、一致しない場合は行ごとにファイルに書き込む
			if($line2[0]==$_POST["delete"]){ //$line2[0}は仮の値
 				$fp=fopen('mission_2-5_honda.txt','a');//ファイル開いて読み取り
 				fwrite($fp,"");//書き込む
 				fclose($fp);//ファイルを閉じる

     			 }else{//一致しない場合の書き込み
            			$all1=$value1;
	    			$filename='mission_2-5_honda.txt';//ファイルの指定
            			$fp=fopen($filename,'a');//ファイルの読み取り
            			fwrite($fp,$all1);//書き込む（上のコメントのところで行ごとに書き込んでいるから"\n"いらない）
            			fclose($fp);//ファイルを閉じる
         		  }
		     }
    }else{
	 echo "Wrong Password.";
     }
  }
//条件分岐③→編集対象番号
if(isset($_POST['edit'])&&($_POST['edit'])!=""){//編集対象番号が入力されたか確認
   if($_POST["pw"]==$pass){
 	$filename='mission_2-5_honda.txt';//ファイルの指定
 	$fp=fopen($filename,'r+');
 	fclose($fp);
 	$line3=file($filename);
 	$clock2=count($line3);
 	$edit=$_POST['edit'];
   		for($i=0;$i<$clock2;$i++){

		//編集対象番号と一致する場合は配列の値の名前とコメントを取得する
			if($i==$edit-1){
				$line3=explode("<>",$line3[$i]);
 				$name2=$line3[1];
 				$comment2=$line3[2];

			}else{
		     }
 	 	 }
    }else{
	echo "Wrong Password.";
    }
}

?>

</pre>

<!--入力フォームの作成-->
<form action="mission_2-5.php" method="post">

＊カービィゲッターズのみんなへおねがい＊
<br><br>
＊名前とコメントの入力をお願いします！
<br>
＊パスワードは「cosmos」です
<br>
＊削除/編集はパスワードを入力すると動作します！
<br>
＊ご協力よろしくお願いします！by みっきー
<br><br>

<!--入力フォームの中身の設定-->
<input type="text" name="name" placeholder="名前" value="<?php echo $name2; ?>">
<br><input type="text" name="comment" placeholder="コメント" value="<?php echo $comment2; ?>">
<input type="submit"name="button1" value="送信">
<br><input type="hidden" name="hide" min="1" placeholder="" value="<?php echo $edit; ?>">
</form>

<form action="mission_2-5.php" method="post">
<input type="number" name="delete" min="1" placeholder="削除対象番号">
<br><input type="password" name="pw" placeholder="パスワード">
<input type="submit" name="button2" value="削除">
</form>

<form action="mission_2-5.php" method="post">
<input type="number" name="edit" min="1" placeholder="編集対象番号">
<br><input type="password" name="pw" placeholder="パスワード">
<input type="submit" name="button3" value="編集">
</form>


<?php
//ブラウザ表示（出力）
$filename='mission_2-5_honda.txt';//ファイルの指定
$fp=fopen($filename,'a');//ファイルの読み取り
$line5=file($filename);//ファイルの中身を配列に取り込む
foreach($line5 as $value4){ //ループ処理
 $line5=explode("<>",$value4);//読み込んだファイルの中身の文字列の分割・取り出し
 echo $line5[0];
 echo $line5[1];
 echo $line5[2];
 echo $line5[3]."<hr>";
}

?>

</pre>
</body>
</head>
</html>