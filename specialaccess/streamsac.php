<?php
$filename = '/var/www/html/hls/stream.m3u8';

	if (file_exists($filename)) {
		header('Content-type: application/x-mpegURL');
        $m3u8 = file_get_contents($filename);
		$m3u81 = str_replace('.m3u8', '.php', $m3u8);
		$m3u82 = str_replace('stream', 'streamsac', $m3u81);
		echo $m3u82;
    } else {
        header('Content-type: application/x-mpegURL');
        $m3u8 = file_get_contents('/var/www/html/sts/offline.m3u8');
		echo $m3u8;
    }

?>