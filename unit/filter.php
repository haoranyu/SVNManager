<?php
    // Test set up
    $filter = new Filter($conn);

    Test::assertEqual('fuck Fuck FUCK', $filter->filter('fuck Fuck FUCK'), 'f**k f**k f**k' );
    Test::assertEqual('I do not like fuck', $filter->filter('I do not like fuck'), 'I do not like f**k' );
