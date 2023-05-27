<?php

namespace app\Support;

class FlashMessages
{
    public static function setFlashMessage(string $field, string $message)
    {
        $_SESSION['flash'][$field] = $message;
    }

    public static function getFlashMessage(string $field)
    {
        if (isset($_SESSION['flash'][$field])) {
            $flash = $_SESSION['flash'][$field];
            unset($_SESSION['flash'][$field]);
            return $flash;
        }
    }
}
