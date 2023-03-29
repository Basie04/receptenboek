<?php
require "database.php";

$stmt = $conn->prepare("SELECT * FROM ingredient WHERE id = :id");
$stmt->bindParam(':id', $_GET['id']);
$stmt->execute();
$ingredient = $stmt->fetch(PDO::FETCH_ASSOC);

if(isset($_POST['submit']) && isset($_POST['naam'])){
    $stmt = $conn->prepare("UPDATE ingredient SET naam = :naam WHERE id = :id");
    $stmt->bindParam(':id', $ingredient['id']);
    $stmt->bindParam(':naam', $_POST['naam']);
    $stmt->execute();
    header('Location: ingredienten.php');
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

    <form action="" method="post">
        <label for="name">naam</label>
        <input type="text" name="naam" id="naam" value="<?php echo $ingredient['naam'] ?>">
        <input type="submit" value="submit" name="submit">
    </form>
</body>

</html>