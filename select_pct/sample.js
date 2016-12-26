function pref_change(obj) {
	//市区町村セレクトボックスを取得
	city_obj = document.getElementById("city");
	//選択項目をリセット
	city_obj.innerHTML = "<option>選択してください</option>";
	//町域セレクトボックスを取得
	town_obj = document.getElementById("town");
	town_obj.innerHTML = "<option>選択してください</option>";
	//都道府県セレクトボックスの値を取得
	pref = obj.value;
	//URLを作成
	url = encodeURI("select.php?pref=" + pref);
	//非同期通信準備
	httpObj = new XMLHttpRequest();
	//GETで送信します。
	httpObj.open("GET", url, true);
	//実際に通信を開始します
	httpObj.send(null);
	//通信状況が変わったとき
	httpObj.onreadystatechange = function () {
		//通信が終了して、成功だった場合
		if ((httpObj.readyState == 4) && (httpObj.status == 200)) {
			//結果を取得
			txt = httpObj.responseText;
			//php側でエラーが出たときは[error]を出力しています
			//なので結果が[error]だった場合は終了
			if (txt === "error") return;
			//一行ずつに分割します。
			cities = txt.trim().split("\r\n");
			//取得した市区町村の数だけ繰り返します
			for (var city in cities) {
				//市区町村セレクトボックスに選択した都道府県にある市区町村を追加します。
				city_obj.innerHTML += "<option>" + (cities[city]).trim() + "</option>";
			}
		}
	}
}

function city_change(obj) {
	//上とそんなに変わらないから説明は不要だよね
	pref = document.getElementById("pref").value;
	city = obj.value;
	town_obj = document.getElementById("town");
	town_obj.innerHTML = "<option>選択してください</option>";
	url = encodeURI("select.php?pref=" + pref + "&city=" + city);
	httpObj = new XMLHttpRequest();
	httpObj.open("GET", url, true);
	httpObj.send(null);
	httpObj.onreadystatechange = function () {
		if ((httpObj.readyState == 4) && (httpObj.status == 200)) {
			txt = httpObj.responseText;
			if (txt === "error") return;
			towns = txt.trim().split("\r\n");
			for (var town in towns) {
				town_obj.innerHTML += "<option>" + (towns[town]).trim() + "</option>";
			}
		}
	}
}

function town_change() {
	//都道府県セレクトボックスを取得
	pref = document.getElementById("pref").value;
	//市区町村セレクトボックスを取得
	city = document.getElementById("city").value;
	//町域セレクトボックスを取得
	town = document.getElementById("town").value;

	zip_obj = document.getElementById("zip");
	zip_obj.innerHTML = "";
	url = encodeURI("select.php?pref=" + pref + "&city=" + city + "&town=" + town);
	httpObj = new XMLHttpRequest();
	httpObj.open("GET", url, true);
	httpObj.send(null);
	httpObj.onreadystatechange = function () {
		if ((httpObj.readyState == 4) && (httpObj.status == 200)) {
			txt = httpObj.responseText;
			if (txt === "error") return;
			zips = txt.trim().split("\r\n");
			for (var zip in zips) {
				zpct = zips[zip].trim().split(",");
				//例 大阪府 大阪市阿倍野区 丸山通 の郵便番号は5450042です
				zip_obj.innerHTML += "<ruby>" + pref + "<rt>"+zpct[1]+"</rt> " + city + "<rt>"+zpct[2]+"</rt> " + town + "<rt>"+zpct[3]+"</rt> </ruby>の郵便番号は<b>" + zpct[0] + "</b>です";
			}
		}
	}
}