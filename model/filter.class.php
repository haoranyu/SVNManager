<?php
class Filter{
    private $conn;
    private $result;

    function __construct($conn) {
        $this->conn = $conn;
    }

    /**
     * Apply filter rules to content and do filtering work
     * @param  String $content The content to be filtered
     * @return String          The content after filtering
     */
    public function filter($content) {
        // get the tokenized content
        $tokens = $this->tokenize($content);

        // request to see what word needs filtering
        $filter_list = $this->getByTokens($tokens);
        foreach($filter_list as $filter_rule) {
            $content = str_ireplace($filter_rule['origin'], $filter_rule['result'], $content);
        }

        return $content;
    }

    /**
     * Request database to check which filter rules should apply
     * @param Array $tokens Tokenized contents
     */
    private function getByTokens($tokens) {
        $this->result = $this->conn->query("SELECT * FROM `filter` WHERE `origin` IN ('".implode("','", $tokens)."')" );
        return $this->result;
    }

    /**
     * Tokenize the input conent
     * @param  String $content The content to be tokenized
     * @return Array           An array of all words tokens
     */
    private function tokenize($content) {
        // remove symbols
        $content = preg_replace('/[^\p{L}\p{N}\s]/u', ' ', $content);

        // remove spaces at the beginning and end
        $content = trim($content);

        // remove continous spaces
        $content = preg_replace('/s(?=s)/', '', $content);

        // remove tab and newline
        $content = preg_replace('/[nrt]/', ' ', $content);

        // turn words to lower case and tokenize
        $tokens = explode(' ', strtolower($content));

        // remove duplicate tokens
        array_unique($tokens);

        return $tokens;
    }
}
