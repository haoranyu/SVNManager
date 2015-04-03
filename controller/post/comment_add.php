<?php
/**
 * Receive comment adding request and return the comment added
 */

$comment = new Comment($conn);
$filter = new Filter($conn);

if(isset($_POST['path']) && isset($_POST['name']) && isset($_POST['content'])) {

    $path = $_POST['path'];
    $name = $filter->filter(htmlspecialchars($_POST['name']));
    $content = $filter->filter(htmlspecialchars($_POST['content']));

    if(isset($_POST['parent_id'])) {
        $parent_id = intval($_POST['parent_id']);
        $new_comment = $comment->add($path, $name, $content, $parent_id);
    }
    else {
        $new_comment = $comment->add($path, $name, $content);
    }

    $new_comment['avatar'] = md5( strtolower( trim( $new_comment['name']."@gmail.com " ) ) );
    $new_comment['time'] = date('Y-m-d H:i', $new_comment['time']);
    echo json_encode($new_comment);
    exit;
}
echo json_encode(false);
