<?php
// accepts url params for path
if(isset($_GET['path'])) {
    $path = $_GET['path'];
}
else {
    exit('Something went wrong!');
}

$parser = new Parser('./resource/data/svn_log.xml', './resource/data/svn_list.xml');
$revision = new Revision($parser->buildTreeStructure());

$history = $revision->getRevision($path);
