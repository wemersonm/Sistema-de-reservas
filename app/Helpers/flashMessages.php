<?php

use app\Support\FlashMessages;

function getFlashMessage(string $field, string $css =''){
   $flash = FlashMessages::getFlashMessage($field);
   return "<p style='{$css}'>{$flash}</p>";
}