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
    <div class="am-panel am-panel-default">
        <div class="am-panel-hd">
            Comments
        </div>
        <ul class="am-panel-bd am-comments-list comments" id="comment-list">
            <i class="am-icon-spinner am-icon-spin"></i> Loading...
        </ul>
        <div class="am-panel-footer am-form">
            <div class="am-form-group">
                <label for="comment-name">Name</label>
                <input type="email" class="" id="comment-name" placeholder="Enter your name">
            </div>
            <div class="am-form-group">
                <label for="comment-content">Comment</label>
                <textarea class="" rows="5" id="comment-content" placeholder="Enter the content of comment"></textarea>
            </div>
            <p><a class="am-btn am-btn-secondary" id="comment-submit">Post Comment</a></p>
        </div>
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
<script>

$(document).ready(function() {
    $.ajax({
        url: '<?=$__const['host']?>/api/comment/get/',
        type: 'POST',
        data: {
            path: '<?=$path == '/' ? '/' : '/'.$path ?>'
        },
        dataType: 'json',
        timeout: 8000,
        error: function(data){
            alert('数据获取超时');
        },
        success: function(data){
            if(data != '') {
                $('#comment-list').attr('data-empty', 'no');
                $('#comment-list').html('');
                for(var i = 0; i < data.length; i++) {
                    $('#comment-list').append('<li id="comment-'+data[i].id+'" class="am-comment"><a href=""> <img class="am-comment-avatar" src="http://www.gravatar.com/avatar/'+data[i].avatar+'?d=monsterid" alt=""/> </a><div class="am-comment-main"><header class="am-comment-hd"><div class="am-comment-meta"><a href="#link-to-user" class="am-comment-author">'+ data[i].name +'</a> @ '+ data[i].time +'</div></header><div class="am-comment-bd">'+ data[i].comment +'</div></div></li>');
                }
            }
            else {
                $('#comment-list').attr('data-empty', 'yes');
                $('#comment-list').html('There is no comment yet. Post your comment below.');
            }
        }
    });

    $(document).on('click','#comment-submit', function() {
        $.ajax({
            url: '<?=$__const['host']?>/api/comment/add/',
            type: 'POST',
            data: {
                path: '<?=$path == '/' ? '/' : '/'.$path ?>',
                name: $('#comment-name').val(),
                content: $('#comment-content').val()
            },
            dataType: 'json',
            timeout: 8000,
            error: function(data){
                alert('Timeout');
            },
            success: function(data){
                if($('#comment-list').attr('data-empty') == 'yes') {
                    alert('empty');
                    $('#comment-list').html('');
                    $('#comment-list').attr('data-empty', 'no');
                }
                $('#comment-list').append('<li id="comment-'+data.id+'" class="am-comment"><a href=""> <img class="am-comment-avatar" src="http://www.gravatar.com/avatar/'+data.avatar+'?d=monsterid" alt=""/> </a><div class="am-comment-main"><header class="am-comment-hd"><div class="am-comment-meta"><a href="#link-to-user" class="am-comment-author">'+ data.name +'</a> @ '+ data.time +'</div></header><div class="am-comment-bd">'+ data.comment +'</div></div></li>');
            }
        });
    });
})



</script>

</body>
</html>
