<?php
//ログイン完了前にアクセスした場合、ログインフォームへ飛ばす
@session_start(); 
if(!isset($_SESSION['name'])){
  echo "<script>location.href='Login/login_form.php';</script>";
}
// images/seazonの各季節の最大ファイル番号を取得する。
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
      //index.phpからはGET方式で入ってくるため、POSTで入ってくるのは新規登録のみ)
      //ブラウザからのリクエストが、POSTメソッドなのかGETメソッドなのか、スクリプト側で判別する方法
      //登録内容の値を取得
      $name_sei=$_POST['name_sei'];
      $name_mei=$_POST['name_mei'];
      $name_sei_kana=$_POST['name_sei_kana'];
      $name_mei_kana=$_POST['name_mei_kana'];
      $season=$_POST['season'];
      $year=$_POST['year'];
      $month=$_POST['month'];
      $day=$_POST['day'];
      $category=$_POST['category'];
      $subject=$_POST['subject'];
      $zip=$_POST['zip'];
      //住所自動検索機能の付加
      $pref=$_POST['pref'];
      $city=$_POST['city'];
      $house_number=$_POST['house_number'];
      $building=$_POST['building'];
      $tel=$_POST['tel'];
      $email=$_POST['email'];
      $memo=$_POST['memo'];
      $filecontents=$_POST['filecontents'];
      //画像ファイルの移動
      function getPathFile($season)
      {
        switch($season) {
          case "春":
            $file = "spring";
            break;
          case "夏":
            $file = "summer";
            break;
          case "秋":
            $file = "autumn";
            break;
          case "冬":
            $file = "winter";
            break;
        }
        $path="../images/season/".$file."/".$file;
        $max="0";
        foreach(glob($path."*") as $dir){ //glob：パターンに合うパス名を検索する
          if(is_file($dir)){
            $base=basename($dir);//パスの最後にある名前の部分を返す
            $ext=pathinfo($base, PATHINFO_EXTENSION);//拡張子の取得
            $max=str_replace($file."_","",str_replace(".".$ext,"",$base)); //検索文字列に一致したすべての文字列を置換する
          }
        }
        if (!is_numeric($max)) $max="0";
        $newfile = $path."_".sprintf("%03d", ((int)$max)+1);
        return $newfile;
      }
      $filename=$_FILES['image']['name'];
      $ext = pathinfo($filename, PATHINFO_EXTENSION);//ファイルの拡張子を取得
      $newfile=getPathFile($season).".".$ext;//
      $filecontents=rename($_FILES['image']['tmp_name'], $newfile);
      chmod($newfile, 0644); //所有者に読み込み、書き込みの権限を与え、その他には読み込みだけ許可する。
      
      //Databaseに格納
      include("db_config.php");
      $link = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
      mysqli_set_charset($link, 'utf8');
      if ($link) {
        //季節登録リスト設定
        $max_season_sequence="SELECT max(season_sequence) FROM trip_season;";
        $season_sequence=0;
        if($result = mysqli_query($link,$max_season_sequence)){
          foreach($result as $row) { //２次元->1次元配列にする
            foreach($row as $cell) {
              if (!is_null($cell)) {
                $season_sequence = strval($cell);
              }
            }
          }
          mysqli_free_result($result);
        }
        $season_sequence+=10; //季節用シーケンス番号の割当
        $sql="INSERT INTO trip_season values(NULL,'$name_sei','$name_mei','$name_sei_kana','$name_mei_kana','$season','$year','$month','$day',
        '$category','$subject','$zip','$pref','$city','$house_number','$building','$tel','$email','$memo','$newfile','$season_sequence');";
        if(mysqli_query($link,$sql)){
          
        } else {
          $alert2 = "データの入力に失敗しました";
          $alert_2 = "<script type='text/javascript'>alert('". $alert2. "');</script>";
        }
        
        //ランキング登録リスト設定
        $max_ranking="SELECT max(ranking) FROM trip_ranking;";
        $ranking=0;
        if($result = mysqli_query($link,$max_ranking)){
          foreach($result as $row) {
            foreach($row as $cell) {
              if (!is_null($cell)) {
                $ranking = strval($cell);
              }
            }
          }
          mysqli_free_result($result);
        }
        $ranking+=1; //ランキング番号の仮設定
        $sql="INSERT INTO trip_ranking values(NULL,'$name_sei','$name_mei','$name_sei_kana','$name_mei_kana','$season','$year','$month','$day',
        '$category','$subject','$zip','$pref','$city','$house_number','$building','$tel','$email','$memo','$newfile','$ranking');";
        
        //echo "<script>alert(\"". $sql. "\");</script>";
        if(mysqli_query($link,$sql)){
          echo "<script>alert('".$subject."のデータを新規登録しました。');location.href='index.php';</script>";
        } else {
          $alert2 = "データの入力に失敗しました";
          $alert_2 = "<script type='text/javascript'>alert('". $alert2. "');</script>";
        }
      }else{
        echo "データベースに接続に失敗しました"; 
      }
      mysqli_close($link);
    } else {
      //初期値の設定
      $name_sei="";
      $name_mei="";
      $name_sei_kana="";
      $name_mei_kana="";
      $season="1";
      $year="";
      $month="0";
      $day="0";
      $category="";
      $subject="";
      $zip="";
      $pref="";
      $city="";
      $house_number="";
      $building="";
      $tel="";
      $email="";
      $memo="";
      $title="新規登録";
      $filecontents="";
      $id="";
      $sequence="";
      //値を読み取った後に表示する
      $page="1";
      include("table.php");
    }
?>

