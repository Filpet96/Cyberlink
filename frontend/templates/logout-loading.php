<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes">
  <title>Cyberlink</title>
  <link rel="stylesheet" href="../../frontend/css/loading.css" >
</head>
<body id="body">
  <div class="loader">
    <div class="inner one"></div>
    <div class="inner two"></div>
    <div class="inner three"></div>
  </div>
</body>
<script>
// timeout function add class loaded to fade element after 750 ms
  setTimeout(function(){
      var element = document.getElementById("body");
      element.classList.add("loaded");
  }, 750);
  // timeout function redirect to home page after 1200 ms
  setTimeout(function(){
      window.location.href = 'backend/account/logout.php';
  }, 1200);
</script>
</html>
