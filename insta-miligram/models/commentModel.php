<?php

class Comment {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function getAllComments() {
        $query = 'SELECT * FROM `COMMENT`';
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getCommentByID($commentID) {
        $sql = 'SELECT * FROM `COMMENT` WHERE `id` = :commentID';
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':commentID', $commentID);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getCommentsByPostID($postID) {
        $sql = 'SELECT * FROM `COMMENT` WHERE `id_post` = :postID';
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':postID', $postID);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addComment($userID, $postID, $comment) {
        $sql = 'INSERT INTO `COMMENT` (id_user, id_post, comment) VALUES (:userID, :postID, :comment)';
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':userID', $userID);
        $stmt->bindParam(':postID', $postID);
        $stmt->bindParam(':comment', $comment);
        $stmt->execute();
        return $this->db->lastInsertId();
    }

    public function deleteCommentByID($commentID) {
        $sql = 'DELETE FROM `COMMENT` WHERE `id` = :commentID';
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':commentID', $commentID);
        $stmt->execute();
        return $stmt->rowCount();
    }
}
