<?php $this->layout('master', ['title' => $title]) ?>
<div id="carouselExample" class="carousel slide">
    <div class="carousel-inner">
        <div class="carousel-item active">
            <a href="/cars"> <img src="../assets/images/banner/banner1.jpg" class="d-block w-100 img-fluid" alt="banner"></a>
        </div>
        <div class="carousel-item">
            <a href="/cars"><img src="../assets/images/banner/banner2.jpg" class="d-block w-100 img-fluid" alt="banner"></a>
        </div>
        <div class="carousel-item">
            <a href="/cars"> <img src="../assets/images/banner/banner3.jpg" class="d-block w-100 img-fluid" alt="banner"></a>
        </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>

<div class="container-fluid ">
    <p class="display-6 mt-5 text-center">Razões para alugar na CarReservExpress</p>
    <p class="fs-5 text-center">Confira os nossos diferenciais</p>
    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-2 row-cols-lg-3 row-cols-xl-4 d-flex justify-content-center">

        <div class="col text-center card-spacing">
            <div class="card h-100 w-100" style="border:none;">
                <img src="../assets/images/cards/card1.jpg" class="card-img-top" alt="car">
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title">Proteção Abrangente de Seguros</h5>
                    <p class="card-text">Dirija com tranquilidade, sabendo que nossa proteção abrangente de seguros cobre danos, roubo e acidentes. Sua segurança é nossa prioridade.</p>
                    <a href="#" class="btn btn-danger mt-auto">Saiba mais</a>
                </div>
            </div>
        </div>
        <div class="col text-center card-spacing">
            <div class="card h-100 w-100" style="border:none;">
                <img src="../assets/images/cards/card1.jpg" class="card-img-top" alt="car">
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title">Opções de Retirada e Devolução Flexíveis</h5>
                    <p class="card-text">Escolha o horário mais convenientes para retirar e devolver seu carro. Oferecemos opções flexíveis para se adaptar à sua agenda e garantir uma experiência livre de estresse.</p>
                    <a href="#" class="btn btn-danger mt-auto">Saiba mais</a>
                </div>
            </div>
        </div>
        <div class="col text-center card-spacing">
            <div class="card h-100 w-100" style="border:none;">
                <img src="../assets/images/cards/card1.jpg" class="card-img-top" alt="car">
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title">Opções de Pagamento Flexíveis</h5>
                    <p class="card-text">Escolha a forma de pagamento que melhor se adequa a você. Aceitamos cartões de crédito, débito e oferecemos opções de pagamento em parcelas para facilitar sua reserva de carro.</p>
                    <a href="#" class="btn btn-danger mt-auto">Saiba mais</a>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="container mb-4" id="offers">
    <p class="display-6 mt-5 text-center">Ofertas</p>
    <p class="fs-5 text-center">Confira nossas ofertas de carros</p>
    <div class="row row-cols-1 row-cols-sm-1 row-cols-md-2 row-cols-lg-3">
        <?php foreach ($data as $index => $car) : ?>
            <div class="col">
                <div class="card h-100 w-100" style="width: 18rem;">
                    <div class="card-img">
                        <img src="/assets/images/cars/<?php echo $car['imageCar']; ?>" class="card-img-top" alt="carPromo" style="height:250px">
                    </div>
                    <div class="card-body">
                        <span class="badge text-bg-info  mt-1">Oferta</span>
                        <h5 class="card-title">
                            <?php echo $car['modelCar']; ?>
                        </h5>
                        <p class="card-text">
                            <?php echo $car['descriptionCar']; ?>
                        </p>
                        <h4 class="card-title text-success">
                            R$ <?php echo $car['pricePerDayCar']; ?>
                        </h4>
                        <a href="/cars/<?php echo $car['slugCar']; ?>" class=" btn btn-danger">Alugar</a>
                    </div>

                </div>
            </div>
        <?php endforeach; ?>

    </div>
</div>