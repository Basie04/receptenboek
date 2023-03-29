<?php
//hier kan een administator gebruikers bewerken en verwijderen.
require 'glob_check_func.php';
require 'database.php';
try_session_start();

restrictAccessToAdmin();

//vind alle gebruikers
$stmt = $conn->prepare("SELECT gebruiker.id, voornaam, achternaam, email, rol_naam FROM gebruiker JOIN rollen ON rollen.id = gebruiker.rol");
$stmt->execute();
$allUsers = $stmt->fetchAll(PDO::FETCH_ASSOC);


require 'navbar.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <div class="backgroundGradientDiv"></div>
    <table>
        <thead>
            <th>id</th>
            <th>voornaam</th>
            <th>achternaam</th>
            <th>email</th>
            <th>rol</th>
            <th>edit</th>
        </thead>
        <tbody>
            <tr>
                <td colspan="5"></td>
                <td><a href="mkNewUser.php">create new</a></td>
            </tr>
            <?php foreach ($allUsers as $user) { ?>
                <tr>
                    <td><?php echo $user['id']; ?></td>
                    <td><?php echo $user['voornaam']; ?></td>
                    <td><?php echo $user['achternaam']; ?></td>
                    <td><?php echo $user['email']; ?></td>
                    <td><?php echo $user['rol_naam']; ?></td>
                    <td><a href=<?php echo "editUser.php?id=" . $user['id']; ?>>edit</a></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</body>

</html>