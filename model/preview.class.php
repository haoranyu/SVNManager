<?php
/**
 * The model for file preview
 */
class Preview{
    private $treeStructure;

    /**
     * Constuctor of Preview
     * @param array $treeStructure The tree structure of all svn list and logs
     */
    function __construct($treeStructure) {
        $this->treeStructure = $treeStructure;
    }

    /**
     * Test if it is a file (folder otherwise)
     * @param string filename The absolute name of file/folder
     * @return boolean the filename is for a file
     */
    public function isFile($filename) {
        $path = explode('/', $filename);
        $current = $this->treeStructure;
        foreach($path as $level) {
            if (array_key_exists($level, $current)) {
                $current = &$current[$level];
            }
        }
        return $current['/METADATA']['type'] != '/';
    }
}
