<?php

namespace app\Core;

use Exception;
use League\Plates\Engine;

abstract class  TemplateView
{
    public function view(string $view, array $data, string $title = '')
    {
        $pathFile = '../app/Views/' . $view . '.php';
        if (!file_exists($pathFile)) {
            throw new Exception("A view {$view} não existe");
        }

        $templates = new Engine('../app/Views');
        echo $templates->render($view, [$data, 'title' => $title]);
    }
}
