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
