<?php $this->layout('admin::master', ['title' => $title])  ?>



<div class="container py-5 ">
    <div class="row">
        <?php if (isset($_SESSION['flash']['successUpdate']) && !empty($_SESSION['flash']['successUpdate']) ) : ?>
            <div class="alert alert-success" role="alert">
                <?php echo getFlashMessage('successUpdate'); ?>
            </div>
        <?php endif; ?>
        <div class="col-12" style="background-color:#f5f8fc">
            <div class="infoCar text-primary fw-bold">
                <form action="/admin/empolyee/edit/<?php echo $data['empolyee']['idUser']; ?>" method="POST">
                    <div class="mb-3">
                        <label id="nameUser" class="form-label">Nome</label>
                        <input class="form-control" id="nameUser" name="nameUser" value="<?php echo $data['empolyee']['nameUser']; ?>" aria-describedby="errorValidationNameUser">
                        <div id="errorValidationNameUser" class="form-text text-danger"><?php echo getFlashMessage('nameUser'); ?></div>
                    </div>
                    <div class="mb-3">
                        <label id="emailUser" class="form-label">Email</label>
                        <input class="form-control" id="emailUser" name="emailUser" value="<?php echo $data['empolyee']['emailUser']; ?>" aria-describedby="errorValidationEmailUser">
                        <div id="errorValidationEmailUser" class="form-text text-danger"><?php echo getFlashMessage('emailUser'); ?></div>

                    </div>

                    <div class="mb-3">
                        <label id="accessLevel" class="form-label">Cargo</label>
                        <select name="accessLevel" id="accessLevel" class="form-select" aria-describedby="errorValidationAccessLevel">
                            <option value="">Selecione</option>
                            <?php foreach ($data['accessLevel'] as $index => $access) : ?>
                                <option value="<?php echo $access; ?>" <?php echo ($data['empolyee']['accessLevel'] == $access) ? 'selected' : ''; ?>>
                                    <?php print_r($access); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <div id="errorValidationAccessLevel" class="form-text text-danger"><?php echo getFlashMessage('accessLevel'); ?></div>
                    </div>


                    <?php echo getCsfr(); ?>
                    <button class="btn btn-danger w-100">Atualizar</button>
                </form>
            </div>


        </div>
    </div>


</div>