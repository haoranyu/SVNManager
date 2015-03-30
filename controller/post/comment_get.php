<?php

$comment = new Comment($conn);

if(isset($_POST['path'])) {

    $path = $_POST['path'];

    if($comment_resource = $comment->getByFile($path)) {
        $comment_list = array();
        foreach ($comment_resource as $comment_row) {
            array_push($comment_list, $comment_row);
        }
        echo json_encode($comment_list);
        exit;
    }
}
echo json_encode(false);
