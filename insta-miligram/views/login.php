<?php
include_once '../controllers/loginController.php';
include_once 'head.php';
?>

<body>
    <div class='container'>
        <h1>CONNEXION</h1>
        <form method='POST' action=''>
            <div>
                <label for='pseudo'>Pseudo :</label>
                <input type='text' id='pseudo' name='pseudo' required>
            </div>
            <div>
                <label for='password'>Mot de passe :</label>
                <input type='password' id='password' name='password' required>
            </div>
            <button type='submit'>Se connecter</button>
        </form>  
        <p>Pas encore inscrit ? <a href='signup.php'>Créer un compte</a></p>
    </div>
</body>