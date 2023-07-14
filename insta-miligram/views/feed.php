<?php
include_once '../controllers/profilController.php';
include_once '../models/userModel.php';
include_once 'head.php';
include_once 'header.php';

session_start();

if (isset($_SESSION['user']))
{
    $user = $_SESSION['user'];
}
else
{
    header('Location: login.php');
    exit();
}
?>

<body>
    <div class='container'>
        <h1>FEED</h1>
        <p>Cette fonctionnalité n'est pas encore disponible !</p>
    </div>
</body>