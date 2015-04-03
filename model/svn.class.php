<?php
/**
 * The model for parsing the Svn log
 */
class Svn{
    private $treeStructure;

    /**
     * Constuctor of Svn
     * @param array $treeStructure The tree structure of all svn list and logs
     */
    function __construct($treeStructure) {
        $this->treeStructure = $treeStructure;
    }

    /**
     * Get the list of files and folders accroding to root folder
     * @return array The list of files and folders accroding to root folder
     */
    public function getRootList() {
        $rootList = array();
        foreach($this->treeStructure as $key => $value) {
            $rootList[$key] = (array)array_shift($value['/METADATA']['commit']);
            $rootList[$key]['type'] = $value['/METADATA']['type'];

            if(array_key_exists('size', $value['/METADATA'])) {
                $rootList[$key]['size'] = $value['/METADATA']['size'];
            }
            else {
                $rootList[$key]['size'] = '-';
            }
        }
        return $rootList;
    }

    /**
     * Get the list of files and folders accroding to the filename
     * @param string $filename The absolute name of file/folder
     * @return array The list of files and folders accroding to the filename
     */
    public function getList($filename) {
        $path = explode('/', $filename);
        $current = $this->treeStructure;
        foreach($path as $level) {
            if (array_key_exists($level, $current)) {
                $current = &$current[$level];
            }
        }

        $list = array();
        foreach($current as $key => $value) {
            if($key == '/METADATA') {
                continue;
            }
            $list[$key] = array_shift($value['/METADATA']['commit']);
            $list[$key]['type'] = $value['/METADATA']['type'];

            if(array_key_exists('size', $value['/METADATA'])) {
                $list[$key]['size'] = $value['/METADATA']['size'];
            }
            else {
                $list[$key]['size'] = '-';
            }
        }
        return $list;
    }
}
