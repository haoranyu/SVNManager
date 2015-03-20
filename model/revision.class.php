<?php
    class Revision{
        private $treeStructure;

        function __construct($treeStructure) {
            $this->treeStructure = $treeStructure;
        }

        public function getRevision($file) {
            $path = explode('/', $file);
            $current = $this->treeStructure;
            foreach($path as $level) {
                if (array_key_exists($level, $current)) {
                    $current = &$current[$level];
                }
            }


            return $current['/METADATA']['commit'];
        }
    }