<?php
require_once "../../ken.php";
$result="";
if(isset($_GET['zipcode'])){
	$_POST['zipcode']=$_GET['zipcode'];
}

if(isset($_POST['zipcode'])){

	$zipcode=trim($_POST['zipcode']);

	if($zipcode != ""){
		if(strpos($zipcode,"-")>-1){
			$zipcode=str_replace("-","",$zipcode);
		}
		$mysqli=sql_connect('localhost', 'public', 'PSeVOInT1l', 'public');

		$arr=array($zipcode);
		$sql="SELECT * FROM `zipcode` WHERE `zip_code` = ? ";

		$rows=sql_prepare($mysqli,$sql,$arr);
		if(count($rows)>0){
			foreach( $rows as $row){
				$result="郵便番号 {$row['zip_code']} の住所は<br>{$row['prefectural_name']} {$row['city_name']} {$row['town_name']}";
				$result.="<br>\r\n";
			}
		}
		else{
			$result=sprintf("郵便番号 %s の住所は存在しません\n", $zipcode);
		}
		$mysqli->close();
	}
}
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>PHPで住所検索</title>
	<meta charset="utf-8" />
	<script src="Ken.js"></script>
	<link rel="stylesheet" href="style.css">
</head>
<body>
	<?php include ("../header.html");?>
<div class="demo">
		<table>
			<tr>
				<td>郵便番号</td>
				<td>
					<input id="zip" type="text" />
					<input id="Button1" type="button" value="検索" onclick="search()" />
				</td>
			</tr>
			<tr>
				<td>都道府県</td>
				<td>
					<select id="pref">
						<option id="-1">選択してください</option>
						<?= ken_list(); ?>
					</select>
					<!--<input id="pref" type="text" />-->
				</td>
			</tr>
			<tr>
				<td>住所</td>
				<td>
					<input id="addr" type="text" />
				</td>
			</tr>
		</table>

	</div>

	<div class="demo">
		<table>
			<tr>
				<td>郵便番号→住所 検索</td>
			</tr>
			<tr>
				<td>
					<form method="post">
						<input id="zipcode" name="zipcode" type="text" />
						<br />
						<input type="submit" value="検索" />
					</form>
				</td>
			</tr>
			<tr>
				<td>
					<?php echo $result ?>
				</td>
			</tr>
		</table>
	</div>
	<?php include ("../footer.html");?>
</body>
</html>

