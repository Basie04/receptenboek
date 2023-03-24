<?php

require "database.php";
require "glob_check_func.php";
session_start();

if (userdata_not_empty()) {
    //laat iets zien
}


$stmt = $conn->prepare("SELECT * FROM recept");
$stmt->execute();

$all_recepten = $stmt->fetchAll(PDO::FETCH_ASSOC);

require "navbar.php";
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>beschikbare recepten</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <div class="backgroundGradientDiv"></div>

    <div class="page-contents inline-block center-recepten-grid">
        <div class="recepten-grid-container">
            <?php foreach ($all_recepten as $recept) { ?>

                <div class="recepten-grid-text"><a href="<?php echo "recept.php?id=" . $recept['id']; ?>"><?php echo $recept['titel']; ?></a></div>
                <div class="recepten-grid-picture"><img src="<?php echo $recept['foto_path'] ?>" alt="<?php echo $recept['foto_path'] ?>"></div>

            <?php } ?>


        </div>
    </div>

</body>

</html>