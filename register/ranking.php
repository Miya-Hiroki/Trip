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
      <span class="title">ランキング登録</span>
    </h1>
    <!--end h1-->
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
            <th width="80"> ランキング</th>
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
          if($result=mysqli_query($link,$sql)){  //mysqli_query()は、データ抽出が成功するとTRUEを返します。
            foreach ($result as $row) {
              echo "<tr>\n";
              echo "<td align='center'><input type='checkbox' name='del_id[]' id='chkitem' class='chkbox' value='".$row['id']."'></td>\n";
              echo  "<td align='center'>".$row['season']."</td>\n";
              echo  "<td align='center'>".$row['subject']."</td>\n";
              echo  "<td align='center'>".$row['category']."</td>\n";
              echo  "<td align='center'>".$row['pref']."</td>\n";
              echo  "<td align='center'>".$row['name_sei'].$row['name_mei']."</td>\n";
              echo  "<td align='center'>".$row['filecontents']."</td>\n";
              //URLに加えてデータを記述する場合,https://URL?データ=値でつなげる。データが複数ある場合はさらに&でつなげる(https://URL?データ1=値1&データ2=値2&...)
              echo  "<td align='center'><a href='edit.php?id=".$row['id']."' class='button'>編集</a></td>\n"; 
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
        <input type="submit" name="delete" value="データ削除"> <!-- submitにすることでボタン押した時にDelete.phpに処理を渡す -->
        </div>
      </form>
      <!--end div#contentList-->
    </div>
      <!--end div#contentList-->
    </div>
  </div>
</body>
</html>