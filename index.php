<?php
require_once "../tools.php";
?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>サンプル集</title>
	<meta charset="utf-8" />
	<link rel="stylesheet" href="style.css" />
</head>
<body>
	<div>
		<h1>サンプル集</h1>
		このページは初代管理人が作ったサンプルです。
		<br />
		ご自由にご利用ください。
		<br />
		このサンプル集はVisualStudio 2015でページを書いています。
		<br />
		(ちょっとした修正だけNotepad++)
	</div>
	<div class="left">
		<article>
			<h2>
				<a href="search_pct2zip/">PHPで郵便番号検索</a>
			</h2>
			住所をテキストボックスに入力すると郵便番号を検索できるサンプルです。
			<br />
			[php]で書いています。
		</article>
		<article>
			<h2>
				<a href="search_zip2pct/">PHPで住所検索</a>
			</h2>
			住所を検索できるサンプルです。
			<br />
			[php]と[javascript]で書いています。
		</article>
		<article>
			<h2>
				<a href="select_pct/">javascriptで非同期通信</a>
			</h2>
			都道府県と市区町村と町域をセレクトボックスで選択すると郵便番号を表示できるサンプルです。
			<br />
			主に[javascript]と[php]で書いています。
		</article>
	</div>
	<div class="right">
		<span>
			<input id="text" type="text" style="width:80%" />
			<input type="button" value="送信" style="width:15%" />
		</span>
		<div >
			<div style="text-wrap:avoid">
				これはテキスト
			</div>
			<div>
				これは長い文章これは長い文章これは長い文章これは長い文章これは長い文章これは長い文章これは長い文章これは長い文章これは長い文章これは長い文章これは長い文章これは長い文章これは長い文章
			</div>
		</div>

	</div>
</body>
</html>
