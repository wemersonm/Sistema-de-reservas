<?php $this->layout('admin::master', ['title' => $title]) ?>


<div class="container py-5">
    <?php if (isset($_SESSION['flash']['successUpdate'])) : ?>
        <div class="alert alert-success" role="alert">
            <?php echo getFlashMessage('successUpdate'); ?>
        </div>
    <?php elseif (isset($_SESSION['flash']['errorUpdate'])) : ?>
        <div class="alert alert-danger" role="alert">
            <?php echo getFlashMessage('errorUpdate'); ?>
        </div>
    <?php endif; ?>
    <h1 class="text-danger text-center">Gestão de reservas</h1>

    <?php foreach ($data['cars_reserved'] as $index => $reserve) : ?>

        <div class="mb-3">
            <label for="">Reserva</label>
            <h6 class="d-inline"> <?php echo $reserve['idReserve']; ?></h6>
        </div>
        <div class="mb-3">
            <label for="">Veiculo</label>
            <h5><?php echo $reserve['modelCar']; ?></h5>
        </div>
        <div class="mb-3">
            <label for="">Cliente</label>
            <h5><?php echo $reserve['nameUser']; ?></h5>
        </div>
        <div class="mb-3">
            <label for="">Data de coleta</label>
            <h5> <?php echo date("d/m/Y \á\s H:i", strtotime($reserve['pickupDate'] . '' . $reserve['pickupHour'])); ?></h5>
        </div>
        <div class="mb-3">
            <label for="">Data de devolução</label>
            <h5> <?php echo date("d/m/Y \á\s H:i", strtotime($reserve['returnDate'] . '' . $reserve['returnHour'])); ?></h5>
        </div>
        <div class="mb-3">
            <label for="">Status Pagamento</label>
            <h5><?php echo $reserve['paymentStatus']; ?></h5>
        </div>
        <div class="mb-3">
            <label for="">Total da reserva</label>
            <h5>R$ <?php echo $reserve['amountReservation']; ?></h5>
        </div>
        <div class="mb-3">
            <label for="">Status Reserva</label>
            <h5><?php echo $reserve['reservationStatus']; ?></h5>
        </div>
        <?php if ($reserve['reservationStatus'] != '0') { ?>
            <div class="mb-3">
                <label for="">Status Coleta</label>
                <?php if ($reserve['collected'] == '1') { ?>
                    <h5 class="text-secondaty">Coletado</h5>
                    <a href="/admin/reserve/cancelCollect/<?php echo $reserve['idReserve']; ?>" class="btn btn-dark">Cancelar coleta</a>
                <?php } else { ?>
                    <h5 class="">Aguardando coleta</h5>

                    <a href="/admin/reserve/confirmCollect/<?php echo $reserve['idReserve']; ?>" class="btn btn-secondary">Confirmar Coleta</a>
                <?php } ?>
            </div>
            <div class="mb-3">
                <label for="">Status Devolução</label>
                <?php if ($reserve['returned'] == '-1') { ?>
                    <h5>Devolução pendente</h5>
                    <a href="/admin/reserve/confirmReturn/<?php echo $reserve['idReserve']; ?>" class="btn btn-secondary">Confirmar Devolução</a>
                <?php } else { ?>
                    <h5 class="text-secondaty">Devolvido</h5>
                    <a href="/admin/reserve/cancelReturned/<?php echo $reserve['idReserve']; ?>" class="btn btn-dark">Cancelar devolução</a>
                <?php } ?>
            </div>
        <?php } ?>
        <?php if ($reserve['paymentStatus'] == 'approved') { ?>
            <div class="text-center">
                <a href="/admin/reserve/cancelReserve/<?php echo $reserve['idReserve']; ?>" class="btn btn-danger w-50">Cancelar Reserva</a>
            </div>

        <?php } ?>

    <?php endforeach; ?>


</div>