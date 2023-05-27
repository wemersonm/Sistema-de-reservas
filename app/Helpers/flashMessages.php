<?php

use app\Support\FlashMessages;

function getFlashMessage(string $field, string $css =''){
   $flash = FlashMessages::getFlashMessage($field);
   return "<span style='{$css}'>{$flash}</span>";
}