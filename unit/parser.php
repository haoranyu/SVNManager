<?php
    // Test set up
    $svnLog = Parser::parseXml('./resource/data/svn_log.xml', true);
    $svnList = Parser::parseXml('./resource/data/svn_list.xml', true);

    $parser = new Parser('./resource/data/svn_log.xml', './resource/data/svn_list.xml');
    $fileTree = $parser->buildTreeStructure();

    // Unit test running
    Test::assertEqual('Test xml parser for log 1', $svnLog['logentry'][0]['author'], 'hyu34' );
    Test::assertEqual('Test xml parser for log 2', $svnLog['logentry'][1]['@attributes'], array('revision' => '4124') );
    Test::assertEqual('Test xml parser for list 1', $svnList['list']['@attributes']['path'], 'https://subversion.ews.illinois.edu/svn/sp15-cs242/hyu34' );
    Test::assertEqual('Test xml parser for list 2', $svnList['list']['entry'][0]['commit']['author'], 'hyu34' );
    Test::assertEqual('Test treeStructure 1', $fileTree['Assignment1.0']['/METADATA']['commit']['1345']['author'], 'hyu34');
    Test::assertEqual('Test treeStructure 2', $fileTree['Assignment1.0']['Chess']['.classpath']['/METADATA']['type'], 'classpath' );
    Test::assertEqual('Test treeStructure with log 1', $fileTree['Assignment1.0']['/METADATA']['commit']['1161']['msg'], 'Commit for Assignment1.0');
