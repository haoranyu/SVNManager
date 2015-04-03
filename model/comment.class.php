<?php
class Comment{
    private $conn;
    private $result;

    function __construct($conn) {
        $this->conn = $conn;
    }

    public function add($path, $name, $comment, $parent_id = 0) {
        $hash = hash('sha1', $path);
        $this->conn->query("INSERT INTO `Portfolio`.`comment` (`hash`, `name`, `comment`, `parent_id`, `time`) VALUES ('$hash', '$name', '$comment', '$parent_id', ".time().");");
        return $this->getById($this->conn->insert_id);
    }

    public function getByPath($path) {
        $hash = hash('sha1', $path);
        $this->result = $this->conn->query("SELECT * FROM `comment` WHERE `hash` = '$hash'");
        return $this->result;
    }

    public function removeById($id) {
        return $this->conn->query("DELETE FROM `comment` WHERE `id` = $id");
    }

    private function getById($id) {
        $this->result = $this->conn->query("SELECT * FROM `comment` WHERE `id` = '$id' LIMIT 1");
        return $this->result->fetch_array();
    }
}
