<?php
$filename = '/var/www/html/hls/stream_4.m3u8';

	if (file_exists($filename)) {
		header('Content-type: application/x-mpegURL');
        $m3u8 = file_get_contents($filename);
		$m3u81 = str_replace('stream', 'https://deserv.birds.web.id/hls/stream', $m3u8);
		echo $m3u81;
    } else {
        header('Content-type: application/x-mpegURL');
        $m3u8 = file_get_contents('/var/www/html/sts/offline.m3u8');
		echo $m3u8;
    }

?>