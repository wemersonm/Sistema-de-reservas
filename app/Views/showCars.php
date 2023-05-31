    <?php $this->layout('master', ['title' => $title]) ?>

    <div class="container-fluid mt-5">

        <div class="row">
            <div class="col-2">
                <div class="filters">
                    <h3>Filtros</h3>
                    <form action="" method="GET">
                        <div class="manufaturerCar">
                            <h5>Marca</h5>
                            <?php foreach ($data['carManufaturer'] as $index => $carManufaturer) : ?>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="carManufature" value="<?php echo $carManufaturer['nameManufature']; ?>">
                                    <label class="form-check-label">
                                        <?php echo $carManufaturer['nameManufature']; ?>
                                    </label>
                                </div>
                            <?php endforeach; ?>
                        </div>

                        <div class="typeCar">
                            <h5>Tipo</h5>
                            <?php foreach ($data['typeCar'] as $index => $typeCar) : ?>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="typeCar" value="<?php echo $typeCar['nameTypeCar'] ?>">
                                    <label class="form-check-label">
                                        <?php echo $typeCar['nameTypeCar']; ?>
                                    </label>
                                </div>
                            <?php endforeach; ?>
                        </div>

                        <div class="fuelCar">
                            <h5>Combustivel</h5>
                            <?php foreach ($data['carFuel'] as $index => $carFuel) : ?>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="fuelCar" value="<?php echo $carFuel['nameFuelCar']; ?>">
                                    <label class="form-check-label">
                                        <?php echo $carFuel['nameFuelCar']; ?>
                                    </label>
                                </div>
                            <?php endforeach; ?>
                        </div>
                        <div class="priceCar">
                            <h5>Preço</h5>
                            <div class="form-group">
                                <label>De</label>
                                <input type="text" class="form-control w-50" name="initialPriceCar" placeholder="inicial">
                            </div>
                            <div class="form-group">
                                <label for="inputFim">Até</label>
                                <input type="text" class="form-control w-50" name="finalPriceCar" placeholder="final">
                            </div>
                        </div>
                        <button class="btn btn-primary mt-3">Aplicar Filtros</button>
                    </form>
                </div>
            </div>

            <div class="col-10">
                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3 d-flex align-items-stretch">
                    <?php foreach ($data['cars'] as $index => $car) : ?>

                        <div class="col">

                            <div class="card" style="height: 500px;">
                                <img src="/assets/images/cars/<?php echo $car['imageCar']; ?>" class="card-img-top" alt="car" width="100%" height="250px;" alt="Car">
                                <div class="card-body d-flex flex-column">
                                    <h5 class="card-title text-danger"><?php echo $car['modelCar']; ?></h5>
                                    <div class="card-text flex-grow-1" style="max-height: 100px; overflow: auto;">
                                        <p class="truncate"><?php echo $car['descriptionCar']; ?></p>
                                    </div>
                                    <div class="card-info mt-auto">
                                        <p class="fs-4">R$ <?php echo $car['pricePerDayCar']; ?></p>
                                        <a href="/cars/<?php echo $car['slugCar']; ?>" class="btn btn-danger w-100">Alugar</a>
                                    </div>
                                </div>
                            </div>


                        </div>

                    <?php endforeach; ?>
                </div>
            </div>

        </div>
    </div>