<?php $this->layout('master', ['title' => $title]) ?>


<div class="container mt-5">
    <div class="row" style="height: 500px;">
        <div class="col-12 col-md-6 d-flex align-items-center ">
            <div>
                <img class="img-fluid" src="/assets/images/cars/<?php echo $data['imageCar']; ?>" alt="Descrição da imagem">

            </div>
        </div>
        <div class="col-12 col-md-6 " style="background-color:#f5f8fc">
            <div class="infoCar">
                <p class="fs-4 text-danger fw-bold"><?php echo $data['modelCar']; ?> </p>
                <p class="fs-5"><?php echo $data['descriptionCar']; ?> </p>
            </div>
            <div class="infoReservation">
                <form action="/car/reserve" method="POST" class="form-control d-flex flex-column align-items-center text-center">
                    <div class="pickupReservation">
                        <label id="pickupDate" class="form-label fs-5">Data retirada</label>
                        <input class="form-control" type="date" name="pickupDate" id="pickupDate" value="2023-06-01">
                        <?php echo getFlashMessage("pickupDate", 'color:red') ?>
                        <select class="form-select " name="pickupHour" id="pickupHour">
                            <option value="">Horario</option>
                            <?php
                            $startHour = strtotime("08:00");
                            $endHour = strtotime("20:00");

                            for ($hour = $startHour; $hour <= $endHour; $hour = strtotime("+30 minutes", $hour)) {
                                $date = date("H:i", $hour);
                                echo "<option value='{$date}'>{$date}</option>";
                            }
                            ?>
                            <option value="20:00" selected>20:00</option>
                        </select>
                        <?php echo getFlashMessage("pickupHour", 'color:red') ?>
                    </div>
                    <div class="returnReservation">
                        <label id="returnDate" class="form-label fs-5">Data devolução</label>
                        <input class="form-control " type="date" name="returnDate" id="returnDate" value="2023-06-02">
                        <?php echo getFlashMessage("returnDate", 'color:red') ?>
                        <select class="form-select " name="returnHour" id="returnHour">
                            <option value="">Horario</option>
                            <?php
                            $startHour = strtotime("08:00");
                            $endHour = strtotime("20:00");

                            for ($hour = $startHour; $hour <= $endHour; $hour = strtotime("+30 minutes", $hour)) {
                                $date = date("H:i", $hour);
                                echo "<option value='{$date}'>{$date}</option>";
                            }
                            ?>
                            <option value="19:00" selected>19:00</option>
                        </select>
                        <?php echo getFlashMessage("returnHour", 'color:red') ?>
                    </div>
                    <?php echo getFlashMessage("dateReserve", 'color:red') ?>
                    <button class="btn btn-danger ms-auto">Continuar</button>
                    <?php echo getCsfr(); ?>
                </form>

            </div>
        </div>
    </div>


</div>