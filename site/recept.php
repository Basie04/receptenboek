<?php
require 'database.php';

$stmt = $conn->prepare("SELECT * FROM recept where id = :id");
$stmt->bindParam(':id', $_GET['id']);
$stmt->execute();

$recept = $stmt->fetch(PDO::FETCH_ASSOC);




$stmt = $conn->prepare("SELECT * , ingredient.naam AS ingredientNaam FROM recept_ingredienten JOIN ingredient ON ingredient.id = ingredient_id WHERE recept_id = :id");
$stmt->bindParam(':id', $_GET['id']);
$stmt->execute();

$ingredienten = $stmt->fetchAll(PDO::FETCH_ASSOC);


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recept</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <h1><?php echo $recept['titel']; ?></h1>

    <div><?php echo $recept['foto_path']; ?></div> <!-- hier komt een image-->

    <h3>ingredienten</h3>
    <p class="ingredientenList">
        <?php foreach ($ingredienten as $ingredient) { ?>

            <span><?php echo $ingredient['ingredientNaam'] ." ".$ingredient['hoeveelheid']; ?></span>

        <?php } ?>
    </p>
</body>

</html>