<!DOCTYPE html>
<html lang="ja">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta http-equiv="Content-Style-Type" content="text/css">
<meta http-equiv="content-script-type" content="text/javascript">
<title>アドレス帳[管理画面]</title>
<link href="css/base.css" rel="stylesheet" type="text/css">
<link href="css/common.css" rel="stylesheet" type="text/css">
<link href="css/register.css" rel="stylesheet" type="text/css">
<body>
<div id="wrapper">
  <?php include("header.php");?>
<script>
    //登録ボタンをクリックしたときの処理
    function confirm_register() { // 登録ボタンをクリックした場合
        document.getElementById('popup').style.display = 'block';
        return false;
    }
    function okfunc() { // OKをクリックした場合
        document.contactform.submit();
    }
    function nofunc() { // キャンセルをクリックした場合
        document.getElementById('popup').style.display = 'none';
    }
    
    //住所を郵便番号を入力して自動検索する処理（Ajax）
    function getAddress() {
      var FormZip = document.getElementById("FormZip").value;//郵便番号値の取得
      var ajax = new XMLHttpRequest();//オブジェクトの作成
      ajax.open("get", "yubinjson.php?post="+FormZip);//
      ajax.responseType = "json";
      ajax.send(); // 通信開始
      ajax.addEventListener("load", function(){ // loadイベントを登録
        var json = this.response;//yubinjson.phpの通信結果の受領
        var pref = "";
        var city = "";
        var address = "";
        for (var i=0; i<json.length;i++) { //複数結果を受領して最初の１行目を表示
          pref = json[i]["pref"];
          city = json[i]["city"];
          address = json[i]["address"];
          break;
        }
        //県表示がselectタグになっているための処理
        var prefSelect = document.getElementById("FormPref");
        for (var i = 0; i<prefSelect.options.length; i++) { //複数結果を受領して最初の１行目を表示
          if (prefSelect.options[i].value == pref) {
            prefSelect.options[i].selected = true;//Optionタグをselected表示にする
            break;
          }
        }
        document.getElementById("FormCity").value = city;
        document.getElementById("FormHouseNumber").value = address;
      }, false);
    }
