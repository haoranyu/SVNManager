<?php
/**
 * The model for commenting
 */
class Comment{
    private $conn;
    private $result;

    function __construct($conn) {
        $this->conn = $conn;
    }

    /**
     * Add comment to a file
     * @param string  $path      The path of the file
     * @param string  $name      The name of who post comment
     * @param string  $comment   The content of comment
     * @param integer $parent_id The comment id that to be replied to
     */
    public function add($path, $name, $comment, $parent_id = 0) {
        $hash = hash('sha1', $path);
        $this->conn->query("INSERT INTO `Portfolio`.`comment` (`hash`, `name`, `comment`, `parent_id`, `time`) VALUES ('$hash', '$name', '$comment', '$parent_id', ".time().");");
        return $this->getById($this->conn->insert_id);
    }

    /**
     * Get the comment by given file path
     * @param string $path The path of the file
     */
    public function getByPath($path) {
        $hash = hash('sha1', $path);
        $this->result = $this->conn->query("SELECT * FROM `comment` WHERE `hash` = '$hash'");
        return $this->result;
    }

    /**
     * Remove comment by id
     * @param integer $id The id of comment
     */
    public function removeById($id) {
        return $this->conn->query("DELETE FROM `comment` WHERE `id` = $id");
    }

    /**
     * Get comment by id
     * @param integer $id The id of comment
     */
    private function getById($id) {
        $this->result = $this->conn->query("SELECT * FROM `comment` WHERE `id` = '$id' LIMIT 1");
        return $this->result->fetch_array();
    }
}
