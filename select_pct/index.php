<?php
//ブラウザ確認情報
//Win10&Firefox OK
//Win10&Edge OK
//Win10&Chrome OK
//Win10&InternetExplorer OK

require_once "../../ken.php";
?>

<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>javascriptで非同期通信</title>
	<script src="sample.js"></script>
	<meta charset="utf-8" />
</head>
<body>
	<?php include ("../header.html");?>
	<table>
		<tr>
			<td>都道府県を選択してください</td>
			<td>
				<select id="pref" onchange="pref_change(this)">
					<option id="-1">選択してください</option>
					<?= ken_list(); ?>
				</select>
			</td>
		</tr>
		<tr>
			<td>市区町村を選択してください</td>
			<td>
				<select id="city" onchange="city_change(this)">
					<option>選択してください</option>
				</select>
			</td>
		</tr>
		<tr>
			<td>町域名を選択してください</td>
			<td>
				<select id="town" onchange="town_change()">
					<option>選択してください</option>
				</select>
			</td>
		</tr>
		<tr>
			<td>検索結果</td>
			<td>
				<div id="zip"></div>
			</td>
		</tr>
	</table>
	<?php include ("../footer.html");?>
</body>
</html>
