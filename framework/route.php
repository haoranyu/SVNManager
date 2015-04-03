<?php
if(isset($_GET['method'])) {
    $method = $_GET['method'];
}
else {
    $method = 'get';
}

if(isset($_GET['module'])) {
    $module = $_GET['module'];
}
else {
    $module = 'svn';
}
