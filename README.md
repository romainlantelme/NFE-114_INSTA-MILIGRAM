# INSTA-MILIGRAM

## DESCRIPTION

Le projet avait pour but de recréer certaines fonctionnalités du réseau social "INSTAGRAM" en PHP.

## DATABASE SCRIPT

```sql
CREATE TABLE `USER`(
    `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `pseudo` VARCHAR(50) UNIQUE NOT NULL,
    `first_name` VARCHAR(50) NULL,
    `last_name` VARCHAR(100) NULL,
    `email` VARCHAR(255) UNIQUE NOT NULL,
    `profile_picture` VARCHAR(255) NULL,
    `biography` VARCHAR(255) NULL,
    `password` VARCHAR(255) NOT NULL,
    `created_date` DATETIME DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

CREATE TABLE `POST`(
    `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `id_user` INT UNSIGNED NOT NULL,
    `caption` VARCHAR(255) NULL,
    `picture` VARCHAR(255) NOT NULL,
    `created_date` DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY(`id_user`) REFERENCES `USER`(`id`)
) ENGINE=InnoDB;

CREATE TABLE `COMMENT`(
    `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `id_user` INT UNSIGNED NOT NULL,
    `id_post` INT UNSIGNED NULL,
    `comment` VARCHAR(255) NOT NULL,
    `created_date` DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY(`id_user`) REFERENCES `USER`(`id`),
    FOREIGN KEY(`id_post`) REFERENCES `POST`(`id`)
) ENGINE=InnoDB;

CREATE TABLE `FOLLOWER`(
    `id_user_followed` INT UNSIGNED NOT NULL,
    `id_user_following` INT UNSIGNED NOT NULL,
    FOREIGN KEY(`id_user_followed`) REFERENCES `USER`(`id`),
    FOREIGN KEY(`id_user_following`) REFERENCES `USER`(`id`)
) ENGINE=InnoDB;
```

***
<br/>

## FILES

### `config.php`

le fichier `config.php` est utilisé pour définir les informations de configuration nécessaires à la connexion à la base de données MySQL, telles que l'hôte, le nom de la base de données, le jeu de caractères, le nom d'utilisateur et le mot de passe.

```php
define('DB_HOST', 'localhost');
define('DB_NAME', 'insta-miligram');
define('DB_CHARSET', 'utf8');
define('DB_USER', 'root');
define('DB_PASSWORD', '');
```
Ces constantes peuvent être utilisées dans d'autres fichiers pour faciliter la configuration de la connexion à la base de données.

<br/>

### `db_connect.php`

Le fichier `db_connect.php` permet de se connecter à une base de données MySQL en utilisant PDO, en utilisant les informations de configuration fournies dans le fichier `config.php`. Il configure également PDO pour lancer des exceptions en cas d'erreur de requête, ce qui facilite la gestion des erreurs lors de l'interaction avec la base de données.

```php
require_once 'config.php';

$dsn = 'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=' . DB_CHARSET;

try {
    $db = new PDO($dsn, DB_USER, DB_PASSWORD);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'Erreur de connexion : ' . $e->getMessage();
    exit();
}
```

<br/>

### `models/userModel.php`

Le fichier `models/userModel.php` contient une classe "User" qui encapsule les opérations liées à la gestion des utilisateurs dans une base de données. Il fournit des méthodes pour récupérer, ajouter, mettre à jour et supprimer des utilisateurs, ainsi que pour vérifier si un pseudo ou une adresse e-mail est déjà pris par un autre utilisateur.

```php
getAllUsers();
getUserByID($userID);
getUserByPseudo($pseudo);
getUserByFirstName($firstName);
getUserByLastName($lastName);
getUserByFirstAndLastName($firstName, $lastName);
addUser($pseudo, $firstName, $lastName, $email, $profilePicture, $biography, $password);
public function deleteUserByID($userID);
updateUserByID($userID, $pseudo, $firstName, $lastName, $email, $profilePicture, $biography);
```

<br/>

### `models/postModel.php`

Le fichier `models/postModel.php` contient une classe "Post" qui encapsule les opérations liées à la gestion des posts dans une base de données. Il fournit des méthodes pour récupérer tous les posts, récupérer un post par son identifiant, récupérer les posts d'un utilisateur spécifique, ajouter un nouveau post et supprimer un post.

```php
getAllPosts());
getPostByID($postID);
getPostsByUserID($userID);
addPost($userID, $caption, $picture);
deletePostByID($postID);
```

<br/>

### `models/commentModel.php`

Le fichier `models/commentModel.php` contient une classe "Comment" qui encapsule les opérations liées à la gestion des commentaires dans une base de données. Il fournit des méthodes pour récupérer tous les commentaires, récupérer un commentaire par son identifiant, récupérer les commentaires associés à un post spécifique, ajouter un nouveau commentaire et supprimer un commentaire.

```php
getAllComments();
getCommentByID($commentID);
getCommentsByPostID($postID);
addComment($userID, $postID, $comment);
deleteCommentByID($commentID);
```

<br/>

### `controllers/loginController.php

