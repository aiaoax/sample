<?php
require_once "../../ken.php";
$ans="";

if(isset($_GET['address'])){
	$_POST['address']=$_GET['address'];
}

if(isset($_POST['address'])){

	$address=trim($_POST['address']);
	$address=str_replace(" ","",$address);
	$address=str_replace("　","",$address);

	if($address != ""){

		$mysqli=sql_connect('localhost', 'public', 'PSeVOInT1l', 'public');

		$arr=array("%{$address}%");
		$sql="SELECT * FROM `zipcode` WHERE CONCAT(`prefectural_name`,`city_name`,`town_name`) LIKE ? ORDER BY `zip_code` ASC";
		$rows=sql_prepare($mysqli,$sql,$arr);
		$cnt=count($rows);
		if($cnt>0){
			$ans="「{$address}」の検索結果 ({$cnt}件見つかりました)<br>\r\n";
			foreach( $rows as $row){
				$ans.="郵便番号 {$row['zip_code']} 住所 {$row['prefectural_name']} {$row['city_name']} {$row['town_name']}";
				$ans.="<br>\r\n";
			}
		}
		else{
			$ans="見つかりません";
		}

		$mysqli->close();
	}
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>PHPで郵便番号検索</title>
	<meta charset="utf-8" />
</head>
<body>
	<?php include ("../header.html");?>
	<div class="demo">
		<table>
			<tr>
				<td>住所→郵便番号 検索</td>
			</tr>
			<tr>
				<td>
					<form method="post">
						<input id="address" name="address" type="text" />
						<br />
						<input type="submit" value="検索" />
					</form>
				</td>
			</tr>
			<tr>
				<td>
					<?php echo $ans ?>
				</td>
			</tr>
		</table>
	</div>
	<?php include ("../footer.html");?>
</body>
</html>
