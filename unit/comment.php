<?php
    // Test set up
    $comment = new Comment($conn);
    $comment->add('path/to/file', 'Haoran Yu', 'This is a test');
    $comment->add('path/to/file', 'Haoran Yu', 'This is a test2');

    $result = $comment->getByFile('path/to/file');
    $row = $result->fetch_object();
    Test::assertEqual('Insert and select', $row->name, 'Haoran Yu' );

    $comment->removeById($row->id);
    $result = $comment->getByFile('path/to/file');
    $row = $result->fetch_object();
    Test::assertEqual('Delete', $row->comment, 'This is a test2' );

    // Test Shut down
    $comment->removeById($row->id);
    $result->close();
