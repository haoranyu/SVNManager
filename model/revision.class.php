<?php
/**
 * The model for managing revision
 */
class Revision{
    private $treeStructure;

    /**
     * Constuctor of Revision
     * @param array $treeStructure The tree structure of all svn list and logs
     */
    function __construct($treeStructure) {
        $this->treeStructure = $treeStructure;
    }

    /**
     * Get the revision of a specified file or folder according to the filename
     * @param string $filename The absolute name of file/folder
     * @return array All revision information
     */
    public function getRevision($filename) {
        $path = explode('/', $filename);
        $current = $this->treeStructure;
        foreach($path as $level) {
            if (array_key_exists($level, $current)) {
                $current = &$current[$level];
            }
        }
        return $current['/METADATA']['commit'];
    }
}
