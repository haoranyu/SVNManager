<?php
    if(isset($_GET['test'])) {
        header('Content-Type: text/plain; charset=urf-8');
        include('framework/unitTest.php');
        include('model/'.$module.'.class.php');
        include('unit/'.$module.'.php');
    }
    else {
        include('controller/'.$module.'.php');
        include('view/'.$module.'.php');
    }
