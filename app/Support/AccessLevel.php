<?php

namespace app\Support;

class AccessLevel
{
    private static array $allAccess =  ['*', 'manager', 'empolyee'];

    public static function getAccessLevel()
    {
        $dataUser = $_SESSION[ADM_LOGGED];
        if (!empty($dataUser['accessLevel'])) {
            return $dataUser['accessLevel'];
        }
    }
    public static function excepts(string|array $excepts)
    { // all any less ?

        if (is_string($excepts)) {
            return (self::getAccessLevel() ===  $excepts) ? true : false;
        }
        foreach ($excepts as $key) {
            if (self::getAccessLevel() === $key) {
                return true;
            }
        }
        return false;
    }
    public static function only(string|array $excepts)
    { // somente ?

        if (is_string($excepts)) {
            return (self::getAccessLevel() !== $excepts) ? false : true;
        }
        foreach ($excepts as $key) {
            if (self::getAccessLevel() !== $key) {
                return false;
            }
        }
        return true;
    }
}
