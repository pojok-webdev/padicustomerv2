<html>
  <head>
    <script src="http://code.jquery.com/jquery-3.1.0.min.js" type="text/javascript"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- font awesome from BootstrapCDN -->
    <link href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="/asset/authzero/app.css" rel="stylesheet">
  </head>
  <body class="home">
    <div class="container">
      <div class="login-page clearfix">
        <?php if(!$userInfo): ?>
        <div class="login-box auth0-box before">
          <img src="https://i.cloudup.com/StzWWrY34s.png" />
          <h3>PadiNET</h3>
          <p>PadiApp</p>
          <a class="btn btn-primary btn-lg btn-login btn-block" href="login">Masuk</a>
        </div>
        <?php else: ?>
        <div class="logged-in-box auth0-box logged-in">
          <h1 id="logo"><img src="//cdn.auth0.com/samples/auth0_logo_final_blue_RGB.png" /></h1>
          <img class="avatar" src="<?php echo $userInfo['picture'] ?>"/>
          <h2>Welcome <span class="nickname"><?php echo $userInfo['nickname'] ?></span></h2>
          <a class="btn btn-warning btn-logout" href="/logout">Logout</a>
        </div>
        <?php endif ?>
      </div>
    </div>
  </body>
</html>