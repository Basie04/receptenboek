<?php
require "glob_check_func.php";
try_session_start();

if(session_exists() && gebruiker_ingelocht()){
    session_destroy();
}

header('Location: index.php');
