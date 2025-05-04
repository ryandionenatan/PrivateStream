<!DOCTYPE html>
<html>
  <head>
    <title>Token Here</title>
   <link rel="stylesheet" href="css/login.css"/>
  </head>
<body>
<div class="body"></div>
		<div class="grad"></div>
		<div class="header">
			<div>RESET <span>HERE</span></div>
		</div>
		<br>
		<div class="login">
		<form action="" method="post" name="log">
				<input type="text" placeholder="Token" name="token"><br>
				<input type="submit" name="autho" value="Reset">
		</form>
<?php
if (isset($_POST['autho'])) {
include("adm/otor.php");
    $tkn=$_POST['token'];
	$stmt = mysqli_stmt_init($link);
    mysqli_stmt_prepare($stmt, "select * from token where token=? and resetcount!='0'");
    mysqli_stmt_bind_param($stmt, "s", $tkn);
    mysqli_stmt_execute($stmt);
	mysqli_stmt_store_result($stmt);
    if(mysqli_stmt_num_rows($stmt)>0)
    {
		$ipa=$_SERVER['REMOTE_ADDR'];
                $userag = $_SERVER["HTTP_USER_AGENT"];
                $ssio = bin2hex(random_bytes('32'));
                $stmt = mysqli_stmt_init($link);
                mysqli_stmt_prepare($stmt, "insert into log (token,action,ip,session,userag) values (?,'reset',?,?,?)");
                mysqli_stmt_bind_param($stmt, "ssss", $tkn, $ipa, $ssio, $userag);
                mysqli_stmt_execute($stmt);
                $stmt = mysqli_stmt_init($link);
                mysqli_stmt_prepare($stmt, "update token set used='0',resetcount=resetcount-1,ip=?,session=?,userag=? where token=?");
                mysqli_stmt_bind_param($stmt, "ssss", $ipa, $ssio, $userag, $tkn);
                mysqli_stmt_execute($stmt);
                echo '<div id="login-error-msg-holder"><p id="login-success-msg">Reset successful. You can close this page.</p></div>';
    }
    else {
		echo '<div id="login-error-msg-holder"><p id="login-error-msg">Wrong token or you have exceed your reset count.</p></div>';
	}
}
?>
		</div>
  </body>
</html>

