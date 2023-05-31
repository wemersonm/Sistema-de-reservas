<?php $this->layout('master', ['title' => $title]) ?>
<?php // print_r($data); 
?>

<div class="container d-flex justify-content-center mt-5">
    <?php foreach ($data['reservationsCar'] as $index => $reservationDetails) : ?>
        <div class="row border border-danger border-opacity-50 rounded">
            <div class="col-12 col-md-6">
                <img src="assets/images/cars/<?php echo $reservationDetails['imageCar']; ?>" class="img-fluid" alt="Car" style="max-height:300px;border:2px solid lime">
            </div>
            <div class="col-12 col-md-6">
                <p class="d-inline-block text-dark fst-italic">N° reserva: <?php echo $reservationDetails['idReserve'];  ?></p>
                <h3 class="text-danger"><?php echo $reservationDetails['modelCar']; ?></h3>
                <div class="text-body-secondary"><?php echo $reservationDetails['descriptionCar']; ?></div>
                <div class="info-reservation fw-bold">
                    <p href="" class="fs-5 text-danger ">R$ <?php echo $reservationDetails['amountReservation']; ?></p>
                    <label class="form-label text-primary">Data da retirada</label>
                    <p class="card-text mb-auto"><?php echo $reservationDetails['PickupDate']; ?></p>
                    <label class="form-label text-primary">Data da devolução</label>
                    <p class="card-text mb-auto"><?php echo $reservationDetails['ReturnDate']; ?></p>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>