<?php $this->layout('admin::master', ['title' => $title])  ?>



<div class="container py-5 ">
    <div class="row">
        <?php if (isset($_SESSION['flash']['successUpdate']) && !empty($_SESSION['flash']['successUpdate'])) : ?>
            <div class="alert alert-success" role="alert">
                <?php echo getFlashMessage('successUpdate'); ?>
            </div>
        <?php endif; ?>
        <div class="col-12 col-md-6 d-flex">
            <form action="/admin/car/edit/<?php echo $data['car']['idCar']; ?>" method="POST" enctype="multipart/form-data">
                <div>
                    <img class="img-fluid" src="/assets/images/cars/<?php echo $data['car']['imageCar']; ?>" alt="Descrição da imagem">
                    <label for="fileInput" class="form-label fw-bold text-info">Mudar imagem</label>
                    <input type="file" name="fileCar" class="form-control" id="fileInput" aria-describedby="errorValidationFileCar">
                    <div id="errorValidationFileImg" class="form-text text-danger"><?php echo getFlashMessage('fileCar'); ?></div>

                </div>
        </div>
        <div class="col-12 col-md-6 " style="background-color:#f5f8fc">
            <div class="infoCar text-primary fw-bold">

                <div class="mb-3">
                    <label id="nviCar" class="form-label">Identificação do carro</label>
                    <input class="form-control" id="nviCar" name="nviCar" value="<?php echo $data['car']['nviCar']; ?>" aria-describedby="errorValidationNviCar">
                    <div id="errorValidationNviCar" class="form-text text-danger"><?php echo getFlashMessage('nviCar'); ?></div>

                </div>
                <div class="mb-3">
                    <label id="licensePlateCar" class="form-label">Placa do carro</label>
                    <input class="form-control" id="licensePlateCar" name="licensePlateCar" value="<?php echo $data['car']['licensePlateCar']; ?>" aria-describedby="errorValidationLicensePlateCar">
                    <div id="errorValidationLicensePlateCar" class="form-text text-danger"><?php echo getFlashMessage('licensePlateCar'); ?></div>

                </div>
                <div class="mb-3">
                    <label id="modelCar" class="form-label">Modelo do carro</label>
                    <input class="form-control" id="modelCar" name="modelCar" value="<?php echo $data['car']['modelCar']; ?>" aria-describedby="errorValidationModelCar">
                    <div id="errorValidationModelCar" class="form-text text-danger"><?php echo getFlashMessage('modelCar'); ?></div>

                </div>
                <div class="mb-3">
                    <label id="yearCar" class="form-label">Ano</label>
                    <input class="form-control" id="yearCar" name="yearCar" value="<?php echo $data['car']['yearCar']; ?>" aria-describedby="errorValidationYearCar">
                    <div id="errorValidationYearCar" class="form-text text-danger"><?php echo getFlashMessage('yearCar'); ?></div>


                </div>
                <div class="mb-3">
                    <label id="descriptionCar" class="form-label">Descrição do carro</label>
                    <textarea class="form-control" name="descriptionCar" rows="4" aria-describedby="errorValidationDescriptionCar"><?php echo $data['car']['descriptionCar']; ?> </textarea>
                    <div id="errorValidationDescriptionCar" class="form-text text-danger"><?php echo getFlashMessage('descriptionCar'); ?></div>

                </div>
                <div class="mb-3">
                    <label id="capacityCar" class="form-label">Capacidade de passageiros</label>
                    <input class="form-control" id="capacityCar" name="capacityCar" value="<?php echo $data['car']['capacityCar']; ?>" aria-describedby="errorValidationCapacityCar">
                    <div id="errorValidationCapacityCar" class="form-text text-danger"><?php echo getFlashMessage('capacityCar'); ?></div>

                </div>
                <div class="mb-3 ">
                    <label id="pricePerDayCar" class="form-label">Preço por dia</label>
                    <div class="input-group">
                        <span class="input-group-text">R$</span>
                        <input class="form-control" id="pricePerDayCar" name="pricePerDayCar" value="<?php echo $data['car']['pricePerDayCar']; ?>" aria-describedby="errorValidationCapacityCar" aria-describedby="errorValidationPricePerDayCar">
                        <div id="errorValidationPricePerDayCar" class="form-text text-danger"><?php echo getFlashMessage('pricePerDayCar'); ?></div>

                    </div>
                </div>
                <div class="mb-3">
                    <label id="idManufature" class="form-label">Fabricante</label>
                    <select name="idManufature" id="idManufature" class="form-select" aria-describedby="errorValidationManifature">
                        <?php foreach ($data['carManufaturer'] as $manufaturer) : ?>
                            <option value="<?php echo $manufaturer['idManufature']; ?>" <?php echo ($data['car']['idManufature'] == $manufaturer["idManufature"]) ? 'selected' : ''; ?>>
                                <?php echo $manufaturer['nameManufature']; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <div id="errorValidationManifature" class="form-text text-danger"><?php echo getFlashMessage('idManufature'); ?></div>

                </div>
                <div class="mb-3">
                    <label id="typeCar" class="form-label">Tipo</label>
                    <select name="typeCar" id="typeCar" class="form-select" aria-describedby="errorValidationTypeCar">
                        <?php foreach ($data['typeCar'] as $typeCar) : ?>
                            <option value="<?php echo $typeCar['idTypeCar']; ?>" <?php echo ($data['car']['typeCar'] == $typeCar["idTypeCar"]) ? 'selected' : ''; ?>>
                                <?php echo $typeCar['nameTypeCar']; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <div id="errorValidationTypeCar" class="form-text text-danger"><?php echo getFlashMessage('typeCar'); ?></div>

                </div>
                <div class="mb-3">
                    <label id="transmissionCar" class="form-label">Transmissão</label>
                    <select name="transmissionCar" id="transmissionCar" class="form-select" aria-describedby="errorValidationTransmissionCar">
                        <?php
                        foreach ($data['carTransmission'] as $transmissionCar) : ?>
                            <option value="<?php echo $transmissionCar['idTransmissionCar']; ?>" <?php echo ($data['car']['transmissionCar'] == $transmissionCar["idTransmissionCar"]) ? 'selected' : ''; ?>>
                                <?php echo $transmissionCar['nameTransmissionCar']; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <div id="errorValidationTransmissionCar" class="form-text text-danger"><?php echo getFlashMessage('transmissionCar'); ?></div>

                </div>
                <div class="mb-3">
                    <label id="typeFuelCar" class="form-label">Combustível</label>
                    <select name="typeFuelCar" id="typeFuelCar" class="form-select" aria-describedby="errorValidationFuelCar">
                        <?php
                        foreach ($data['carFuel'] as $carFuel) : ?>
                            <option value="<?php echo $carFuel['idFuelCar']; ?>" <?php echo ($data['car']['typeFuelCar'] == $carFuel["idFuelCar"]) ? 'selected' : ''; ?>>
                                <?php echo $carFuel['nameFuelCar']; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <div id="errorValidationFuelCar" class="form-text text-danger"><?php echo getFlashMessage('typeFuelCar'); ?></div>

                </div>
                <div class="mb-3">
                    <label id="offer" class="form-label">Em oferta</label>
                    <select name="offer" id="offer" class="form-select" aria-describedby="errorValidationFuelCar">
                        <option value="0" <?php echo ($data['car']['offer'] == '0') ? 'selected' : ''; ?>>Não</option>
                        <option value="1" <?php echo ($data['car']['offer'] == '1') ? 'selected' : ''; ?>>Sim</option>
                    </select>
                    <div id="errorValidationFuelCar" class="form-text text-danger"><?php echo getFlashMessage('offer'); ?></div>

                </div>
                <?php echo getCsfr(); ?>
                <button class="btn btn-danger w-100">Atualizar</button>
                </form>
            </div>


        </div>
    </div>


</div>