</script>
  <div id="container">
    <div id="formArea">
      <form action="" method="post" name="contactform" enctype="multipart/form-data">
        <table summary="<?=$title?>">
          <tbody>
          <tr>
            <th><label for="FormNameSei">登録者</label><span class="required">（必須）</span></th>
              <td class="inputName">
                <label for="FormNameSei">姓&nbsp;&nbsp;：</label><input type="text" name="name_sei" required id="FormNameSei" value="<?=$name_sei?>"> <!--?php echoと同じ-->
                <label for="FormNameMei">名&nbsp;&nbsp;：</label><input type="text" name="name_mei" required id="FormNameMei" value="<?=$name_mei?>">
              </td>
          </tr>
          <tr>
            <th><label for="FormNameSeiKana">登録者・フリガナ</label></th>
            <td class="inputName">
              <label for="FormNameSeiKana">セイ：</label><input type="text" name="name_sei_kana" id="FormNameSeiKana" value="<?=$name_sei_kana?>">
              <label for="FormNameMeiKana">メイ：</label><input type="text" name="name_mei_kana" id="FormNameMeiKana" value="<?=$name_mei_kana?>">
            </td>
          </tr>
          <tr>
            <th><label for="Season">季節</label><span class="required">（必須）</span></th>
            <td>
              <label for="FormSeason1"><input type="radio" name="season" id="spring" value="春" <?php if ($season=="春") {echo "checked";} ?>>春</label>
              <label for="FormSeason2"><input type="radio" name="season" id="summer" value="夏" <?php if ($season=="夏") {echo "checked";} ?>>夏</label>
              <label for="FormSeason3"><input type="radio" name="season" id="autumn" value="秋" <?php if ($season=="秋") {echo "checked";} ?>>秋</label>
              <label for="FormSeason4"><input type="radio" name="season" id="winter" value="冬" <?php if ($season=="冬") {echo "checked";} ?>>冬</label>
            </td>
          </tr>
          <tr>
            <th><label for="RegisterDay">登録年月日</label></th>
            <td>
              <input type="text" name="year" value="<?=$year?>" class="inputText50" maxlength="4">
              年
              <select name="month">
                <option value=""></option>
                <script>
                  var mm = <?=$month?>;
                  for (var i=1; i <= 12; i++) {
                    if (i == mm) {
                      document.write('<option value="' + ('00' + i).slice(-2) + '" selected>' + ('00' + i).slice(-2) + '</option>');
                    } else {
                      document.write('<option value="' + ('00' + i).slice(-2) + '">' + ('00' + i).slice(-2) + '</option>');
                    }
                  }
                </script>
              </select>
              月
              <select name="day">
                <option value=""></option>
                <script>
                  var dd = <?=$day?>;
                  for (var i=1; i <= 31; i++) {
                    if (i == dd) {
                      document.write('<option value="' + ('00' + i).slice(-2) + '" selected>' + ('00' + i).slice(-2) + '</option>');
                    } else {
                      document.write('<option value="' + ('00' + i).slice(-2) + '">' + ('00' + i).slice(-2) + '</option>');
                    }
                  }
                </script>
              </select>
              日
            </td>
          </tr>
          <tr>
            <th><label for="category">カテゴリ</label></th>
            <td>
              <select name="category" id="CategoryList" empty="1" value="<?=$category?>"><option value=""></option>
              <script>
                  //カテゴリのリスト
                  var categoryList = ["グルメ","温泉","自然","体験","歴史","街歩き","テーマパーク","スポーツ/アウトドア","夜景"];
                  var category = "<?=$category?>";
                  for (var i=0; i < categoryList.length; i++) {
                    if (categoryList[i] == category) {
                      document.write('<option value="' + categoryList[i] + '" selected>' + categoryList[i] + '</option>'); //住所の登録県を編集時に表示させるためにSelectedを追加
                    } else {
                      document.write('<option value="' + categoryList[i] + '">' + categoryList[i]  + '</option>');
                    }
                  }
                </script>
            </td>
          </tr>
          <tr>
            <th><label for="Subject">タイトル（観光地名）</label></th>
            <td>
              <input type="text" name="subject" id="subject" value="<?=$subject?>" class="inputText400">
            </td>
          </tr>
          <tr>
            <th><label for="SiteInfo">観光地の基本情報</label></th>
            <td class="inputAddress">
              <p><label for="FormZip">郵便番号：</label><input type="text" name="zip" id="FormZip" value="<?=$zip?>" class="inputText100" maxlength="7" size="7" pattern="^[0-9]{7}$">
              <span class="inputRule">ハイフン無し半角数字（中国地方エリア対応）</span></p>
              <p><label>&nbsp;</label><input type="button" value="郵便番号から住所自動入力" class="insertAddress" onclick="getAddress()"></p>
              <p><label for="FormPref">都道府県：</label><select name="pref" id="FormPref" empty="1" value="<?=$pref?>"><option value=""></option>
               <script>
                  //県名のリスト
                  var jyusho = ["鳥取県","島根県","岡山県","広島県","山口県"];
                  var pref = "<?=$pref?>";
                  for (var i=0; i < jyusho.length; i++) {
                    if (jyusho[i] == pref) {
                      document.write('<option value="' + jyusho[i] + '" selected>' + jyusho[i] + '</option>'); //住所の登録県を編集時に表示させるためにSelectedを追加
                    } else {
                      document.write('<option value="' + jyusho[i] + '">' + jyusho[i]  + '</option>');
                    }
                  }
                </script>
              </select>
              </p>
              <p><label for="FormCity">市区町村：</label><input type="text" name="city" id="FormCity" value="<?=$city?>" class="inputText200"></p>
              <p><label for="FormHouseNumber">番地等：</label><input type="text" name="house_number" id="FormHouseNumber" value="<?=$house_number?>" class="inputText200"></p>
              <p><label for="FormBuilding">建物名：</label><input type="text" name="building" id="FormBuilding" value="<?=$building?>" class="inputText200"></p>
            　<p><label for="FormTel">電話番号：</label><input type="text" name="tel" id="FormTel" value="<?=$tel?>" class="inputText200"></p>
              <p><label for="FormEmail">E-mail：</label><input type="text" name="email" id="FormCompany" value="<?=$email?>" class="inputText200"></p>
            </td>
          </tr>
          <tr>
            <th><label for="FormMemo">観光地の説明メモ</label></th>
            <td>
              <textarea name="memo" id="FormMemo" rows="10"><?=$memo?></textarea>
            </td>
          </tr>
        <tr>
          <th><label for="image">添付ファイル</label><span class="required">（必須）</span></th>
        <td>
          <input type="file" name="image" id="image" value="<?=$filecontents?>" class="inputText400">
        </td>
        </tr>
        <tr>
          <?php
          if ($page == "1") {
            // 季節
          ?>
          <th><label for="FormMemo">季節表示番号</label></th>
          <td>
              <input type="text" name="sequence" id="sequence" value="<?=$sequence?>" class="inputText400">
          </td>
          <?php
          } else {
            // ランキング
          ?>
          <th><label for="FormMemo">ランキング番号</label></th>
          <td>
              <input type="text" name="sequence" id="sequence" value="<?=$sequence?>" class="inputText400">
          </td>
          <?php
          }
          ?>
        </tr>
        </tbody>
        </table>
        <div class="formButton">
          <input type="hidden" name="filecontents" value="<?=$filecontents?>">
          <input type="hidden" name="id" value="<?=$id?>">
          <input type="submit" value="登録" class="submit" name="regist" onclick="return confirm_register()">
        </div>
        </form>
      <!--end div#formArea-->
    </div>
    <!--end div#container-->
  </div>
  <!--end div#wrapper-->
  <div id="popup" class="popup">
        <br><br>登録しますか？<br><br>
        <button class="ok" onclick="okfunc()">OK</button>
        <button class="no" onclick="nofunc()">キャンセル</button>
  </div>
</div>
</body>
</html>