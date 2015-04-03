<?php
/**
 * Class that applies unit tests
 */
class Test{
    public function assertEqual($name, $expect, $value) {
        if($expect === $value) {
            echo $name." test: PASSED\n";
        }
        else {
            echo $name." test: FAILED\n";
        }
    }
}
