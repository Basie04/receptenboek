<?php
require 'database.php';
require 'navbar.php';

//toevoegen test of result een bool is

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

    <div class="backgroundGradientDiv"></div>
    <div class="page-contents">
        <div class="receptTitelDiv">
            <h1><?php echo $recept['titel']; ?></h1>
            <span><?php echo "Berijdingstijd: " . $recept['duur_in_minuten'] . " minuten"; ?></span>
            <span><?php echo "Moeilijkheid: " . $recept['moeilijkheid']; ?></span>
            <?php if (isset($recept['maker']) && isset($_SESSION['userdata']['id'])) {
                
                if ($recept['maker'] == $_SESSION['userdata']['id']) {
                    echo "<span><a href='editRecept.php?receptId=" . $recept['id'] . "'>edit recept</a></span>";
                }
            } ?>

        </div>

        <div class="receptAfbeelding">
            <img src="<?php echo $recept['foto_path']; ?>" alt="<?php echo $recept['titel']; ?>">
        </div>

        <div class="recept_aantal_ingredienten">
            <h2>ingredienten</h2>
            <span><?php echo ": " . $recept['aantal_ingredienten']; ?></span>
        </div>
        <p class="ingredientenList">
            <?php foreach ($ingredienten as $ingredient) { ?>

                <span><?php echo $ingredient['ingredientNaam'] . " " . $ingredient['hoeveelheid']; ?></span>

            <?php } ?>
            <span class="receptInstructies"><?php echo $recept['instructies']; ?></span>
        </p>
    </div>
</body>

</html>