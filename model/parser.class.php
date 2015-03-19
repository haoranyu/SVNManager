<?php
class Parser{
    public function parse($xmlFile, $toArray = false) {
        if($toArray) {
            return json_decode(json_encode(simplexml_load_file($xmlFile)), TRUE);
        }
        else {
            return simplexml_load_file($xmlFile);
        }
    }
}
