<?php

namespace app\Controllers\admin;

use app\Core\TemplateView;
use app\Database\Filters;
use app\Database\Models\ModelGeneric;
use app\Support\AccessLevel;
use app\Support\Csfr;
use app\Support\FlashMessages;
use app\Support\Validate;

class EmpolyeeController extends TemplateView
{
    public function __construct()
    {
       
        if (!AccessLevel::only("*")) {
            return redirect("/admin");
            die;
        }
    }
    public function index()
    {

        $admins = new ModelGeneric("users_admin");
        $filters = new Filters;
        $filters->where('idUser', '!=', '1');
        $admins->setFilters($filters);
        $data['empolyees'] = $admins->fetchAll();
        return $this->view('admin/homeEmpolyee',  $data, 'Reservas');
    }
    public function edit(mixed $idEmpolyee)
    {
        $idEmpolyee = $idEmpolyee[0];
        if (!is_numeric($idEmpolyee)) {
            return redirect("/admin/error");
            die;
        }

        $admins = new ModelGeneric("users_admin");
        $filters = new Filters;
        $filters->where("idUser", '=', $idEmpolyee);
        $admins->setFilters($filters);
        $data['empolyee'] = $admins->fetchAll()[0];
        $data['accessLevel'] = ["manager", "empolyee"];

        return $this->view('admin/editEmpolyee',  $data, 'Reservas');
    }

    public function create()
    {
        $data['accessLevel'] = ["manager", "empolyee"];
        return $this->view('admin/createEmpolyee',  $data, 'Reservas');
    }

    public function insert()
    {
        
        $admins = new ModelGeneric("users_admin");
        $validate = new Validate;
        $validations = $validate->validations([
            'nameUser' => 'required',
            'emailUser' => 'required|email:users_admin|unique:users_admin',
            'accessLevel' => 'required',
            'passwordUser' => 'required|minLen:8|password',
        ]);

        if (!$validations) {
            return redirect($_SESSION[REDIRECT_BACK]['previus']);
            die;
        }
        
        if (!$admins->create($validations)) {
            FlashMessages::setFlashMessage('errorCreate', "Erro ao criar o funcionario");
            return  redirect($_SESSION[REDIRECT_BACK]['previus']);
            die;
        }

        FlashMessages::setFlashMessage('successCreate', "Funcionario criado com sucesso");
        return  redirect("/admin/empolyees");
        die;
    }
    public function update(mixed $idEmpolyee)
    {

        Csfr::validateCsfr();
        $idEmpolyee = $idEmpolyee[0];
        if (!is_numeric($idEmpolyee)) {
            return redirect("/admin/error");
            die;
        }

        $validate = new Validate;
        $validations = $validate->validations([
            'nameUser' => 'required',
            'emailUser' => 'required|email|unique',
            'accessLevel' => 'required'
        ]);

        if (!$validations) {
            return redirect($_SESSION[REDIRECT_BACK]['previus']);
            die;
        }
        $admins = new ModelGeneric('users_admin');
        if (!$admins->update('idUser', $idEmpolyee, $validations)) {
            FlashMessages::setFlashMessage('errorUpdate', "Erro ao editar o funcionario");
            return  redirect($_SESSION[REDIRECT_BACK]['previus']);
            die;
        }

        FlashMessages::setFlashMessage('successUpdate', "Funcionario editado com sucesso");
        return  redirect($_SESSION[REDIRECT_BACK]['previus']);
        die;
    }


    public function delete(mixed $idEmpolyee)
    {
        $idEmpolyee = $idEmpolyee[0];
        if (!is_numeric($idEmpolyee)) {
            return redirect("/admin/error");
            die;
        }
        $admins = new ModelGeneric("users_admin");

        $filters = new Filters;
        $filters->where("idUser", '=', $idEmpolyee);
        $admins->setFilters($filters);
        if (!$admins->delete()) {
            FlashMessages::setFlashMessage('errorUpdate', "Erro ao deletar o funcionario");
            return  redirect($_SESSION[REDIRECT_BACK]['previus']);
            die;
        }

        FlashMessages::setFlashMessage('successUpdate', "Funcionario deletado com sucesso");
        return  redirect($_SESSION[REDIRECT_BACK]['previus']);
        die;
    }
}
