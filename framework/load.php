<?php

    if(isset($_GET['test'])) {
        // if unit test is requested than go into test
        header('Content-Type: text/plain; charset=urf-8');
        include('framework/unitTest.php');
        include('model/'.$module.'.class.php');
        include('unit/'.$module.'.php');
    }
    else {
        // loading all the models
        foreach($__service as $m) {
            include('model/'.$m.'.class.php');
        }
        foreach($__modules as $m) {
            include('model/'.$m[1].'.class.php');
        }

        // loading the controller accordingly
        include('controller/'.$method.'/'.$module.'.php');

        // loading the view accordingly
        if($method == 'get') {
            include('view/'.$module.'.php');
        }
    }
