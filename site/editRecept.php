<?php
require 'database.php';
$stmt = $conn->prepare("SELECT * FROM recept where id = :id");
$stmt->bindParam(':id', $_GET['receptId']);
$stmt->execute();

$recept = $stmt->fetch(PDO::FETCH_ASSOC);


if (isset($recept['maker']) && isset($_SESSION['userdata']['id'])) {

    if ($recept['maker'] != $_SESSION['userdata']['id']) {
        echo "Dit is niet jouw recept, je mag alleen jou ijgen recepten wijzigen";
        die();
    }
}

if(isset($_POST['submit'])){
    $stmt = $conn->prepare("UPDATE recept SET titel = :titel, instructies = :instructies, 
    duur_in_minuten = :duur_in_min, menugang = :menugang, 
    moeilijkheid = :moeilijkheid WHERE id = :id");
    $stmt->bindParam(":id", $_GET['receptId']);
    $stmt->bindParam(":titel", $_POST['titel']);
    $stmt->bindParam(":instructies", $_POST['instructies']);
    $stmt->bindParam(":duur_in_min", $_POST['duur']);
    $stmt->bindParam(":menugang", $_POST['menugang']);
    $stmt->bindParam(":moeilijkheid", $_POST['moeilijkheid']);
    $stmt->execute();
    header("Location: recept.php?id=" . $_GET['receptId']);
    die();
}




/*instructies
duur
aantal ingredienten
menugang
moeilijkheid


*/
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
    <form action="" method="post" class="formFlex">
        <div>
            <label for="receptNaam">Titel</label>
            <input type="text" name="titel" id="titel" value="<?php echo $recept['titel']; ?>">
        </div>
        <div>
            <label for="instructies">instructies</label>
            <input type="text" name="instructies" id="instructies" value="<?php echo $recept['instructies']; ?>">
        </div>
        <div>
            <label for="duur">duur in minuten</label>
            <input type="text" name="duur" id="duur" value="<?php echo $recept['duur_in_minuten']; ?>">
        </div>
        <div>
            <label for="menugang">menugang</label>
            <input type="text" name="menugang" id="menugang" value="<?php echo $recept['menugang']; ?>">
        </div>
        <div>
            <label for="moeilijkheid">moeilijkheid</label>
            <select name="moeilijkheid" id="moeilijkheid">
                <option value="<?php echo $recept['moeilijkheid']; ?>" hidden><?php echo $recept['moeilijkheid']; ?></option>
                <option value="makkelijk">makkelijk</option>
                <option value="gemideld">gemidled</option>
                <option value="moeilijk">moeilijk</option>
            </select>
        </div>

        <div><input type="submit" value="submit" name="submit"></div>
    </form>
</body>

</html>