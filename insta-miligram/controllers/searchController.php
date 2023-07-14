<?php
include_once '../db_connect.php';
include_once '../models/userModel.php';

$userModel = new User($db);

class ProfilController {
    public function searchUserByPseudo($pseudo) {
        $searchedUser = $userModel->getUserByPseudo($pseudo);
        return $searchedUser;
    }
}
?>
