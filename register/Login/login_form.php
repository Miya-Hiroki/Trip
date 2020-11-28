<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title>ログインページ</title>
<link href="../css/base.css" rel="stylesheet" type="text/css">
<link href="../css/register.css" rel="stylesheet" type="text/css">
<link href="../css/login.css" rel="stylesheet" type="text/css">
</head>
<body>
<div id="wrapper">
	<div id="header"><span class="logo">サインイン画面</span></div>
  <div id="login">
    <form action="login.php" method="post">
     <div class="itemGroup">
        <label>ログインID</label></br>
        <p class="inputText">
          <input name="mail" type="text" required>
        </p></br>
        <label>パスワード</label></br>
        <p class="inputText">
          <input name="pass" type="password" required>
        </p>
      </div>
      <div class="submitArea">
        <input id="submit_button" type="submit" value="サインイン">
    </form>
    <!--end div#login-->
  </div>
</body>
</html>