<?php
//ログイン完了前にアクセスした場合、ログインフォームへ飛ばす
@session_start(); 
if(!isset($_SESSION['name'])){
  echo "<script>location.href='Login/login_form.php';</script>";
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title>自由旅管理者設定アプリ</title>
<link href="css/base.css" rel="stylesheet" type="text/css">
<link href="css/register.css" rel="stylesheet" type="text/css">
</head>
<body>
<div id="wrapper">
  <?php include("header.php");?>
  <!--end div#header-->
  <div id="container">
    <h1>
      <span class="title">季節登録リスト</span>
    </h1>
    <!--end h1-->
    <div>
    　<form id="Serach" action="" method="post">
        <input id="sbox" type="text" name="keyword" placeholder="キーワードを入力" />
        <input id="sbtn" type="submit" name="search" value="検索" />
      </form>
    </div>
    <!--end Search-->
    <script>
    //削除確認機能
    function delete_check() { 
    var answer = confirm('本当に削除しますか？');
    return answer
    }
    function checkAll() {
      // テーブルヘッダのチェックボックスで全チェックボックスを連動させる
      var check = document.getElementById("checkboxAll").checked;
      for (var i=1; i <= document.forms[1].elements.length; i++ ) {
        document.forms[1].elements[i].checked = check;
      }
    }
    </script>
      <div id="contentList">
      <form action="delete.php" method="post" id="form" onsubmit="return delete_check()">
        <table summary="アドレス帳">
          <tbody>
          <tr>
            <th width="20" align="center"><input type="checkbox" class="checkAll" id="checkboxAll" onChange="checkAll();"></th>
            <th width="80">季節</th>
            <th width="120">タイトル名</th>
            <th width="120">カテゴリ</th>
            <th width="80">県名</th>
            <th width="80">登録者</th>
            <th>ファイル画像名</th>
            <th width="70">操作</th>
          </tr>
         <?php          
          //登録したアドレス帳テーブルの表示
          include("db_config.php");
          $link = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
          mysqli_set_charset($link, 'utf8');
          //検索機能
          $keyword = "";
          if (isset($_POST["search"])) { 
              // 検索ボタンが押されたときの処理
              if (isset($_POST["keyword"])) {
                  // キーワードが設定された場合
                  $keyword =  $_POST["keyword"];
              }
          }
          if(strlen($keyword) > 0) {
            $sql="SELECT * FROM trip_season WHERE season like '%".$keyword."%' OR category like '%".$keyword."%' OR subject like '%".$keyword."%' OR pref like '%".$keyword."%';";
          }else {
            //春、夏、秋、冬の順番に表示
            $sql="select 
             case season 
               when '春' then 1
               when '夏' then 2
               when '秋' then 3
               when '冬' then 4
               else null
             end as season_number,
             season,
             subject,
             category,
             pref,
             name_sei,
             name_mei,
             filecontents,
             id
             from trip
             order by season_number,season_sequence;";
          }
          if(strlen($keyword) > 0) {
            $sql="SELECT * FROM trip_season WHERE season like '%".$keyword."%' OR category like '%".$keyword."%' OR subject like '%".$keyword."%' OR pref like '%".$keyword."%';";
          }else {
            $sql="SELECT * FROM trip_season";
          }
          if($result=mysqli_query($link,$sql)){  //mysqli_query()は、データ抽出が成功するとTRUEを返します。
            foreach ($result as $row) {
              echo "<tr>\n";
              echo "<td align='center'><input type='checkbox' name='del_season_id[]' id='chkitem' class='chkbox' value='".$row['id']."'></td>\n";
              echo  "<td align='center'>".$row['season']."</td>\n";
              echo  "<td align='center'>".$row['subject']."</td>\n";
              echo  "<td align='center'>".$row['category']."</td>\n";
              echo  "<td align='center'>".$row['pref']."</td>\n";
              echo  "<td align='center'>".$row['name_sei'].$row['name_mei']."</td>\n";
              echo  "<td align='center'>".$row['filecontents']."</td>\n";
              //URLに加えてデータを記述する場合,https://URL?データ=値でつなげる。データが複数ある場合はさらに&でつなげる(https://URL?データ1=値1&データ2=値2&...)
              echo  "<td align='center'><a href='edit.php?id=".$row['id']."&page=1' class='button'>編集</a></td>\n"; 
              echo  "</tr>\n"; 
            }
          }
          else{
              $connect_alert = "<script type='text/javascript'>alert('データベースとの接続に失敗しました。\r\n');</script>";
              echo $connect_alert;
          }
          mysqli_close($link);
        ?>
         </tbody>
       </table>
        <div class="listButton">
        <input type="submit" name="delete_season" value="データ削除"> <!-- submitにすることでボタン押した時にDelete.phpに処理を渡す -->
        </div>
      </form>
      <!--end div#contentList-->
    </div>
    <br>
    <!--ランキン登録リスト-->
    <h1>
      <span class="title">ランキング登録リスト</span>
    </h1>
    <!--end h1-->
    <div>
    　<form id="Serach" action="" method="post">
        <input id="sbox" type="text" name="keyword" placeholder="キーワードを入力" />
        <input id="sbtn" type="submit" name="search" value="検索" />
      </form>
    </div>
    <div id="contentList">
      <form action="delete.php" method="post" id="form" onsubmit="return delete_check()">
        <table summary="アドレス帳">
          <tbody>
          <tr>
            <th width="20" align="center"><input type="checkbox" class="checkAll" id="checkboxAll" onChange="checkAll();"></th>
            <th width="80">ランキング</th>
            <th width="120">タイトル名</th>
            <th width="120">カテゴリ</th>
            <th width="80">県名</th>
            <th width="80">登録者</th>
            <th>ファイル画像名</th>
            <th width="70">操作</th>
          </tr>
         <?php          
          //登録したアドレス帳テーブルの表示
          include("db_config.php");
          $link = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
          mysqli_set_charset($link, 'utf8');
          //検索機能
          $keyword = "";
          if (isset($_POST["search"])) { 
              // 検索ボタンが押されたときの処理
              if (isset($_POST["keyword"])) {
                  // キーワードが設定された場合
                  $keyword =  $_POST["keyword"];
              }
          }
          if(strlen($keyword) > 0) {
            $sql="SELECT * FROM trip_ranking WHERE season like '%".$keyword."%' OR category like '%".$keyword."%' OR subject like '%".$keyword."%' OR pref like '%".$keyword."%';";
          }else {
            $sql="SELECT * FROM trip_ranking order by ranking";
          }
          if($result=mysqli_query($link,$sql)){  //mysqli_query()は、データ抽出が成功するとTRUEを返します。
            foreach ($result as $row) {
              echo "<tr>\n";
              echo "<td align='center'><input type='checkbox' name='del_ranking_id[]' id='chkitem' class='chkbox' value='".$row['id']."'></td>\n";
              echo  "<td align='center'>".$row['ranking']."</td>\n";
              echo  "<td align='center'>".$row['subject']."</td>\n";
              echo  "<td align='center'>".$row['category']."</td>\n";
              echo  "<td align='center'>".$row['pref']."</td>\n";
              echo  "<td align='center'>".$row['name_sei'].$row['name_mei']."</td>\n";
              echo  "<td align='center'>".$row['filecontents']."</td>\n";
              //URLに加えてデータを記述する場合,https://URL?データ=値でつなげる。データが複数ある場合はさらに&でつなげる(https://URL?データ1=値1&データ2=値2&...)
              echo  "<td align='center'><a href='edit.php?id=".$row['id']."&page=2' class='button'>編集</a></td>\n"; 
              echo  "</tr>\n"; 
            }
          }
          else{
              $connect_alert = "<script type='text/javascript'>alert('データベースとの接続に失敗しました。\r\n');</script>";
              echo $connect_alert;
          }
          mysqli_close($link);
        ?>
         </tbody>
       </table>
        <div class="listButton">
        <input type="submit" name="delete_ranking" value="データ削除"> <!-- submitにすることでボタン押した時にDelete.phpに処理を渡す -->
        </div>
      </form>
      <!--end div#contentList-->
    </div>
      <!--end div#contentList-->
      
    </div>
  </div>
</body>
</html>