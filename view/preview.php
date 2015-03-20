<!doctype html>
<html class="no-js">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="viewport"
        content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <?php if($path != '/'):?>
        <title><?=$path == '/' ? '/' : '/'.$path ?> - Preview - Portfolio</title>
    <?php endif;?>


    <!-- Set render engine for 360 browser -->
    <meta name="renderer" content="webkit">

    <!-- No Baidu Siteapp-->
    <meta http-equiv="Cache-Control" content="no-siteapp"/>

    <link rel="stylesheet" href="<?=$__const['host']?>/resource/assets/css/amazeui.min.css">
    <link rel="stylesheet" href="<?=$__const['host']?>/resource/assets/css/app.css">
</head>
<body>
<header class="am-topbar am-topbar-inverse">
    <div class="container">
        <h1 class="am-topbar-brand">
            <a href="<?=$__const['host']?>">Portfolio</a>
        </h1>
        <nav>
            <strong>Author</strong> Haoran Yu / <strong>Version</strong> 0.1
        </nav>
    </div>
</header>

<div class="container">
    <div class="am-panel am-panel-default">
        <div class="am-panel-hd">
            Preview: <?=$path == '/' ? '/' : '/'.$path ?>
            <?php if($path != '/'):?>
                <span class="option">
                    <a class="am-icon-mail-reply" href="./"> Back</a>
                </span>
            <?php endif;?>
        </div>
        <div class="am-panel-bd preview">
            <iframe src="https://subversion.ews.illinois.edu/svn/sp15-cs242/hyu34<?=$path == '/' ? '/' : '/'.$path ?>"></iframe>
        </div>
    </div>
</div>
<footer>
    &copy; 2015 @ University of Illinois at Urbana-Champaign
</footer>
<!--[if (gte IE 9)|!(IE)]><!-->
<script src="<?=$__const['host']?>/reseource/assets/js/jquery.min.js"></script>
<!--<![endif]-->
<!--[if lte IE 8 ]>
<script src="http://libs.baidu.com/jquery/1.11.1/jquery.min.js"></script>
<![endif]-->
</body>
</html>
