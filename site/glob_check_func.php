<?php
function check_form_filled_out()
{
    if (
        isset($_POST['submit']) && isset($_POST['email']) &&
        isset($_POST['pass']) && is_string($_POST['email']) &&
        is_string($_POST['pass'])
    ) {
        return true;
    } else {
        return false;
    }
}

function userdata_not_empty()
{
    if (
        isset($_SESSION['userdata']) && isset($_SESSION['userdata']['id']) &&
        !empty($_SESSION['userdata']['id'])
    ) {
        return true;
    } else {
        return false;
    }
}

function user_is_admin()
{
    if (isset($_SESSION['userdata'])) {

        if (
            isset($_SESSION['userdata']['id']) &&
            !empty($_SESSION['userdata']['id']) &&
            $_SESSION['userdata']['rol'] == 'eigenaar' ||
            $_SESSION['userdata']['rol'] == 'manager'
        ) {
            return true;
        } else {
            return false;
        }
    }
}

function restrictAccessToAdmin()
{
    if (!user_is_admin()) {
        echo "<div class='backgroundGradientDiv'></div>";
        echo 'Helaas, dit account is niet geregistreert als administator. Log in met een ander account om verder te kunnen';
        require "navbar.php";
        die();
    }
}



function session_exists()
{
    if (isset($_SESSION)) {
        return true;
    } else {
        return false;
    }
}

function try_session_start()
{
    if (!isset($_SESSION)) {
        session_start();
    }
}

function gebruiker_ingelocht()
{
    if (isset($_SESSION["userdata"]["id"])) {
        return true;
    } else {
        return false;
    }
}
