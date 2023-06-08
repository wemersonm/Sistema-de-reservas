<?php

namespace app\Controllers;

use app\Core\TemplateView;
use app\Database\Models\ModelGeneric;
use app\Support\FlashMessages;
use app\Support\Validate;

class RegistrationController extends TemplateView
{
    public function index()
    {

        $this->view("register", [], "Realizar Cadastro");
    }
    public function create()
    {

        $validate = new Validate;
        $validations  = $validate->validations([
            'nameUser' => 'required',
            'cpfUser' => 'required|cpf',
            'emailUser' => 'required|email|unique',
            'passwordUser' => 'required|minLen:8|password',
            'phoneUser' => 'required'
        ]);

        if (!$validations) {
            return redirect($_SESSION[REDIRECT_BACK]['previus']);
            die;
        }

        $users = new ModelGeneric("users");
        $userCreated = $users->create($validations);
        if (!$userCreated) {
            FlashMessages::setFlashMessage('errorRegister', "Erro ao cadastrar");
            return  redirect('/register');
            die;
        }

        return  redirect('/login');
        die;
    }
}
