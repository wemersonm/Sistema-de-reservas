<?php

namespace app\Support;

class FileValidate
{
    public static function moveFile(string $tmpName, string $fileName, string $folder = '')
    {
        $folderDestination = '../public/assets/images/cars/';
        if (!empty($folder)) {
            $folderDestination = '../public/assets/images/carManufaturer/';
        }
        $fullPath = $folderDestination . $fileName;
        if (move_uploaded_file($tmpName, $fullPath)) {
            return true;
        }
        return false;
    }
}
