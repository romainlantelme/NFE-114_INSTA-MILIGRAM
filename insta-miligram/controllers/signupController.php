<?php
include_once '../db_connect.php';
include_once '../models/userModel.php';

session_start();

$userModel = new User($db);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $pseudo = $_POST['pseudo'];
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    if ($userModel->isPseudoTaken($pseudo)) {
        echo 'Pseudo déjà utilisé ! Veuillez en choisir un autre.';
    }
    else if ($userModel->isEmailTaken($email)) {
        echo 'Email déjà utilisé ! Veuillez en choisir un autre.';
    }
    else
    {
        $userID = $userModel->addUser($pseudo, $firstName, $lastName, $email, '', '', password_hash($password, PASSWORD_DEFAULT));
    
        if ($userID) {
            echo 'L\'utilisateur a été ajouté !';

            $users = $userModel->getAllUsers();

            foreach ($users as $user)
            {
                if ($user['pseudo'] == $pseudo && password_verify($password, $user['password']))
                {
                    header('Location: profil.php');
                    exit();
                }
            }
        } else {
            echo 'Une erreur s\'est produite lors de l\'ajout de l\'utilisateur.';
        }
    }
}
?>