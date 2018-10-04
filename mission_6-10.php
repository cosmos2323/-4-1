<?php
//入力値に不正なデータがないかなどをチェックする関数
function checkInput($var)
{
if(is_array($var)){
	return array_map('checkInput',$var);
   }else{
//magic_quotes_gpcへの対策を行う
   if(get_magic_quotes_gpc()){
	 $var = stripslashes($var);
   }
//nullバイト攻撃対策
//nullバイトを含む制御文字が含まれていないかをチェックする（最大1000文字）
/*//    if(preg_match('/\A[\r\n\t[:^cntrl:]]{0,1000}\z/u', $var) == 0){
//	echo '不正な入力です。';
//}
function sanitize($var){
   if(is_array($var)){
        return array_map('sanitize', $var);
   }
   return str_replace("\n0","", $var);
}
$_GET    = sanitize($_GET);
$_POST   = sanitize($_POST);
$_COOKEI = sanitize($_COOKIE);
*/

//文字エンコードの確認を行う
    if(! mb_check_encoding($var, 'UTF-8')){
	echo '不正な入力です。';
    }
    return $var;
  }
}
/* ?>終了タグ省略*/