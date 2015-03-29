<?php

$comment = new Comment($conn);

if(isset($_POST['file']) && isset($_POST['name']) && isset($_POST['comment'])) {

    $file = $_POST['file'];
    $name = htmlspecialchars($_POST['file']);
    $comment = htmlspecialchars($_POST['file']);

    if(isset($_POST['parent_id'])) {
        $parent_id = intval($_POST['parent_id']);
        $comment->add($file, $name, $comment, $parent_id);
    }
    else {
        $comment->add($file, $name, $comment);
    }
    return json_encode(true);
}
return json_encode(false);
