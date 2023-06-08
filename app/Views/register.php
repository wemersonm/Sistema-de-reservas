<?php $this->layout('master', ['title' => $title]) ?>
<div class="container container-login ">
    <?php if (isset($_SESSION['flash']['errorRegister'])) : ?>
        <div class="alert alert-danger" role="alert">
            <?php echo getFlashMessage('errorRegister'); ?>
        </div>
    <?php endif; ?>
    <div class="row justify-content-center">
        <div class="col-lg-6 col-md-8 col-sm-10">
            <form method="POST" action="/userRegister" class="form-control">
                <div class="mb-3">
                    <label class="form-label">Nome</label>
                    <input type="text" name="nameUser" class="form-control" aria-describedby="errorValidationName">
                    <div id="errorValidationName" class="form-text text-danger"><?php echo getFlashMessage('nameUser'); ?></div>
                </div>
                <div class="mb-3">
                    <label class="form-label">CPF</label>
                    <input type="text" name="cpfUser" class="form-control" aria-describedby="errorValidationCpf">
                    <div id="errorValidationCpf" class="form-text text-danger"><?php echo getFlashMessage('cpfUser'); ?></div>
                </div>
                <div class="mb-3">
                    <label class="form-label">Email address</label>
                    <input type="email" name="emailUser" class="form-control" aria-describedby="errorValidationEmail">
                    <div id="errorValidationEmail" class="form-text text-danger"><?php echo getFlashMessage('emailUser'); ?></div>
                </div>
                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input type="password" name="passwordUser" class="form-control" aria-describedby="errorValidationPass">
                    <div id="errorValidationPass" class="form-text text-danger"><?php echo getFlashMessage('passwordUser'); ?></div>
                </div>
                <div class="mb-3">
                    <label class="form-label">Telefone</label>
                    <input type="text" name="phoneUser" class="form-control" aria-describedby="errorValidationPhone">
                    <div id="errorValidationPhone" class="form-text text-danger"><?php echo getFlashMessage('phoneUser'); ?></div>
                </div>
                <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" name="exampleCheck1" id="exampleCheck1">
                    <label class="form-check-label" for="exampleCheck1">Manter conectado</label>
                </div>
                <button type="submit" class="btn btn-outline-danger w-100">Entrar</button>
                <?php echo getCsfr(); ?>
            </form>
        </div>
    </div>
</div>