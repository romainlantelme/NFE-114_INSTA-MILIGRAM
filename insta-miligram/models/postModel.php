<?php

class Post {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function getAllPosts() {
        $query = 'SELECT * FROM `POST`';
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getPostByID($postID) {
        $query = 'SELECT * FROM `POST` WHERE `id` = :postID';
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':postID', $postID);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getPostsByUserID($userID) {
        $query = 'SELECT * FROM `POST` WHERE `id_user` = :userID';
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':userID', $userID);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addPost($userID, $caption, $picture) {
        $query = 'INSERT INTO `POST` (id_user, caption, picture) VALUES (:userID, :caption, :picture)';
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':userID', $userID);
        $stmt->bindParam(':caption', $caption);
        $stmt->bindParam(':picture', $picture);
        $stmt->execute();
        return $this->db->lastInsertId();
    }

    public function deletePostByID($postID) {
        $query = 'DELETE FROM `POST` WHERE `id` = :postID';
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':postID', $postID);
        $stmt->execute();
        return $stmt->rowCount();
    }
}