Le fichier `controllers/loginController.php` gère le processus de connexion d'un utilisateur. Il récupère les informations de connexion depuis le formulaire, vérifie les informations avec celles stockées dans la base de données, enregistre l'utilisateur dans une variable de session et redirige l'utilisateur vers la page de profil (`views/profil.php`) en cas de succès. Sinon, il affiche un message d'erreur en cas d'échec d'authentification.

<br/>

### `views/login.php`

Le fichier `views/login.php` représente la vue de la page de connexion. Il affiche un formulaire de connexion avec des champs pour le pseudo et le mot de passe, ainsi qu'un bouton pour se connecter. Il fournit également un lien vers la page d'inscription pour les nouveaux utilisateurs. Lorsque le formulaire est soumis, les données sont traitées par le fichier `controllers/loginController.php` pour effectuer la logique de connexion.

<br/>

### `controllers/signupController.php`

Le fichier `controllers/signupController.php` gère le processus d'inscription d'un nouvel utilisateur. Il vérifie la disponibilité du pseudo et de l'e-mail, ajoute l'utilisateur à la base de données, affiche des messages de succès ou d'erreur, et effectue une vérification supplémentaire pour authentifier l'utilisateur nouvellement inscrit.

<br/>

### `views/signup.php`

Le fichier `views/signup.php` représente la vue de la page d'inscription. Il affiche un formulaire d'inscription avec des champs pour le pseudo, le prénom, le nom, l'e-mail et le mot de passe, ainsi qu'un bouton pour s'inscrire. Il fournit également un lien vers la page de connexion pour les utilisateurs déjà inscrits. Lorsque le formulaire est soumis, les données sont traitées par le fichier `controllers/signupController.php` pour effectuer la logique d'inscription.

<br/>

### `controllers/profilController.php`

Le fichier `controllers/profileController.php` gère le processus de mise à jour du profil d'un utilisateur. Il récupère les nouvelles informations du formulaire de mise à jour, met à jour les informations de l'utilisateur dans la base de données et redirige l'utilisateur vers la page de profil mise à jour.

<br/>

### `views/profil.php`

Le fichier `views/profile.php` représente la vue de la page de profil de l'utilisateur connecté. Il affiche les informations de profil de l'utilisateur dans un formulaire éditable, permettant à l'utilisateur de modifier les valeurs et de les soumettre pour mise à jour. Les données du formulaire sont traitées par le fichier `controllers/profileController.php` pour effectuer la logique de mise à jour du profil. Si aucun utilisateur n'est connecté, l'utilisateur est redirigé vers la page de connexion.

<br/>

### `views/logout.php`

 le fichier `logout.php` est utilisé pour effectuer la déconnexion d'un utilisateur. Il supprime les données de session, détruit la session et redirige l'utilisateur vers la page de connexion. Cela permet à l'utilisateur de se déconnecter en toute sécurité et de revenir à l'écran de connexion pour une nouvelle session.
 
```php
session_start();
session_unset();
session_destroy();
header("Location: login.php");
exit();
```

<br/>

## SECURITE

L'utilisation de `bindValue` dans les requêtes préparées aide à sécuriser les requêtes SQL en prévenant les attaques par injection et en échappant automatiquement les caractères spéciaux. Cela renforce la sécurité de l'application en garantissant que les données sont correctement traitées par la base de données et en évitant les vulnérabilités potentielles liées à l'entrée utilisateur.

<br/>

## AXE D'AMELIORATION

Le projet actuel offre un bon point de départ, mais il existe plusieurs axes d'amélioration pour garantir un projet plus abouti comme l'amélioration du un code, une meilleure gestion des erreurs et la finalisation des fonctionnalités non fonctionnelles (recherche utilisateur, poster une publication, suivre des utilisateurs, commenter, visualiser des posters, etc).

<br/>

## PROBLEMES RENCONTRES

- Première création d'un MVC,
- Connaissance limité en PHP malgré des quelques bases,
- Problème avec docker/dev-container,
- Projet peut-être trop complexe,
- Préoccupation sur le mémoire/souteance,
- Rush de fin d'année (pas concentré et consacré à 100% sur le projet),
