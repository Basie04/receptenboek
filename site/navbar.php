<?php
if (!isset($_SESSION)) {
    session_start();
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <nav class="globalNavbar">
        <a href="">Home</a>
        <a href="">Recepten</a>
        <a href="">Specialitijten</a>
        <a href="">Ingredienten</a>
        <?php
        if (isset($_SESSION["userdata"]["id"])) {
            echo "<a href='logout.php'>Uitloggen</a>";
        } else {
            echo "<a href='login.php'>Inloggen</a>";
        }
        ?>
        <a href="">Registreren</a>
    </nav>

</body>

</html>