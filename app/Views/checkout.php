<?php $this->layout('master', ['title' => $title]);
extract($data); ?>
<?php


?>

<div class="container  mt-5">
    <p class="fs-3 text-center">Finalizar reserva</p>
    <div class="row d-flex justify-content-center">
        <div class="col-12 col-md-6">
            <img src="/assets/images/cars/<?php echo $dataCar['imageCar']; ?>" class="img-fluid" alt="Car" style="max-height:300px;border:2px solid lime">
        </div>
        <div class="col-12 col-md-6">
            <!-- <p class="d-inline-block text-dark fst-italic">N° reserva: <?php echo $dataOrder['idReserve'];  ?></p> -->
            <h3 class="text-danger"><?php echo $dataCar['modelCar']; ?></h3>
            <div class="text-body-secondary"><?php echo $dataCar['descriptionCar']; ?></div>
            <div class="info-reservation fw-bold mt-3 ">
                <p class="fs-3 text-success">R$ <?php echo $dataOrder['priceOrder']; ?></p>
                <table class="table text-center">
                    <tr>
                        <th><span class="badge bg-primary rounded text-white">Data de retirada</span></th>
                        <th><span class="badge bg-primary rounded text-white">Hora de retirada</span></td>
                    </tr>
                    <tr>
                        <td><?php echo $dataOrder['pickupDate'] ?></td>
                        <td><?php echo $dataOrder['pickupHour'] ?></td>
                    </tr>
                </table>
                <table class="table text-center">
                    <tr>
                        <th><span class="badge bg-primary rounded text-white">Data de devolução</span></th>
                        <th><span class="badge bg-primary rounded text-white">Hora de devolução</span></td>
                    </tr>
                    <tr>
                        <td class="fw-bold"><?php echo $dataOrder['returnDate'] ?></td>
                        <td class="fw-bold" ><?php echo $dataOrder['returnHour'] ?></td>
                    </tr>
                </table>
                <a href="/checkout/pay" class="btn btn-danger w-100">Pagar</a>
            </div>
        </div>
    </div>

</div>