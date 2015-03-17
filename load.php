<?php
    if(isset($_GET['test'])) {
        include('test/'.$module.'.php');
    }
    else {
        include('controller/'.$module.'.php');
        include('view/'.$module.'.php');
    }
