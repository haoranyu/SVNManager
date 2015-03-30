<?php
$comment = new Comment($conn);

if(isset($_POST['path']) && isset($_POST['name']) && isset($_POST['content'])) {

    $path = $_POST['path'];
    $name = htmlspecialchars($_POST['name']);
    $content = htmlspecialchars($_POST['content']);

    if(isset($_POST['parent_id'])) {
        $parent_id = intval($_POST['parent_id']);
        $comment->add($path, $name, $content, $parent_id);
    }
    else {
        $comment->add($path, $name, $content);
    }
    echo json_encode(true);
    exit;
}
echo json_encode(false);
