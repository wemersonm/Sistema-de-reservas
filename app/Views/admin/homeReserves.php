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
    <h1 class="text-danger text-center">Gestão de reservas</h1>
    <form action="" method="GET" class="form-control">
        <div class="mb-3">
            <label for="dateReserve" class="form-label fw-bold ">Pesquisar por data</label>
            <input type="date" class="form-control" name="dateReserve" id="dateReserve">
        </div>
        <div class="mb-3">
            <label for="idReserve" class="form-label fw-bold ">Pesquisar reserva</label>
            <input type="text" class="form-control" name="idReserve" id="idReserve">
        </div>
        <button class="btn btn-danger w-100">Pesquisar</button>
    </form>

    <table class="table text-center mt-4">
        <tr>
            <th>ID</th>
            <th>Veiculo</th>
            <th>Cliente</th>
            <th>Retirada</th>
            <th>Devolução</th>
            <th>Status Pagamento</th>
            <th>Preço</th>
            <th>Status Reserva</th>

            <th>Ações</th>
        </tr>
        <?php foreach ($data['cars_reserved'] as $index => $reserve) : ?>
            <tr>

                <td><?php echo $reserve['idReserve']; ?></td>
                <td><?php echo $reserve['modelCar']; ?></td>
                <td><?php echo $reserve['nameUser']; ?></td>
                <td><?php echo $reserve['pickupDate'] . ' / '. $reserve['pickupHour']; ?></td>
                <td><?php echo $reserve['returnDate'] .' / '. $reserve['returnHour']; ?></td>
                <td><?php echo $reserve['paymentStatus']; ?></td>
                <td><?php echo $reserve['amountReservation']; ?></td>
                <td><?php echo $reserve['reservationStatus']; ?></td>

                <td>
                    <a href="/admin/reserve/<?php echo $reserve['idReserve']; ?>" class="btn btn-success">Ver</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>

</div>