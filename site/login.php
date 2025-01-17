<?php

require "database.php";
require "glob_check_func.php";

try_session_start();

if (check_form_filled_out()) {
    $stmt = $conn->prepare('SELECT * FROM gebruiker JOIN rollen ON rollen.rol_id = gebruiker.rol WHERE email = :email AND password = :pass');
    $stmt->bindParam(':email', $_POST['email']);
    $stmt->bindParam(':pass', $_POST['pass']);
    $stmt->execute();

    $found_user = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!empty($found_user)) {
        $_SESSION['userdata'] = $found_user;
        header('Location: index.php');
        die();
    } else {
        echo "Nothing found";
    }
} else {

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
        <div class="formFlex">
            <form action="" method="post">
                <div>
                    <label for="email">email</label>
                    <input type="text" name="email" id="email" required>
                </div>
                <div>
                    <label for="pass">wachtwoord</label>
                    <input type="password" name="pass" id="pass" required>
                </div>
                <div>
                    <input type="submit" value="submit" name="submit">
                </div>
            </form>
        </div>



    </body>

<?php } ?>

    </html>