<?php
include_once '../db_connect.php';
include_once '../models/userModel.php';

session_start();

$userModel = new User($db);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $pseudo = $_POST['pseudo'];
    $password = $_POST['password'];

    $loggedIn = false;
    $users = $userModel->getAllUsers();

    foreach ($users as $user)
    {
        if ($user['pseudo'] == $pseudo && password_verify($password, $user['password']))
        {
            $loggedIn = true;
            $_SESSION['user'] = $user;
            header('Location: profil.php');
            exit();
        }
    }

    if (!$loggedIn)
    {
        echo 'Erreur de connexion. Pseudo ou mot de passe incorrect.';
    }
}