<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes">
  <title>Cyberlink</title>
  <link rel="stylesheet" href="../../frontend/css/loading.css" >
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>
<body>
  <div class="loader">
    <div class="inner one"></div>
    <div class="inner two"></div>
    <div class="inner three"></div>
  </div>
</body>
  <script>
  $(document).ready(function() {

    setTimeout(function(){
        $('body').addClass('loaded');
    }, 750);
    setTimeout(function(){
        window.location.href = 'backend/account/logout.php';
    }, 1200);

  });
  </script>
</html>
