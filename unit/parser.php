<?php
    $parser = Parser::parse('./data/svn_log.xml', true);
    Test::assertEqual('Test parser 1', $parser['logentry'][0]['author'], 'hyu34' );
    Test::assertEqual('Test parser 2', $parser['logentry'][1]['@attributes'], array('revision' => '4124') );
    //print_r($parser);
