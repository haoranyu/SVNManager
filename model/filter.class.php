<?php
class Filter{
    private $conn;
    private $result;

    function __construct($conn) {
        $this->conn = $conn;
    }

    public function filter($content) {
        $tokens = $this->tokenize($content);
        $filter_list = $this->getByTokens($tokens);
        foreach($filter_list as $filter_rule) {
            $content = str_ireplace($filter_rule['origin'], $filter_rule['result'], $content);
        }

        return $content;
    }

    private function getByTokens($tokens) {
        $this->result = $this->conn->query("SELECT * FROM `filter` WHERE `origin` IN ('".implode("','", $tokens)."')" );
        return $this->result;
    }

    private function tokenize($content) {
        // remove symbols
        $content = preg_replace('/[^\p{L}\p{N}\s]/u', ' ', $content);

        // remove spaces at the beginning and end
        $content = trim($content);

        // remove continous spaces
        $content = preg_replace('/s(?=s)/', '', $content);

        // remove tab and newline
        $content = preg_replace('/[nrt]/', ' ', $content);

        return explode(' ', strtolower($content));
    }
}
