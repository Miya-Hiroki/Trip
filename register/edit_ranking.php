<?php
//ログイン完了前にアクセスした場合、ログインフォームへ飛ばす
@session_start(); 
if(!isset($_SESSION['name'])){
  echo "<script>location.href='Login/login_form.php';</script>";
}
// images/seazonの各季節の最大ファイル番号を取得する。
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
  //foreachで最後の番号を取得
  foreach(glob($path."*") as $dir){ //glob：パターンに合うパス名を検索する
    if(is_file($dir)){
      $base=basename($dir);//パスの最後にある名前の部分を返す
      $ext=pathinfo($base, PATHINFO_EXTENSION);//拡張子の取得
      $max=str_replace($file."_","",str_replace(".".$ext,"",$base)); //番号部分を抽出(00*)
    }
  }
  if (!is_numeric($max)) $max="0";//$maxが文字列の場合は0とおく
  $newfile = $path."_".sprintf("%03d", ((int)$max)+1); //%03d:整数10進数の3桁表示
  return $newfile;
}
//Databaseに格納
  include("db_config.php");
  $id=$_REQUEST['id']; // $_GETでも$_POSTでも使用する
  $link = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
  if ($link) {
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        //新しく更新する処理（POSTで入ってくる時の処理）
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
        $filename=$_FILES['image']['name'];
        $ext = pathinfo($filename, PATHINFO_EXTENSION);//ファイルの拡張子を取得
        $newfile=getPathFile($season).".".$ext;//
        $filecontents=rename($_FILES['image']['tmp_name'], $newfile);
        chmod($newfile, 644); //所有者に読み込み、書き込みの権限を与え、その他には読み込みだけ許可する。
        
        // 更新前のデータ存在チェックは、先に画面表示でチェックしているため省略している。
        $sql="UPDATE trip_ranking SET name_sei='".$name_sei."',name_mei='".$name_mei."',name_sei_kana='".$name_sei_kana."',name_mei_kana='".$name_mei_kana."',
        season='".$season."',year='".$year."',month='".$month."',day='".$day."',category='".$category."',subject='".$subject."',
        zip='".$zip."',pref='".$pref."',city='".$city."',house_number='".$house_number."',building='".$building."',tel='".$tel."',memo='".$memo."',
        email='".$email."',filecontents='".$newfile."' WHERE id='".$id."';";
        if($result=mysqli_query($link,$sql)){  //mysqli_query()は、更新が成功するとTRUEを返します。
            echo "<script>alert('".$subject."のデータを更新しました。');location.href='index.php';</script>";
        }
        else{
            echo $subject."のデータの更新に失敗しました。\r\nエラーコード:".mysqli_connect_errno().$sql;
        }
    } else {
      //既存データの表示(GETで入ってくるときの処理(index.phpのaタグ遷移からはGET方式で入ってくるため。))
      //まずは遷移してここの処理から開始
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
      $title="更新";
      $sql="SELECT * FROM trip_season WHERE id='".$id."';";
      if($result=mysqli_query($link,$sql)){
        foreach($result as $row) {
          // DBから取得した値を保持
        $name_sei=$row['name_sei'];
        $name_mei=$row['name_mei'];
        $name_sei_kana=$row['name_sei_kana'];
        $name_mei_kana=$row['name_mei_kana'];
        $season=$row['season'];
        $year=$row['year'];if (strlen($year)==0) { $month=0; }//格納データがない場合は0を与える
        $month=$row["month"];if (strlen($month)==0) { $month=0; }//格納データがない場合は0を与える
        $day=$row["day"];if (strlen($day)==0) { $day=0; }//格納データがない場合は0を与える
        $category=$row['category'];
        $subject=$row['subject'];
        $zip=$row['zip'];
        //住所自動検索機能の付加
        $pref=$row['pref'];
        $city=$row['city'];
        $house_number=$row['house_number'];
        $building=$row['building'];
        $tel=$row['tel'];
        $email=$row['email'];
        $memo=$row['memo'];
        $filecontents =  $row['filecontents'];
        }
      }
      //値を読み取った後に表示する
      include("table.php");
    }
  }
  mysqli_close($link);
?>
