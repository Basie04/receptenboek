<?php
require 'database.php';
require 'glob_check_func.php';
try_session_start();
restrictAccessToAdmin();

if (isset($_POST["submit"])) {

    if ($_POST["submit"] != 'submit') {
        echo "Er is geen geldige keus gemaakt";
    }

    if ($_POST["submit"] == 'submit') {
        if (
            isset($_POST['voornaam']) && isset($_POST['achternaam']) &&
            isset($_POST['email']) && isset($_POST['pass']) &&
            isset($_POST['rol']) && rolHasValidValue()
        ) {

            $stmt = $conn->prepare("INSERT INTO gebruiker (voornaam, achternaam, email, password, rol) 
            VALUES (:voornaam, :achternaam, :email, :pass, :rol)");
            $stmt->bindParam(':voornaam', $_POST['voornaam']);
            $stmt->bindParam(':achternaam', $_POST['achternaam']);
            $stmt->bindParam(':email', $_POST['email']);
            $stmt->bindParam(":pass", $_POST['pass']);
            $stmt->bindParam(':rol', $_POST['rol']);
            $stmt->execute();
            header('Location: beheergebruikers.php');
        } else {
            echo "niet alle velden zijn ingevuld, vul eerst alle velden in";
        }
    }
}

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
        <input type="text" name="voornaam" id="voornaam" value="" required>
        <label for="achternaam">achternaam</label>
        <input type="text" name="achternaam" id="achternaam" value="" required>
        <label for="email">email</label>
        <input type="text" name="email" id="email" value="" required>
        <label for="pass">pass</label>
        <input type="password" name="pass" id="password" value="" required>
        <label for="rol">rol</label>
        <select name="rol" id="rol" required>
            <?php
            foreach ($rollen as $rol) { ?>
                <option value="<?php echo $rol['id']; ?>"><?php echo $rol['rol_naam']; ?></option>
            <?php } ?>

        </select>
        <input type="submit" value="submit" name="submit">
    </form>
</body>

</html>