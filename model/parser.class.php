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
            $this->addToTreeStructure($entry);
        }
        return $this->treeStructure;
    }

    private function addToTreeStructure($entry) {
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
                'author' => $author,
                'date' => $date
            )
        );

        if($filetype == 'file') {
            $commit[$revision]['size'] = $entry['size'];
        }

        $metadata = array(
            'type' => self::getFileType($filetype, $level),
            'commit' => $commit
        );

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
