<?php

class User {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function getAllUsers() {
        $query = 'SELECT * FROM `USER`';
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getUserByID($userID) {
        $query = 'SELECT * FROM `USER` WHERE `id` = :userID';
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':userID', $userID);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getUserByPseudo($pseudo) {
        $query = 'SELECT * FROM `USER` WHERE `pseudo` = :pseudo';
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':pseudo', $pseudo);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function addUser($pseudo, $firstName, $lastName, $email, $profilePicture, $biography, $password) {
        $query = 'INSERT INTO `USER` (pseudo, first_name, last_name, email, profile_picture, biography, password)
                VALUES (:pseudo, :firstName, :lastName, :email, :profilePicture, :biography, :password)';
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':pseudo', $pseudo);
        $stmt->bindParam(':firstName', $firstName);
        $stmt->bindParam(':lastName', $lastName);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':profilePicture', $profilePicture);
        $stmt->bindParam(':biography', $biography);
        $stmt->bindParam(':password', $password);
        $stmt->execute();
        return $this->db->lastInsertId();
    }

    public function deleteUserByID($userID) {
        $query = 'DELETE FROM `USER` WHERE `id` = :userID';
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':userID', $userID);
        $stmt->execute();
        return $stmt->rowCount();
    }

    public function updateUserByID($userID, $pseudo, $firstName, $lastName, $email, $profilePicture, $biography) {
        $query = 'UPDATE `USER` SET `pseudo` = :pseudo, `first_name` = :firstName, `last_name` = :lastName, `email` = :email,
                `profile_picture` = :profilePicture, `biography` = :biography WHERE `id` = :userID';
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':pseudo', $pseudo);
        $stmt->bindParam(':firstName', $firstName);
        $stmt->bindParam(':lastName', $lastName);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':profilePicture', $profilePicture);
        $stmt->bindParam(':biography', $biography);
        $stmt->bindParam(':userID', $userID);
        $stmt->execute();
        return $stmt->rowCount();
    }

    public function isPseudoTaken($pseudo) {
        $query = "SELECT COUNT(*) FROM user WHERE pseudo = :pseudo";
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':pseudo', $pseudo);
        $stmt->execute();
        $count = $stmt->fetchColumn();
        return $count > 0;
    }

    public function isEmailTaken($email) {
        $query = "SELECT COUNT(*) FROM user WHERE email = :email";
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':email', $email);
        $stmt->execute();
        $count = $stmt->fetchColumn();
        return $count > 0;
    }
}
