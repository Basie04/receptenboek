<?php
require "database.php";
if (
    isset($_POST['submit']) && isset($_POST['voornaam']) && isset($_POST['achternaam']) &&
    isset($_POST['email']) && isset($_POST['wachtwoord']) && !empty($_POST['voornaam']) &&
    !empty($_POST['achternaam']) && !empty($_POST['email']) && !empty($_POST['wachtwoord'])
) 
{
    $stmt = $conn->prepare("INSERT INTO gebruiker (voornaam, achternaam, email, password) VALUES (:voornaam, :achternaam, :email, :password)");
    $stmt->bindParam(":voornaam", $_POST['voornaam']);
    $stmt->bindParam(":achternaam", $_POST['achternaam']);
    $stmt->bindParam(":email", $_POST['email']);
    $stmt->bindParam(":password", $_POST['wachtwoord']);
    $stmt->execute();
    header("Location: index.php");

}




require "navbar.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Document</title>
</head>

<body>
    <div class="backgroundGradientDiv"></div>
    <div class="page_contents">
        <form action="" method="post">
            <label for="voornaam">voornaam</label>
            <input type="text" name="voornaam" id="voornaam" required>
            <label for="achternaam">achternaam</label>
            <input type="text" name="achternaam" id="achternaam" required>
            <label for="email">email</label>
            <input type="text" name="email" id="email" required>
            <label for="wachtwoord">wachtwoord</label>
            <input type="password" name="wachtwoord" id="wachtwoord" required>
            <input type="submit" value="submit" name="submit">
        </form>
    </div>
</body>

</html>