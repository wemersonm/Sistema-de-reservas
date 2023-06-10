<?php $this->layout('admin::master', ['title' => $title]) ?>


<div class="container container-login">
    <?php if (isset($_SESSION['flash']['errorLogin'])) : ?>
        <div class="alert alert-danger" role="alert" >
            <?php echo getFlashMessage('errorLogin'); ?>
        </div>
    <?php endif; ?>
    <div class="row justify-content-center">
        <div class="col-lg-6 col-md-8 col-sm-10">
            <form method="POST" action="/admin/login" class="form-control">
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
                <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" name="exampleCheck1" id="exampleCheck1">
                    <label class="form-check-label" for="exampleCheck1">Manter conectado</label>
                </div>
                <button type="submit" class="btn btn-outline-danger w-100">Entrar</button>
                <?php echo getCsfr(); ?>
            </form>
            <!-- <p class="text-center mt-4 text-secondary">or</p>
            <a href="/register" class="text-center d-block text-secondary">Register</a> -->
        </div>
    </div>
</div>