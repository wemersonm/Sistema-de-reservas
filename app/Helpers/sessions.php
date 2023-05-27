<?php

function isLogged()
{
    return (isset($_SESSION[LOGGED]) && !empty(isset($_SESSION[LOGGED]))) ?
        true :
        false;
}
