<?php
// accepts url params for path
if(isset($_GET['path'])) {
    $path = $_GET['path'];
}
else {
    $path = '/';
}

$parser = new Parser('./resource/data/svn_log.xml', './resource/data/svn_list.xml');
$svn = new Svn($parser->buildTreeStructure());

if($path == '/') {
    $list = $svn->getRootList();
}
else {
    $list = $svn->getList($path);
}
