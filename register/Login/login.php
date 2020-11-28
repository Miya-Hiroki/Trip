<?php
    //エラー出力用
    //ini_set("display_errors", 1);
    //error_reporting(E_ALL);
    //seesionスタート。session_start関数を用いて、セッション管理が可能になる
    @session_start(); 
    include("../db_config.php");
    $mail = $_POST['mail'];
    $pass = $_POST['pass'];
    //接続時のエラーチェック
    try {
        $dbh = new PDO($dsn, $username, $password);
    } catch (PDOException $e) {
        $msg = $e->getMessage();
    }
    //フォームに入力されたmailがすでに登録されていないかチェック
    $sql = "SELECT * FROM users WHERE mail = '".$mail."'";
    $stmt = $dbh->prepare($sql);// SQLの準備&実行
    $stmt->bindValue('mail', $mail);
    $stmt->execute();
    $member = $stmt->fetch();
    //指定したハッシュがパスワードにマッチしているかチェック
    //password_verify ( string $password , string $hash ) : bool
    if (password_verify($pass, $member['pass'])){
        //DBのユーザー情報をセッションに保存
        $_SESSION['name'] = $member['name'];
        echo "<script>location.href='../index.php';</script>";
    } else {
        $msg = 'メールアドレスもしくはパスワードが間違っています。';
        $link = '<a href="login_form.php">戻る</a>';
    }
?>
<h1><?php echo $msg; ?></h1>
<?php echo $link; ?>
