<?php $this->layout('master', ['title' => $title]) ?>

<div class="container-fluid">

    <div class="row">
        <div class="col-2">
            <div class="filters">
                <h4>Filtros</h4>
                <hr>
                <form action="/cars/search">
                    <h5>Marca</h5>
                    <h5>Ano de Fabricação</h5>
                    <div class="form-group">
                        <label for="inputFim">Ano XXXX</label>
                        <input type="text" class="form-control" id="inputFim" placeholder="Digite o valor final">
                    </div>
                    <h5>Tipo</h5>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                        <label class="form-check-label" for="flexCheckDefault">
                            SUV
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked">
                        <label class="form-check-label" for="flexCheckChecked">
                            SEDAN
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                        <label class="form-check-label" for="flexCheckDefault">
                            VAN
                        </label>
                    </div>
                    <hr>
                    <h5>Combustivel</h5>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                        <label class="form-check-label" for="flexCheckDefault">
                            GASOLINA
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked">
                        <label class="form-check-label" for="flexCheckChecked">
                            ETANOL
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                        <label class="form-check-label" for="flexCheckDefault">
                            DISEL
                        </label>
                    </div>
                    <hr>
                    <h5>Preço</h5>
                    <div class="form-group">
                        <label for="inputInicio">Início:</label>
                        <input type="text" class="form-control" id="inputInicio" placeholder="Digite o valor inicial">
                    </div>
                    <div class="form-group">
                        <label for="inputFim">Fim:</label>
                        <input type="text" class="form-control" id="inputFim" placeholder="Digite o valor final">
                    </div>
                    <button class="btn btn-primary mt-3">Aplicar Filtros</button>
                </form>
            </div>
        </div>

        <div class="col-10">
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3 d-flex align-items-stretch">
                <div class="col">
                    <div class="card h-100" style="height:540px;">
                        <img src="https://autoshow.com.br/wp-content/uploads/2021/02/golf-1024x576.jpg?x84485" class="card-img-top" alt="car" width="100%" height="225">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">Card title</h5>
                            <p class="card-text flex-grow-1">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                            <div class="card-info mt-auto">
                                <p class="fs-4 ">R$ 122,99</p>
                                <a href="#" class="btn btn-danger w-100 ">Alugar</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col">
                    <div class="card h-100" style="height:540px;">
                        <img src="https://autoshow.com.br/wp-content/uploads/2021/02/golf-1024x576.jpg?x84485" class="card-img-top" alt="car" width="100%" height="225">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">Card title</h5>
                            <p class="card-text flex-grow-1">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longerThis is a wider card with supporting tex order-1t below as a natural lead-in to additional content. This content is a little bit longer.</p>
                            <div class="card-info mt-auto">
                                <p class="fs-4 ">R$ 122,99</p>
                                <a href="#" class="btn btn-danger w-100 ">Alugar</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>