<?php

namespace app\Controllers\admin;

use app\Core\TemplateView;
use app\Database\Filters;
use app\Database\Models\ModelGeneric;
use app\Support\FlashMessages;
use app\Support\Validate;

class LoginController extends TemplateView
{
    public function index()
    {
        return $this->view('admin/login', [], 'Página de login');
    }

    public function enter()
    {

        $validate = new Validate;
        $validations = $validate->validations([
            'emailUser' => 'required|email',
            'passwordUser' => 'required'
        ]);

        
        if (!$validations) {
            return redirect('/admin/login');
            die;
        }
        
        $user = new ModelGeneric('users_admin');
        $filters = new Filters;
        $filters->where('emailUser','=', $validations['emailUser']);
        $user->setFilters($filters);
        $dataUser = $user->findBy();
        if (!password_verify($validations['passwordUser'], $dataUser['passwordUser'])) {
            FlashMessages::setFlashMessage('errorLogin', "Usuario ou senha incorretos");
            return  redirect('/admin/login');
        }

        $_SESSION[ADM_LOGGED] = $dataUser;
        return redirect('/admin');
    }

    public function logout(){
        if(isset($_SESSION[ADM_LOGGED]) && !empty(isset($_SESSION[ADM_LOGGED]))){
            unset($_SESSION[ADM_LOGGED]);
            return redirect('/admin/login');
        }
    }
}