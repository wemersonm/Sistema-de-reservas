<?php

namespace app\Controllers;

use app\Core\TemplateView;
use app\Database\Filters;
use app\Database\Models\User;
use app\Support\FlashMessages;
use app\Support\Validate;

class LoginController extends TemplateView
{

    public function index()
    {
        return $this->view('login', [], 'Página de login');
    }
    public function enter()
    {

        $validate = new Validate;
        $validations = $validate->validations([
            'emailUser' => 'required|email',
            'passwordUser' => 'required'
        ]);

        if (!$validations) {
            return redirect('/login');
        }
        $user = new User;
        $dataUser = $user->findBy('emailUser', $validations['emailUser']);
        if (!password_verify($validations['passwordUser'], $dataUser['passwordUser'])) {
            FlashMessages::setFlashMessage('errorLogin', "Usuario ou senha incorretos");
            return  redirect('/login');
        }

        $_SESSION[LOGGED] = $dataUser;
        return redirect('/');
    }

    public function logout(){
        if(isset($_SESSION[LOGGED]) && !empty(isset($_SESSION[LOGGED]))){
            unset($_SESSION[LOGGED]);
            return redirect('/');
        }
    }
}
