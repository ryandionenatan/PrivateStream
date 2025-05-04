<?php
include("/var/www/html/adm/otor.php");
$aip=$_SERVER['REMOTE_ADDR'];
$stmt = mysqli_stmt_init($link);
mysqli_stmt_prepare($stmt, "select token, name from token where ip=? and used='1' limit 1");
mysqli_stmt_bind_param($stmt, "s", $aip);
mysqli_stmt_execute($stmt);
mysqli_stmt_bind_result($stmt, $tok, $nombre);
mysqli_stmt_fetch($stmt);
if(!empty($tok)) {
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
            <p>Welcome! Please select a server above to watch the stream, I recommend to select a server that located nearest to your location.<br>
			I hope you'll enjoy the stream! If you do enjoy it, you can help me by donate via Bitcoin above or via Paypal by asking me directly.<br><br>
			Thank you!
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
