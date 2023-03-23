<?php
require "database.php";
require "navbar.php";

$stmt = $conn->prepare("SELECT * FROM recept");
$stmt->execute();

$all_recepten = $stmt->fetchAll(PDO::FETCH_ASSOC);

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
    <div class="page-contents">
        <table border="2"> <!-- table niet toegestaan later veranderen naar fex of grid met afbeelding -->
            <thead>
                <th>recept naam</th>
                <th>afbeelding</th>
            </thead>

            <?php foreach ($all_recepten as $recept) { ?>
                <tr>
                    <td><a href="<?php echo "recept.php?id=" . $recept['id'] ?>"><?php echo $recept['titel'] ?></a></td>
                    <td><?php echo $recept['foto_path'] ?></td>
                </tr>


            <?php } ?>
        </table>
    </div>
</body>

</html>