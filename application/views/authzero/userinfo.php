<html>
    <head>
        <script src="http://code.jquery.com/jquery-3.1.0.min.js" type="text/javascript"></script>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- font awesome from BootstrapCDN -->
        <link href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
        <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css" rel="stylesheet">
        <link href="/asset/authzero/app.css" rel="stylesheet">
    </head>
    <body>
        <div class="row-lg-12">
        <div class="row-lg-12">
        <img src="<?php echo $userInfo['picture']?>"/>
        </div>
        <?php
        echo 'Halo, ';
        echo ''. $userInfo['nickname'];
        echo '<br />';
        echo 'login : '. $userInfo['name'];
        echo '<br />';
        echo 'updated_at : '. $userInfo['updated_at'];
        echo '<br />';
        ?>
        <a href='/authzero/logout'>Logout</a>
        </div>
    </body>
</html>