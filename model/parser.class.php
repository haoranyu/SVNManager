<?php
class Parser{
    private $svnLog;
    private $svnList;
    private $treeStructure;

    function __construct($svnLogFile, $svnListFile) {
        $this->svnLog = self::parseXml($svnLogFile, true);
        $this->svnList = self::parseXml($svnListFile, true);
    }
    public function parseXml($xmlFile, $toArray = false) {
        if($toArray) {
            return json_decode(json_encode(simplexml_load_file($xmlFile)), TRUE);
        }
        else {
            return simplexml_load_file($xmlFile);
        }
    }

    public function buildTreeStructure() {
        $this->treeStructure = array();
        foreach($this->svnList['list']['entry'] as $entry) {
            $this->processListEnrty($entry);
        }
        $this->addLogToStructure();
        return $this->treeStructure;
    }

    public function addLogToStructure() {
        foreach($this->svnLog['logentry'] as $entry) {
            $this->processLogEnrty($entry);
        }
    }

    private function processLogEnrty($entry) {
        $files = (array)($entry['paths']['path']);
        foreach($files as $file) {
            $file = substr($file, 7);
            $this->addLogToFile($file, $entry);
        }
    }

    private function addLogToFile($file, $entry) {
        $revision = $entry['@attributes']['revision'];
        $author = $entry['author'];
        $date = $entry['date'];
        $msg = $entry['msg'];

        $path = explode('/', $file);
        $current = &$this->treeStructure;
        foreach($path as $level) {
            if (array_key_exists($level, $current)) {
                $current = &$current[$level];


                if(array_key_exists('/METADATA', $current)) {
                    if(array_key_exists($revision, $current['/METADATA']['commit'])) {
                        $current['/METADATA']['commit'][$revision]['msg'] = $msg;

                    }
                    else {
                        $revisionData = array(
                            'revision' => $revision,
                            'author' => $author,
                            'date' => $date,
                            'msg' => $msg
                        );
                        $current['/METADATA']['commit'][$revision] = $revisionData;
                    }
                }
            }
        }
    }

    private function processListEnrty($entry) {
        $filename = $entry['name'];
        $path = explode('/', $entry['name']);
        $current = &$this->treeStructure;
        foreach($path as $level) {
            if (array_key_exists($level, $current)) {
                $current = &$current[$level];
            }
            else {
                $current[$level] = self::buildNode($entry, $level);
            }
        }
    }

    private function buildNode($entry, $level) {
        $revision = $entry['commit']['@attributes']['revision'];
        $filetype = $entry['@attributes']['kind'];
        $author = $entry['commit']['author'];
        $date = $entry['commit']['date'];

        $commit = array(
            $revision => array(
                'revision' => $revision,
                'author' => $author,
                'date' => $date
            )
        );

        $metadata = array(
            'type' => self::getFileType($filetype, $level),
            'path' => $entry['name'],
            'commit' => $commit
        );

        if($filetype == 'file') {
            $metadata['size'] = $entry['size'];
        }

        return array('/METADATA' => $metadata);
    }

    private function getFileType($filetype, $filename) {
        if($filetype == 'dir') {
            return '/';
        }
        else {
            return pathinfo($filename, PATHINFO_EXTENSION);
        }
    }
}
