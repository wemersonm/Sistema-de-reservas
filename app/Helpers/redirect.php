<?php

function redirect($to)
{
    return header("Location:" . $to);
}

function redirectBack()
{
    $uri = $_SERVER['REQUEST_URI'];
    if (!isset($_SESSION['redirectBack'])) {
        $_SESSION['redirectBack'] = [
            'actual' => $uri,
            'previus' => ''
        ];
    } else {
        $_SESSION[REDIRECT_BACK]['previus'] = $_SESSION[REDIRECT_BACK]['actual'];
        $_SESSION[REDIRECT_BACK]['actual'] = $uri;
    }
}

