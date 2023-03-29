<?php
require "database.php";
if (!isset($_SESSION)) {
    session_start();
}

$stmt = $conn->prepare("SELECT COUNT(*) AS count FROM recept");
$stmt->execute();
$recepten = $stmt->fetch(PDO::FETCH_ASSOC);

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
        <a class="navGridItem" href="index.php">Home</a>
        <a class="navGridItem" href="">Specialitijten</a>
        <a class="navGridItem" href="ingredienten.php">Ingredienten</a>
        <?php
        if (isset($_SESSION["userdata"]["id"])) {
            if ($_SESSION['userdata']['rol_naam'] == 'eigenaar' || $_SESSION['userdata']['rol_naam'] == 'manager') {
                echo '<a class="navGridItem" href="beheergebruikers.php">Beheer</a>';
            }
            echo "<a class='navGridItem' href='logout.php'>Uitloggen</a>";
        } else {
            echo "<a class='navGridItem' href='login.php'>Inloggen</a>";
            echo "<a class='navGridItem' href='registreren.php'>Registreren</a>";
        }
        ?>

        <span class="navReceptenCount">
            <span class="receptenCountTextItem">recepten: </span>
            <span class="receptenCountTextItem"><?php echo $recepten['count']; ?></span>

        </span>
    </nav>
</body>

</html>