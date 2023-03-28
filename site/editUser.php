<?php
require 'database.php';
require 'glob_check_func.php';
try_session_start();
restrictAccessToAdmin();

if (isset($_POST["submit"])) {
    if ($_POST["submit"] != 'delete' && $_POST["submit"] != 'submit') {
        echo "Er is geen geldige keus gemaakt";
    }
    

    if ($_POST["submit"] == 'delete') {
        $stmt = $conn->prepare("DELETE FROM gebruiker WHERE gebruiker.id = :id");
        $stmt->bindParam(':id', $_GET['id']);
        $stmt->execute();
        header('Location: beheergebruikers.php');
        die();
    }

    if ($_POST["submit"] == 'submit') {
        $stmt = $conn->prepare("UPDATE gebruiker SET voornaam = :voornaam, achternaam = :achternaam, email = :email, rol = :rol WHERE gebruiker.id = :id");
        $stmt->bindParam(':id', $_GET['id']);
        $stmt->bindParam(':voornaam', $_POST['voornaam']);
        $stmt->bindParam(':achternaam', $_POST['achternaam']);
        $stmt->bindParam(':email', $_POST['email']);
        $stmt->bindParam(':rol', $_POST['rol']);
        $stmt->execute();
    }
}



$stmt = $conn->prepare("SELECT * FROM gebruiker JOIN rollen ON rollen.id = gebruiker.rol WHERE gebruiker.id = :id");
$stmt->bindParam(':id', $_GET['id']);
$stmt->execute();
$userdata = $stmt->fetch(PDO::FETCH_ASSOC);

$stmt = $conn->prepare("SELECT id, rol_naam FROM rollen");
$stmt->execute();
$rollen = $stmt->fetchAll(PDO::FETCH_ASSOC);





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

    <form action="" method="post">
        <label for="voornaam">voornaam</label>
        <input type="text" name="voornaam" id="voornaam" value="<?php echo $userdata['voornaam']; ?>" required>
        <label for="achternaam">achternaam</label>
        <input type="text" name="achternaam" id="achternaam" value="<?php echo $userdata['achternaam']; ?>" required>
        <label for="email">email</label>
        <input type="text" name="email" id="email" value="<?php echo $userdata['email']; ?>" required>
        <label for="rol">rol</label>
        <select name="rol" id="rol" required>
            <option value="<?php echo $userdata['rol']; ?>" hidden default><?php echo $userdata['rol_naam']; ?></option>
            <?php
            foreach ($rollen as $rol) { ?>
                <option value="<?php echo $rol['id']; ?>"><?php echo $rol['rol_naam']; ?></option>
            <?php } ?>

        </select>
        <input type="submit" value="submit" name="submit">
        <input type="submit" value="delete" name="submit">
    </form>
</body>

</html>