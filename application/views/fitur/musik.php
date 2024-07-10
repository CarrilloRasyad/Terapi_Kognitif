<!DOCTYPE html>
<html>

<head>
  <style>
    #player {
      padding: 3rem;
      margin: 0 auto;
      /* Center the video horizontally */
      display: block;
      /* Make sure the containing element is a block element */
    }

    .centered-content {
      text-align: left;
      margin-top: 2rem;
      margin-left: 210px;
      margin-bottom: -2rem;
    }
  </style>
</head>

<body>
  <div class="centered-content">
    <!-- <p class="lead mb-2">Berikut adalah vidio terapi musik. Tekan tombol merah pada vidio tersebut untuk memulai lalu dengarkan lantunan musik klasik selama 10 menit. Semoga Berhasil!</p> -->
  </div>
  <div id="player"></div>
  <script>
    // Load the YouTube iFrame API asynchronously
    var tag = document.createElement('script');
    tag.src = "https://www.youtube.com/iframe_api";
    var firstScriptTag = document.getElementsByTagName('script')[0];
    firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

    var player;

    function onYouTubeIframeAPIReady() {
      // Replace the video ID with the one you want to display
      player = new YT.Player('player', {
        height: '640',
        width: '1200',
        videoId: '7JmprpRIsEY',
        events: {
          'onReady': onPlayerReady,
          'onStateChange': onPlayerStateChange
        }
      });
    }

    function onPlayerReady(event) {}

    function onPlayerStateChange(event) {
      // Do something when the video state changes (e.g. when it ends)
    }
  </script>
</body>

</html>