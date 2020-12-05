<?php
    include("db_config.php");
    //季節登録リストの削除
    if(@$_POST['delete_season']){
    $ids=$_POST['del_season_id'];
    $link = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
    mysqli_set_charset($link, 'utf8');
    foreach ($ids as $id) {
        $sql="SELECT * FROM trip_season WHERE id = $id";
        if($result=mysqli_query($link,$sql)){
            if(mysqli_num_rows($result)!=0){  //指定された氏名が存在するか調べる。
                foreach ($result as $row) { //エラー時の名前の表示
                    $subject=$row['subject'];
                }
                $sql="DELETE FROM trip_season WHERE id=$id;";
                if(!mysqli_query($link,$sql)){  //mysqli_query()は、削除が成功するとTRUEを返します。
                    echo $subject."のデータを削除に失敗しました。\r\n";
                }
            } else {
                echo $subject."のデータは存在しません。\r\n";
            }
        }
        else{
            echo "データの抽出に失敗しました。\r\n";
        }
    }
    } else{
    //ランキング登録リストの削除
    $ids=$_POST['del_ranking_id'];
    $link = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
    mysqli_set_charset($link, 'utf8');
    foreach ($ids as $id) {
        $sql="SELECT * FROM trip_ranking WHERE id = $id";
        if($result=mysqli_query($link,$sql)){
            if(mysqli_num_rows($result)!=0){  //指定された氏名が存在するか調べる。
                foreach ($result as $row) { //エラー時の名前の表示
                    $subject=$row['subject'];
                }
                $sql="DELETE FROM trip_ranking WHERE id=$id;";
                if(!mysqli_query($link,$sql)){  //mysqli_query()は、削除が成功するとTRUEを返します。
                    echo $subject."のデータを削除に失敗しました。\r\n";
                }
            } else {
                echo $subject."のデータは存在しません。\r\n";
            }
        }
        else{
            echo "データの抽出に失敗しました。\r\n";
        }
    }    
    }
    mysqli_close($link);
    echo "<script>location.href='index.php';</script>";
?>