<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>流媒体的播放</title>
  <!-- video.js -->
  <script src="video.js"></script>
  <!-- Media Sources plugin -->
  <script src="/pages/js/videojs-media-sources.js"></script>
  <!-- HLS plugin -->
  <script src="/pages/js/videojs-hls.js"></script>
  <!-- m3u8 handling -->
  <script src="/pages/js/m3u8/m3u8-parser.js"></script>
  <script src="/pages/js/playlist-loader.js"></script>

  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 20px;
    }
    .info {
      background-color: #eee;
      border: thin solid #333;
      border-radius: 3px;
      padding: 0 5px;
      margin: 20px 0;
    }

	p {font-size:16px; color: #f00;}
  </style>

</head>
<body>

	<p>
		只是适合手机上的浏览器
		测试只能是在测试服务器上测试，否则不能正常播放
	</p>
  <video id="video" class="video-js vjs-default-skin" height="600" width="100%" controls>
    <source src="http://live.3gv.ifeng.com/zixun.m3u8" type="application/x-mpegURL">
  </video>
  <script>
    videojs.options.flash.swf = 'node_modules/videojs-swf/dist/video-js.swf';
    // initialize the player
    var player = videojs('video');
  </script>
</body>
</html>
