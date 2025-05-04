<?php
include("/var/www/html/adm/otor.php");
$aip=$_SERVER['REMOTE_ADDR'];
$ssio = bin2hex(random_bytes('32'));
$userag = $_SERVER["HTTP_USER_AGENT"];
$stsio = md5($ssio.$userag);
$stmt = mysqli_stmt_init($link);
mysqli_stmt_prepare($stmt, "select token, name from token where ip=? and used='1' limit 1");
mysqli_stmt_bind_param($stmt, "s", $aip);
mysqli_stmt_execute($stmt);
mysqli_stmt_bind_result($stmt, $tok, $nombre);
mysqli_stmt_fetch($stmt);
if(!empty($tok)) {
                $stmt = mysqli_stmt_init($link);
                mysqli_stmt_prepare($stmt, "insert into log (token,action,ip,session,userag) values (?,'watch',?,?,?)");
                mysqli_stmt_bind_param($stmt, "ssss", $tok, $aip, $ssio, $userag);
                mysqli_stmt_execute($stmt);
                $stmt = mysqli_stmt_init($link);
                mysqli_stmt_prepare($stmt, "update token set session=?,userag=? where token=?");
                mysqli_stmt_bind_param($stmt, "sss", $ssio, $userag, $tok);
                mysqli_stmt_execute($stmt);
?>
<html>

<head>
	<meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />
	
	<title>Stream here</title>
	
	<link rel='stylesheet' type='text/css' href='css/style.css' />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/plyr/3.6.7/plyr.css">
	<link rel="stylesheet" href="./style.css">
	
	<!--[if IE]>
      <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
	
<!--    <script type='text/javascript' src='https://ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js'></script>
    <script type='text/javascript' src='js/jquery.ba-hashchange.min.js'></script>
    <script type='text/javascript' src='js/dynamicpage.js'></script> -->
	            <script src="https://cdnjs.cloudflare.com/ajax/libs/hls.js/0.14.5/hls.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/plyr/3.6.7/plyr.js"></script>
            <script src="./script.js"></script>
</head>

<body>

	<div id="page-wrap">
        <header>
		  <h1>Hello, <?php printf("%s", $nombre); ?> </h1>
		  <nav>
		      <ul class="group">
		          <li><a href="s1.php">Server 1 (London, UK)</a></li>
		          <li><a href="s2.php">Server 2 (London, UK)</a></li>
				  <li><a href="s3.php">Server 3 (Singapore)</a></li>
				  <li><a href="bitcoin:xxx">Donate via Bitcoin</a></li>
		      </ul>
		  </nav>
		</header>
		<section id="main-content">
		<div id="guts">
			<p style="text-align:center">DO NOT SCREENSHOT THIS PAGE!!!<br><br><?php printf("%s", $ssio); ?> </p>
            <div class="container">
                <video controls crossorigin autoplay playsinline >
                    <source 
                        type="application/x-mpegURL" 
                        src="https://xxx/hls/stream.php?sgn=<?php printf("%s", $stsio); ?>"
                    >
                </video>
            </div>
		</div>
		</section>
	</div>
	
	<footer>
	  &copy;2021
	</footer>

</body>

</html>
<?php
} else {
header("location: /");
}
?>
