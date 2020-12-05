<?php
  include("db_config.php");
  $post=$_GET['post'];
  $link = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
  mysqli_set_charset($link, 'utf8');
  if ($link) {
        $query = "SELECT pref,city,address from KEN_ALL where postal7 = '".$post."';";
        if ($result = mysqli_query($link, $query)) {
            foreach ($result as $row) {
                $data = array("pref"=>$row['pref'], "city"=>$row['city'], "address"=>$row['address']);//連想配列の形
                $yubin[] = $data;//配列の形で値をもつ
            }
            echo json_encode($yubin); //値をJSON形式にして返す
        }
        // 接続を閉じます
        mysqli_close($link);
  }
?>