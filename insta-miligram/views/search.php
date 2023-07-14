<?php
// search.php

session_start();

include_once '../controllers/searchController.php';

if (isset($_SESSION['user'])) {
    $user = $_SESSION['user'];

    $searchedUser = null;

    if (isset($_GET['search'])) {
        $searchPseudo = $_GET['search'];

        $profilController = new ProfilController();
        $searchedUser = $profilController->searchUserByPseudo($searchPseudo);
    }

    include 'head.php';
    include 'header.php';
    ?>

    <body>
        <div class='container'>
            <h1>SEARCH</h1>
            <form method="GET" action="">
                <input type="text" name="search" placeholder="Rechercher un utilisateur par pseudo :" required>
                <button type="submit">Rechercher</button>
            </form>

            <?php
            if ($searchedUser) {
                echo "<div class='user-info'>";
                echo "<h2>Informations de l'utilisateur :</h2>";
                echo "<p>Nom d'utilisateur : " . $searchedUser['username'] . "</p>";
                // Affichez d'autres détails de l'utilisateur si nécessaire
                echo "</div>";
            } else if (isset($_GET['search'])) {
                echo "<p>Aucun utilisateur trouvé avec le pseudo : " . $_GET['search'] . "</p>";
            }
            ?>
        </div>
    </body>
    <?php
} else {
    header('Location: login.php');
    exit();
}