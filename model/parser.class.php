<?php
class Parser{
    private $svnLog;
    private $svnList;
    private $treeStructure;

    /**
     * Construct svn log and list according to the input
     * @param String $svnLogFile  Svn log file absolute name
     * @param String $svnListFile Svn list file absolute name
     */
    function __construct($svnLogFile, $svnListFile) {
        $this->svnLog = self::parseXml($svnLogFile, true);
        $this->svnList = self::parseXml($svnListFile, true);
    }

    /**
     * Xml parser
     * @param String $xmlFile Xml file absolute name
     * @param Boolean $toArray Whether to turn it to array
     * @return mixed SimpleXMLElement or Array of the original xml file
     */
    public function parseXml($xmlFile, $toArray = false) {
        if($toArray) {
            return json_decode(json_encode(simplexml_load_file($xmlFile)), TRUE);
        }
        else {
            return simplexml_load_file($xmlFile);
        }
    }

    /**
     * Build a tree structure of svn records
     * @return Array The tree of svn records
     */
    public function buildTreeStructure() {
        $this->treeStructure = array();
        foreach($this->svnList['list']['entry'] as $entry) {
            $this->processListEnrty($entry);
        }
        $this->addLogToStructure();
        return $this->treeStructure;
    }

    /**
     * Read svn log and add revision to the tree structure of svn records
     */
    private function addLogToStructure() {
        foreach($this->svnLog['logentry'] as $entry) {
            $this->processLogEnrty($entry);
        }
    }

    /**
     * Process each log entry
     * @param Array $entry Entry of svn log
     */
    private function processLogEnrty($entry) {
        $files = (array)($entry['paths']['path']);
        foreach($files as $file) {
            $file = substr($file, 7);
            $this->addLogToFile($file, $entry);
        }
    }

    /**
     * Add log to the file specified
     * @param String $file The file to add to log
     * @param Array $entry Entry of svn log
     */
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

    /**
     * Process each list entry
     * @param Array $entry Entry of svn list
     */
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

    /**
     * build each list entry node
     * @param Array $entry The entry we are goding to build
     * @param String $level The level relation of the filename(path)
     */
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

    /**
     * Get the type of the file
     * @param String $filetype The basic type (dir/file) of the file
     * @param String $filename The filename with suffix of the file
     */
    private function getFileType($filetype, $filename) {
        if($filetype == 'dir') {
            return '/';
        }
        else {
            return pathinfo($filename, PATHINFO_EXTENSION);
        }
    }
}
