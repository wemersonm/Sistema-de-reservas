<?php $this->layout('master', ['title' => $title]) ?>
<h3>Adicionar Carro</h3>

<form action="/cars/insert" method="POST" class="form-control">

    <label  class="form-label color-primary">VNI</label>
    <input type="text" name="vni" class="form-control">
    <?php echo getFlashMessage("vni","color:red;display:block;font-size:14px");?>

    <label  class="form-label color-primary">Marca do carro</label>
    <input type="text" name="carMake" class="form-control">
    <?php echo getFlashMessage("carMake","color:red;display:block;font-size:14px");?>

    <label  class="form-label color-primary">Nome do carro</label>
    <input type="text" name="carModel" class="form-control">
    <?php echo getFlashMessage("carModel","color:red;display:block;font-size:14px");?>

    <label  class="form-label color-primary">Ano do carro</label>
    <input type="text" name="carModelYear" class="form-control">
   
    <?php echo getFlashMessage("carModelYear","color:red;display:block;font-size:14px");?>

    <button type="submit" class="btn btn-info mt-1">Cadastrar</button>
    <?php echo getCsfr(); ?>
</form>