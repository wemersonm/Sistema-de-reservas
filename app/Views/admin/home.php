<?php



$this->layout('admin::master', ['title' => $title]) ?>

<div class="container py-5">
    <div class="row">
        <div class="col-sm-6 col-md-6 col-lg-4">
            <div class="card text-bg-light mb-3" style="width:100%;height:200px">
                <h4 class="card-header">Frota de carros</h4>
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title" style="height:60px;">Acessar seção da frota de carros</h5>
                    <a href="/admin/cars" class="btn btn-primary">Acessar</a>
                    <p class="card-text mt-auto"><small class="text-body-secondary ">Gerente +</small></p>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-md-4 col-lg-4">
            <div class="card text-bg-light mb-3" style="width:100%;height:200px">
                <h4 class="card-header">Reservas de carros</h4>
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title" style="height:60px;">Acessar seção de reservas de carros</h5>
                    <a href="/admin/reserves" class="btn btn-danger">Acessar</a>
                    <p class="card-text mt-auto"><small class="text-body-secondary ">Funcionario +</small></p>

                </div>
            </div>
        </div>
        <div class="col-sm-6 col-md-4 col-lg-4">
            <div class="card text-bg-light mb-3" style="width:100%;height:200px">
                <h4 class="card-header">Gestão de funcionarios</h4>
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title" style="height:60px;">Acessar gestão de funcionarios</h5>
                    <a href="/admin/empolyees" class="btn btn-success">Acessar</a>
                    <p class="card-text mt-auto"><small class="text-body-secondary ">Admin +</small></p>
                </div>
            </div>
        </div>
    </div>
</div>