<?php $this->layout('admin::master', ['title' => $title])  ?>



<div class="container py-5 ">
    <div class="row">
        <?php if (isset($_SESSION['flash']['successCreate'])) : ?>
            <div class="alert alert-success" role="alert">
                <?php echo getFlashMessage('successCreate'); ?>
            </div>
        <?php endif; ?>
        <div class="col-12 col-md-6 d-flex flex-column">
            <form action="/admin/car/manufaturer/insert" method="POST" enctype="multipart/form-data" id="form-car">
                <div class="mb-3 fw-bold">
                    <label for="fileInput" class="form-label fw-bold text-info">Imagem da marca</label>
                    <input type="file" name="fileCar" class="form-control" id="fileCar" aria-describedby="errorValidationFileManufaturer" onchange="showImg();">
                    <div id="errorValidationFileImg" class="form-text text-danger"><?php echo getFlashMessage('fileCar'); ?></div>
                </div>
                <div class="show-image-car">
                    <img class="img-fluid" src="" alt="imagemCar" style="display:none;"></img>
                </div>
        </div>
        <div class="col-12 col-md-6 " style="background-color:#f5f8fc">
            <div class="text-primary fw-bold">

                <div class="mb-3">
                    <label id="nameManufature" class="form-label">Nome</label>
                    <input type="text" class="form-control" id="nameManufature" name="nameManufature" aria-describedby="errorValidationNameManufature">
                    <div id="errorValidationNameManufature" class="form-text text-danger"><?php echo getFlashMessage('nameManufature'); ?></div>

                </div>
                <div class="mb-3">
                    <label id="descriptionManufature" class="form-label">Descrição da marca</label>
                    <input type="text" class="form-control" id="descriptionManufature" name="descriptionManufature" aria-describedby="errorValidationDescriptionManufature">
                    <div id="errorValidationDescriptionManufature" class="form-text text-danger"><?php echo getFlashMessage('descriptionManufature'); ?></div>

                </div>

                <?php echo getCsfr(); ?>
                <button class="btn btn-danger w-100">Adicionar</button>
                </form>
            </div>


        </div>
    </div>

</div>