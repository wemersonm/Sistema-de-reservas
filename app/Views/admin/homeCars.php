<?php $this->layout('admin::master', ['title' => $title]) ?>

<div class="container py-5">
    <?php if (isset($_SESSION['flash']['successDelete'])) : ?>
        <div class="alert alert-success" role="alert">
            <?php echo getFlashMessage('successDelete'); ?>
        </div>
    <?php elseif (isset($_SESSION['flash']['errorDelete'])) : ?>
        <div class="alert alert-danger" role="alert">
            <?php echo getFlashMessage('errorDelete'); ?>
        </div>
    <?php endif; ?>
    <h1 class="text-danger text-center">Gestão de carros</h1>
    <a href="/admin/car/create" class="btn btn-success">Adicionar veiculo</a>
    <a href="/admin/car/manufaturer/create" class="btn btn-secondary">Adicionar marca</a>
   
    <table class="table text-center">
        <tr>
            <th>Imagem</th>
            <th>VNI</th>
            <th>Nome</th>
            <th>Ano</th>
            <th>Ações</th>
        </tr>
        <?php foreach ($data['cars'] as $index => $car) : ?>
            <tr>
                <td>
                    <img src="/assets/images/cars/<?php echo $car['imageCar']; ?>" class="img-fluid rounded" alt="imgCar" style="height:50px">
                </td>
                <td><?php echo $car['nviCar']; ?></td>
                <td><?php echo $car['modelCar']; ?></td>
                <td><?php echo $car['yearCar']; ?></td>

                <td>
                    <a href="/admin/car/edit/<?php echo $car['idCar']; ?>" class="btn btn-warning">Editar</a>
                    <a href="/admin/car/delete/<?php echo $car['idCar']; ?>" class="btn btn-danger">Deletar</a>

                </td>
            </tr>
        <?php endforeach; ?>
    </table>

</div>