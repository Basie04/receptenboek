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
        <a href="index.php">Home</a>
        <a href="">Specialitijten</a>
        <a href="">Ingredienten</a>
        <?php
        if (isset($_SESSION["userdata"]["id"])) {
            if($_SESSION['userdata']['rol'] == 'eigenaar' || $_SESSION['userdata']['rol'] == 'manager'){
                echo '<a href="beheergebruikers.php">Beheer</a>';
            }
            echo "<a href='logout.php'>Uitloggen</a>";
        } else {
            echo "<a href='login.php'>Inloggen</a>";
            echo "<a href='registreren.php'>Registreren</a>";
        }
        ?>
    </nav>

</body>

</html>