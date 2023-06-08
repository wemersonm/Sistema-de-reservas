<?php $this->layout('master', ['title' => $title]) ?>

<div class="container py-5">
    <?php if (count($data['reservationsCar']) > 0) : ?>
        <?php foreach ($data['reservationsCar'] as $index => $reservationDetails) : ?>
            <div class="row border border-danger border-opacity-50 rounded mb-3 p-1">
                <div class="col-12 col-md-6">
                    <img src="assets/images/cars/<?php echo $reservationDetails['imageCar']; ?>" class="img-fluid" alt="Car">
                </div>
                <div class="col-12 col-md-6 p-1">
                    <div class="d-flex justify-content-between ">
                        <p class=" text-dark fst-italic">N° reserva: <?php echo $reservationDetails['idReserve'];  ?></p>
                        <?php if ($reservationDetails['paymentStatus'] == null) : ?>
                            <p class="fw-bold">Status <span class="badge text-bg-success p-2">Pagamento Pendente</span></p>
                        <?php else : ?>
                            <p class="fw-bold">Status <span class="badge text-bg-success p-2"><?php echo $reservationDetails['paymentStatus'];  ?></span></p>
                        <?php endif; ?>
                    </div>
                    <h3 class="text-danger"><?php echo $reservationDetails['modelCar']; ?></h3>
                    <div class="text-body-secondary"><?php echo $reservationDetails['descriptionCar']; ?></div>
                    <div class="info-reservation fw-bold">
                        <p class="fs-5 text-danger ">R$ <?php echo $reservationDetails['amountReservation']; ?></p>

                        <table class="table text-center">
                            <tr>
                                <th><span class="badge bg-primary rounded text-white">Data de retirada</span></th>
                                <th><span class="badge bg-primary rounded text-white">Hora de retirada</span></td>
                            </tr>
                            <tr>
                                <td><?php echo $reservationDetails['pickupDate'] ?></td>
                                <td><?php echo $reservationDetails['pickupHour'] ?></td>
                            </tr>
                        </table>
                        <table class="table text-center">
                            <tr>
                                <th><span class="badge bg-primary rounded text-white">Data de devolução</span></th>
                                <th><span class="badge bg-primary rounded text-white">Hora de devolução</span></td>
                            </tr>
                            <tr>
                                <td class="fw-bold"><?php echo $reservationDetails['returnDate'] ?></td>
                                <td class="fw-bold"><?php echo $reservationDetails['returnHour'] ?></td>
                            </tr>
                        </table>
                    </div>
                    <?php if (isset($reservationDetails['sandbox'])) : ?>
                        <div class="reserve-info">
                            <a href="<?php echo $reservationDetails['sandbox']; ?>" class="btn btn-danger w-100 mb-1 fw-bold">Pagar agora</a>
                            <a href="/reservation/cancel/<?php echo $reservationDetails['idReserve'];?>" class="btn btn-warning w-100 fw-bold">Cancelar</a>
                        </div>
                    <?php endif; ?>

                </div>
            </div>
        <?php endforeach; ?>
    <?php else : ?>
        <div class="container py-5">
            <div class="text-center">
                <h1>Não existem reservas</h1>
                <p>Realizar reserva agora mesmo</p>
                <a href="/cars" class="btn btn-primary">Reservar carros</a>
            </div>
        </div>
    <?php endif; ?>
</div>