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
        <h1>PROFIL</h1>
        <form method='POST' action=''>
            <table>
                <tr>
                    <th>Pseudo</th>
                    <td contenteditable="true"><?php echo $user['pseudo']; ?></td>
                </tr>
                <tr>
                    <th>Prénom</th>
                    <td contenteditable="true"><?php echo $user['first_name']; ?></td>
                </tr>
                <tr>
                    <th>Nom</th>
                    <td contenteditable="true"><?php echo $user['last_name']; ?></td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td contenteditable="true"><?php echo $user['email']; ?></td>
                </tr>
                <tr>
                    <th>Biographie</th>
                    <td contenteditable="true"><?php echo $user['biography']; ?></td>
                </tr>
            </table>
            <input type="hidden" name="id" value="<?php echo $user['id']; ?>">
            <input type='submit' value='Modifier'>
        </form>
    </div>
</body>