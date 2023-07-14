<?php
include_once '../controllers/signupController.php';
include_once 'head.php';
?>

<body>
    <div class='container'>
        <h1>INSCRIPTION</h1>
        <form method='POST' action=''>
            <div>
                <label for='pseudo'>Pseudo :</label>
                <input type='text' id='pseudo' name='pseudo' required>
            </div>
            <div>
                <label for='firstName'>Prénom :</label>
                <input type='text' id='firstName' name='firstName' required>
            </div>
            <div>
                <label for='lastName'>Nom :</label>
                <input type='text' id='lastName' name='lastName' required>
            </div>
            <div>
                <label for='email'>Email :</label>
                <input type='email' id='email' name='email' required>
            </div>
            <div>
                <label for='password'>Mot de passe :</label>
                <input type='password' id='password' name='password' required>
            </div>
            <button type='submit'>S'inscrire</button>
        </form>
        <p>Déjà inscrit ? <a href='login.php'>Se connecter</a></p>
    </div>
</body>