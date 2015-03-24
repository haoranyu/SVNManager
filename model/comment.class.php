<?php
class Comment{
    private $conn;
    private $result;

    function __construct($conn) {
        $this->conn = $conn;
    }

    public function add($file, $name, $comment, $parent_id = 0) {
        $hash = hash('sha1', $file);
        $this->conn->query("INSERT INTO `Portfolio`.`comment` (`hash`, `name`, `comment`, `parent_id`, `time`) VALUES ('$hash', '$name', '$comment', '$parent_id', ".time().");");
    }

    public function getByFile($file) {
        $hash = hash('sha1', $file);
        $this->result = $this->conn->query("SELECT * FROM `comment` WHERE `hash` = '$hash'");
        return $this->result;
    }

    public function removeById($id) {
        return $this->conn->query("DELETE FROM `comment` WHERE `id` = $id");
    }
}
