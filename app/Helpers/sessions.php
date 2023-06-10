<?php

function isLogged()
{
    return (isset($_SESSION[LOGGED]) && !empty(isset($_SESSION[LOGGED]))) ?
        true :
        false;
}

function isAdmLogged()
{
    return (isset($_SESSION[ADM_LOGGED]) && !empty(isset($_SESSION[ADM_LOGGED]))) ?
        true :
        false;
}

function dataUserLogged(){
    return (isset($_SESSION[LOGGED]) && !empty(isset($_SESSION[LOGGED]))) ?
    $_SESSION[LOGGED] :
    [];
}