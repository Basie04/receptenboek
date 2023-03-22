<?php
require "database.php";

$stmt = $conn->prepare("SELECT * FROM recept");
$stmt->execute();

$all_recepten = $stmt->fetchAll(PDO::FETCH_ASSOC)

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/style.css">
    <title>Document</title>
</head>

<body>
    <?php foreach ($all_recepten as $recept) { ?>
        <div class="gridContainer">
            <div class="receptBack"></div>
            <div class="receptTitle">
                <?php echo $recept['titel']; ?>
            </div>
            <div class="receptAfbeeldingDiv">
                <img class="receptAfbeelding" src="./images/goulash.jpg" alt="afbeelding">

            </div>
        </div>
    <?php } ?>
    <div style="height: 1000px;"></div>
</body>

</html>