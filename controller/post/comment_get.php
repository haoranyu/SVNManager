<?php

$comment = new Comment($conn);

if(isset($_POST['file'])) {

    $file = $_POST['file'];

    if($comment_resource = $comment->getByFile($file)) {
        $comment_list = array();
        foreach ($comment_resource as $comment_row) {
            array_push($comment_list, $comment_row);
        }
        return json_encode($comment_list);
    }
}
return json_encode(false);
