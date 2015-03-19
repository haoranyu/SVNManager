<?php
    $svnLog = Parser::parse('./resource/data/svn_log.xml', true);
    $svnList = Parser::parse('./resource/data/svn_list.xml', true);
    Test::assertEqual('Test parser for log 1', $svnLog['logentry'][0]['author'], 'hyu34' );
    Test::assertEqual('Test parser for log 2', $svnLog['logentry'][1]['@attributes'], array('revision' => '4124') );
    Test::assertEqual('Test parser for list 1', $svnList['list']['@attributes']['path'], 'https://subversion.ews.illinois.edu/svn/sp15-cs242/hyu34' );
    Test::assertEqual('Test parser for list 2', $svnList['list']['entry'][0]['commit']['author'], 'hyu34' );
//    print_r($svnList);
