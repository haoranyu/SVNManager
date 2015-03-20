<?php
    class Svn{
        private $treeStructure;

        function __construct($treeStructure) {
            $this->treeStructure = $treeStructure;
        }

        public function getRootList() {
            $rootList = array();
            foreach($this->treeStructure as $key => $value) {
                $rootList[$key] = array_shift($value['/METADATA']['commit']);
                $rootList[$key]['type'] = $value['/METADATA']['type'];
            }
            return $rootList;
        }

        public function getList($file) {
            $path = explode('/', $file);
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
            }
            return $list;
        }
    }
