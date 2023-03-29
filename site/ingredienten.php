<?php
require "database.php";
require "navbar.php";

$stmt = $conn->prepare("SELECT * from ingredient");
$stmt->execute();
$ingredienten = $stmt->fetchAll(PDO::FETCH_ASSOC);

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

    <table>
        <thead>
            <th>id</th>
            <th>naam</th>
        </thead>
        <tbody>
            <?php foreach ($ingredienten as $ingredient) { ?>
                <tr>
                    <td><?php echo $ingredient['id']; ?></td>
                    <td><?php echo $ingredient['naam']; ?></td>
                    <td><a href="<?php echo "editingredient.php?id=". $ingredient['id']; ?>">edit</a></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</body>

</html>