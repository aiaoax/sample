<?php
/*
郵便番号を選択して、都道府県と市区町村を親ウィンドウに入れます
 */
require_once "../ken.php";
if(isset($_GET['zipcode'])){
	$_POST['zipcode']=$_GET['zipcode'];
}
$zipcode=trim($_POST['zipcode']);
$rows=ken_rows($zipcode);
$cnt=count($rows);

$load= $cnt === 1 ? "onload=\"pref();\"" : "";
?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>検索結果</title>
	<meta charset="utf-8" />
	<script>
<?php if($cnt>1):?>
		function sendpref(clk) {
			if (!window.opener || window.opener.closed) {
				window.alert('メインウィンドウがありません');
			}
			else {
				txt = clk.innerText;
				txts = txt.split(' ');
				window.opener.document.getElementById("zip").value = txts[0];
				window.opener.document.getElementById("pref").value = txts[1];
				window.opener.document.getElementById("addr").value = txts[2];
			}
			window.close();
			return false;
		}
<?php else:?>
		function pref() {
			if (!window.opener || window.opener.closed) {
				window.alert('メインウィンドウがありません');
			}
			else {
				window.opener.document.getElementById("zip").value = "<?= "{$rows[0]['zip_code']}" ?>";
				window.opener.document.getElementById("pref").value = "<?= "{$rows[0]['prefectural_name']}" ?>";
				window.opener.document.getElementById("addr").value = "<?= "{$rows[0]['city_name']}{$rows[0]['town_name']}" ?>";
			}
			window.close();
			return false;
		}
<?php endif;?>
	</script>
	<style>
		.send {
			display: inline-block;
			color: blue;
			border-bottom: 1px solid blue;
		}
	</style>
</head>
<body <?= $load ?>>
	<?php if($cnt>100):?>
	<div>検索結果が100件を超えています</div>
	<form method="get">
		<input id="zipcode" name="zipcode" type="text" />
		<br />
		<input type="submit" value="検索" />
	</form>
	<?php elseif($cnt>0):?>
	<div>検索結果 <?= count($rows)?>件</div>
	<?php foreach($rows as $key=>$value):?>
	<div id="<?= $key ?>" class="send" onclick="sendpref(this)">
		<?= "{$value['zip_code']} {$value['prefectural_name']} {$value['city_name']}{$value['town_name']}" ?>
	</div>
	<br />
	<?php endforeach; ?>
	<?php else:?>
	<div>見つかりませんでした。</div>
	<form method="get">
		<input id="zipcode" name="zipcode" type="text" />
		<br />
		<input type="submit" value="検索" />
	</form>
	<?php endif;?>
</body>
</html>