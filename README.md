# PrivateStream

PrivateStream is a web-based streaming service designed to provide secure access to content. By incorporating token validation, the system ensures that only authenticated users can stream content, effectively safeguarding private content on the platform.

## Features

- **Token Validation**: Ensures secure access by validating user tokens.
- **Authenticated Streaming**: Only authenticated users can access and stream content.
- **Secure Platform**: Protects private content from unauthorized access.

## Installation

To get started with PrivateStream, follow these steps:

1. Create MySQL database with log and token table
   ```
     CREATE TABLE `log` (
      `log` int NOT NULL,
      `token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
      `action` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
      `datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
      `ip` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
      `session` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'session',
      `userag` varchar(1000) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'userag'
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

    CREATE TABLE `token` (
      `token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
      `ip` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
      `used` int DEFAULT '0',
      `resetcount` int NOT NULL DEFAULT '10',
      `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'Name',
      `session` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'session',
      `userag` varchar(1000) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'userag'
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

     ALTER TABLE `log`
      ADD PRIMARY KEY (`log`);
  
    ALTER TABLE `token`
      ADD PRIMARY KEY (`token`);
      
    ALTER TABLE `log`
      MODIFY `log` int NOT NULL AUTO_INCREMENT;
   ```

2. Create a token on log table.
   ```
   INSERT INTO token (token) VALUES ('example');
   ```

3. Then send token to user that will watch your stream.

4. Last, stream your content with this command for example
   ```
   ffmpeg -i <input> -max_muxing_queue_size 10000 -c:v libx264 -c:a libfdk_aac -x264opts "keyint=25:min-keyint=25:no-scenecut" -b:v 512k -b:a 64k -vf "scale=428:240" -tune zerolatency -preset veryfast -f flv rtmp://<ipordomain>/hls/stream_1 -max_muxing_queue_size 10000 -c:v libx264 -c:a libfdk_aac -x264opts "keyint=25:min-keyint=25:no-scenecut" -b:v 1024k -b:a 96k -vf "scale=640:360" -tune zerolatency -preset veryfast -f flv rtmp://<ipordomain>/hls/stream_2 -max_muxing_queue_size 10000 -c:v libx264 -c:a libfdk_aac -x264opts "keyint=25:min-keyint=25:no-scenecut" -b:v 1512k -b:a 128k -vf "scale=854:480" -tune zerolatency -preset veryfast -f flv rtmp://<ipordomain>/hls/stream_3 -max_muxing_queue_size 10000 -c:v libx264 -c:a copy -x264opts "keyint=25:min-keyint=25:no-scenecut" -b:v 3076k -vf "scale=1280:720" -tune zerolatency -preset veryfast -f flv rtmp://<ipordomain>/hls/stream_4 -max_muxing_queue_size 10000 -c copy -f flv rtmp://<ipordomain>/hls/stream_5
   ```

## Configuration

### Environment Variables

To configure the application, set the database connection on adm/otor.php.

On NGINX, add the following line on your nginx.conf configuration, make sure you have RTMP plugin installed

```
rtmp {
    server {
        listen 1935;

        application hls {
            live on;
            hls on;
            hls_path (modify html path here)/hls;
            hls_fragment 3;
            hls_playlist_length 9;
            hls_variant _1 BANDWIDTH=578000,RESOLUTION=427x240; # Low bitrate, 240p resolution
            hls_variant _2 BANDWIDTH=1120000,RESOLUTION=640x360; # Low bitrate, 360p resolution
            hls_variant _3 BANDWIDTH=1640000,RESOLUTION=854x480; # Medium bitrate, SD resolution
            hls_variant _4 BANDWIDTH=3268000,RESOLUTION=1280x720; # High bitrate, HD 720p resolution
            hls_variant _5 BANDWIDTH=5192000,RESOLUTION=1920x1080; # Source bitrate, source resolution	
        }
    }
}

```

And the following to the `server` part

```
    location ~* \.(m3u8)$ {
        return 404;
    }

    location ^~ /adm/ {
        return 404;
    }
```

This is to make sure that your m3u8 and otor.php isn't accessible

## Contact

For any inquiries, please contact [ryandionenatan@yahoo.co.id].
