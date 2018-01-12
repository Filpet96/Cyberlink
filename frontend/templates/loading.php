<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes">
  <title>The Society</title>
  <link rel="stylesheet" href="../../frontend/css/loading.css" >
  <link rel="icon" href="frontend/images/reddit.png">
</head>
  <body id="body">
    <div class="loader">
      <div class="inner one"></div>
      <div class="inner two"></div>
      <div class="inner three"></div>
    </div>
  </body>
  <script>
    setTimeout(function(){

        var element = document.getElementById("body");
        element.classList.add("loaded");
    }, 750);
    setTimeout(function(){
        window.location.href = '../../home';
    }, 1200);
  </script>
</html>
