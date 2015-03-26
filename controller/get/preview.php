<?php
// accepts url params for path
if(isset($_GET['path'])) {
    $path = $_GET['path'];
}
else {
    exit('Something went wrong!');
}
$parser = new Parser('./resource/data/svn_log.xml', './resource/data/svn_list.xml');
$preview = new Preview($parser->buildTreeStructure());

if(!$preview->isFile($path)) {
    header('Location: '.$__const['host'].'/'.$path);
}
