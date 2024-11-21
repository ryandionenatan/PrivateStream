<?php

include("/var/www/html/adm/otor.php");
$filename = '/var/www/html/hls/stream_5.m3u8';
$sgn = $_GET["sgn"];
$aip=$_SERVER['REMOTE_ADDR'];
$stmt = mysqli_stmt_init($link);
mysqli_stmt_prepare($stmt, "select session, userag from token where ip=? and used='1'");
mysqli_stmt_bind_param($stmt, "s", $aip);
mysqli_stmt_execute($stmt);
mysqli_stmt_bind_result($stmt, $ssio, $userag);
mysqli_stmt_fetch($stmt);
$usrg = $_SERVER["HTTP_USER_AGENT"];
$stsio = md5($ssio.$userag);
if($userag == $usrg && $stsio == $sgn) {
	if (file_exists($filename)) {
		header('Content-type: application/x-mpegURL');
        $m3u8 = file_get_contents($filename);
		echo $m3u8;
    } else {
        header('Content-type: application/x-mpegURL');
        $m3u8 = file_get_contents('/var/www/html/sts/offline.m3u8');
		echo $m3u8;
    }
} else {
	header('Content-type: application/x-mpegURL');
    $m3u8 = file_get_contents('/var/www/html/sts/denied.m3u8');
	echo $m3u8;
}

?>