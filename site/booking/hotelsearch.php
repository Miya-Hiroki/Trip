<?php
//-------------------------------------------------------------------//
// SDK-Sample-05「楽天トラベルTOP10ランキング」
//-------------------------------------------------------------------//
$app_title_head='SDK-Sample-05';
$app_title_header='「楽天トラベルTOP10ランキング」';

// ライブラリファイル等の読込
require_once dirname(__FILE__).'/../autoload.php';
require_once dirname(__FILE__).'/config.php';

// 変数の初期化

$response = null;
$search_genre  = 'all';
$page     = 1;

// 検索結果の取得
if (isset($_GET['search_genre'])) {
    // Clientインスタンスを生成 Make client instance
    $rwsclient = new RakutenRws_Client();
    // アプリIDをセット Set Application ID
    $rwsclient->setApplicationId(RAKUTEN_APP_ID);
    // アフィリエイトIDをセット (任意) Set Affiliate ID (Optional)
    $rwsclient->setAffiliateId(RAKUTEN_APP_AFFILITE_ID);

    // GETデータの取得
    $search_genre = $_GET['search_genre'];

    // 検索用配列の準備
    $serch_array = array(
        'carrier' => '0' ,
        'genre' => $search_genre,
        'page' => $page,
    );

    // 楽天トラベルランキングAPI で ランキングを検索
    $response = $rwsclient->execute('TravelHotelRanking',$serch_array);
}

//-------------------------------------------------------------------//
// HTMLの表示
//-------------------------------------------------------------------//

show_header(); // ヘッダーの表示
show_credit_logo(); // クレジットロゴの表示

if($_GET){// GETデータが有る場合の表示
    // フォームの表示
    show_search_form($search_genre);
    if ($response && $response->isOk()) {// レスポンスが正常かどうかを isOk() で確認する
        show_search_result($response);
    }else{
        // レスポンスが異常の場合、getMessage() でレスポンスメッセージを取得
        echo '<p align="center">Error:'.$response->getMessage().'</p>';
    }
}else{// GETデータが無い場合の表示
    show_search_form($search_keyword,$search_sort);
    show_usage();
}

show_footer(); // フッターの表示

//-------------------------------------------------------------------//
// 関数
//-------------------------------------------------------------------//
/**
 *  使用方法の表示関数
 */
function show_usage(){

echo<<<EOD
<div class="usage">
<p>"Rukuten Developers" 提供の "楽天トラベルランキングAPI" を使用した「楽天トラベルの<strong> TOP10ランキング </strong>表示プログラム」です。</p>
<p>※「総合ランキング」「温泉宿ランキング」「高級ホテル/旅館ランキング」の<strong> TOP10ランキング </strong>３種類が表示できます。</p>
<h3>【使用方法】</h3>
<ol>
<li>【ランキングの種類】をドロップリストから選択します。</li>
<li>【ランキングの表示】ボタンでランキングを表示します。</li>
<li>【 宿泊プラン 】【 空室検索 】、レビューの確認が出来ます。</li>
<ol>
</div>
EOD;

}

/**
 *  検索結果の表示関数
 */
function show_search_result($result){

    foreach ($result['Rankings'][0]['Ranking']['hotels'] as $item) {

        // 施設画像   $item['hotel']['hotelImageUrl'];
        $tbl_image='<a href="' . $item['hotel']['hotelInformationUrl'] . '" target="_blank">'.'<img src="' . $item['hotel']['hotelImageUrl'] . '" width="200" height="150"></img>' . '</a>';

        // ランク $item['hotel']['rank'] ;
        // 施設名 $item['hotel']['hotelName'] ;
        // 施設情報ページ $item['hotel']['hotelInformationUrl'];
        $tbl_data_1='【' . $item['hotel']['rank'] .'】'.'<a href="' . $item['hotel']['hotelInformationUrl'] . '" target="_blank">'. mb_strimwidth($item['hotel']['hotelName'] , 0, 56, '...', 'UTF-8') . '</a>';

        // 所在都道府県 $item['hotel']['middleClassName'] ;
        $tbl_data_2='【所在都道府県 : ' . $item['hotel']['middleClassName'] . '】';

        // 宿泊プランURL $item['hotel']['planListUrl']
        // 空室検索URL $item['hotel']['checkAvailableUrl']
        $tbl_data_3='【 <a href="' . $item['hotel']['planListUrl'] . '" target="_blank">宿泊プラン</a> 】【 <a href="' . $item['hotel']['checkAvailableUrl'] . '" target="_blank">空室検索</a> 】';

        // お客様の声URL $item['hotel']['reviewUrl'];
        // お客様の件数 $item['hotel']['reviewCount'];
        // 星の数 $item['hotel']['reviewAverage'];
        $tbl_data_4='レビュー数：'.$item['hotel']['reviewCount'].'件　<a href="' . $item['hotel']['reviewUrl'] . '" target="_blank">【★'.$item['hotel']['reviewAverage'].'】</a>';

        // お客様の声 $item['hotel']['userReview'];
        $tbl_data_5=$item['hotel']['userReview'];

        // 検索結果のHTML表示

echo<<<EOD

        <table align="center" border="1">
        <tr>
        <td colspan="2">
        $tbl_data_1
        </td>
        </tr>
        <tr>
        <td>
        $tbl_data_2
        </td>
        <td>
        $tbl_data_3
        </td>
        </tr>
        <tr>
        <td rowspan="2">
        $tbl_image
        </td>
        <td>
        $tbl_data_4
        </td>
        </tr>
        <tr>
        <td>
        $tbl_data_5
        </td>
        </tr>
        </table>

EOD;

    }
}

/**
 *  ヘッダー部の表示関数
 */
function show_header(){

global $app_title_head;
global $app_title_header;

echo<<<EOD

<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>$app_title_head</title>
<link rel="stylesheet" href="style.css" type="text/css">
</head>
<body>
<header>
<h1 align="center"><a href="index.php">$app_title_header</a></h1>
</header>

EOD;
}

/**
 *  クレジットロゴ部の表示関数
 */
function show_credit_logo(){
echo<<<EOD

<div class="credit-logo">
<!-- Rakuten Web Services Attribution Snippet FROM HERE -->
<a href="http://webservice.rakuten.co.jp/" target="_blank"><img src="http://webservice.rakuten.co.jp/img/credit/200709/credit_31130.gif" border="0" alt="楽天ウェブサービスセンター" title="楽天ウェブサービスセンター" width="311" height="30"/></a>
<!-- Rakuten Web Services Attribution Snippet TO HERE -->
</div>

EOD;
}

/**
 *  フォーム部の表示関数
 */
function show_search_form($genre){
    echo '<nav class="search-form">';
    echo '<form action="index.php" method="GET">';
    echo '【ランキングの種類】';
    echo '<select name="search_genre">';
    echo '<option value="all"' . ($genre === 'all' ? ' selected' : '') . '>総合ランキング</option>';
    echo '<option value="onsen"' . ($genre === 'onsen' ? ' selected' : '') . '>温泉宿ランキング</option>';
    echo '<option value="premium"' . ($genre === 'premium' ? ' selected' : '') . '>高級ホテル/旅館ランキング</option>';
    echo '</select>';
    echo '<br><br>';
    echo '<input type="submit" class="search-button" value="【ランキングの表示】">';
    echo '</form>';
    echo '</nav>';
}

/**
 *  フッター部の表示関数
 */
function show_footer(){
echo<<<EOD

<div class="copyright" align="center">
<p><small>&copy;2019 R10.Oh!Happy.JP</small></p>
</body>
</html>

EOD;
}

?>