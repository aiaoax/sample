<?php
//トップページにあるファイルを読み込んでいます。
//C言語の#includeみたいなやつ
require_once "../../ken.php";

//MySQLサーバに接続
$mysqli=sql_connect('localhost', 'public', 'PSeVOInT1l', 'public');

if(isset($_GET['pref'])&&isset($_GET['city'])&&isset($_GET['town'])){
	//都道府県名を取得
	$pref=trim($_GET['pref']);
	//市区町村名を取得
	$city=trim($_GET['city']);
	//町域名を取得
	$town=trim($_GET['town']);
	//都道府県か市区町村名か町域名が空白ならば終了
	if($pref==""||$city==""||$town==""){
		header('HTTP', true, 400);
		break;
	}
	//配列に都道府県名と市区町村名と町域名を挿入
	$arr=array($town,$city,$pref);
	$sql="SELECT `zip_code`,`prefectural_kana`,`city_kana`,`town_kana` FROM `zipcode` WHERE `town_name` = ? AND `city_name` = ? AND `prefectural_name` = ? ";
	//SQL文実行
	$rows=sql_prepare($mysqli,$sql,$arr);
	//結果が1件以上の場合は結果を出力
	if(count($rows)>0){
		//郵便番号をぐるぐる出力
		foreach( $rows as $row){
			print("{$row['zip_code']},{$row['prefectural_kana']},{$row['city_kana']},{$row['town_kana']}\r\n");
		}
	}
	//結果がないときはエラーを出して終了
	else{
		print("error");
		header('HTTP', true, 400);
		break;
	}
}
//都道府県と市区町村がセットされているとき
else if(isset($_GET['pref'])&&isset($_GET['city'])){
	//都道府県名を取得
	$pref=trim($_GET['pref']);
	//市区町村名を取得
	$city=trim($_GET['city']);
	//都道府県か市区町村が空白ならば終了
	if($pref==""||$city==""){
		header('HTTP', true, 400);
		break;
	}
	//配列に都道府県名と市区町村名を挿入
	$arr=array($pref,$city);
	$sql="SELECT DISTINCT `town_name` FROM `zipcode` WHERE `prefectural_name` = ? AND `city_name` = ? ";
	//SQL文実行
	$rows=sql_prepare($mysqli,$sql,$arr);
	//結果が1件以上の場合は結果を出力
	if(count($rows)>0){
		//町域名をぐるぐる出力
		foreach( $rows as $row){
			print("{$row['town_name']}\r\n");
		}
	}
	//結果がないときはエラーを出して終了
	else{
		print("error");
		header('HTTP', true, 400);
		break;
	}
}
//都道府県のみ
//上とあまり変わらないから、コメント書かなくていいよね
else if(isset($_GET['pref'])){
	$pref=trim($_GET['pref']);
	if($pref=="")exit;
	$arr=array($pref);
	$sql="SELECT DISTINCT `city_name` FROM `zipcode` WHERE `prefectural_name` = ? ";
	$rows=sql_prepare($mysqli,$sql,$arr);
	if(count($rows)>0){
		foreach( $rows as $row){
			print("{$row['city_name']}\r\n");
		}
	}
	else{
		print("error");
		header('HTTP', true, 400);
	}
}
else{
	header('HTTP', true, 400);
}
$mysqli->close();

?>