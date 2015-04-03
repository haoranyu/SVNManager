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
        <title><?=$path == '/' ? '/' : '/'.$path ?> - Portfolio</title>
    <?php else:?>
        <title>Portfolio</title>
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
            Path: <?=$path == '/' ? '/' : '/'.$path ?>
            <?php if($path != '/'):?>
                <span class="option">
                    <a class="am-icon-mail-reply" href="../"> Back</a>
                    <a class="am-icon-clock-o" href="<?=$__const['host'].'/revision'.($path =='/'?'/':'/'.$path.'/')?>"> History</a>
                </span>
            <?php endif;?>
        </div>
        <table class="am-table am-table-striped">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Author</th>
                    <th>Date</th>
                    <th>Revision</th>
                    <th>Type</th>
                    <th>Size</th>
                    <th>Summary</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($list as $key => $value):?>
                <tr>
                    <?php if($value['type'] == '/'):?>
                        <td><a href="./<?=$key?>/"><?=$key?></a></td>
                    <?php else:?>
                        <td><a href="<?=$__const['host'].'/preview'.($path =='/'?'/':'/'.$path.'/').$key?>"><?=$key?></a></td>
                    <?php endif;?>
                    <td><?=$value['author']?></td>
                    <td><?=substr($value['date'], 0, 10)?></td>
                    <td><a target="_blank" href="<?=$__const['host'].'/revision'.($path =='/'?'/':'/'.$path.'/').$key?>/"><?=$value['revision']?></a></td>
                    <td><?=$value['type']?></td>
                    <td><?=$value['size']?></td>
                    <td title="<?=$value['msg']?>"><?=substr($value['msg'], 0, 50)?></td>
                </tr>
                <?php endforeach;?>
            </tbody>
        </table>
    </div>
</div>
<footer>
    &copy; 2015 @ University of Illinois at Urbana-Champaign
</footer>
<!--[if (gte IE 9)|!(IE)]><!-->
<script src="<?=$__const['host']?>/resource/assets/js/jquery.min.js"></script>
<!--<![endif]-->
<!--[if lte IE 8 ]>
<script src="http://libs.baidu.com/jquery/1.11.1/jquery.min.js"></script>
<![endif]-->
</body>
</html>
