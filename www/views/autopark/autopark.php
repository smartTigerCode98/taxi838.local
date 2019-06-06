
<link href = "../../webroot/css/autopark/autopark.css" rel = "stylesheet" type = "text/css"/>

<link rel="stylesheet" href="../../webroot/css/user/client/history.css" media="screen" type="text/css" />

<link rel="stylesheet" href="../../webroot/css/user/client/responsive-tables.css" media="screen" type="text/css" />


<h1 id="titleAutopark">Автопарк</h1>




<div class="container">
    <div class="row">
        <div class="coll-offset-lg-1 coll-lg-10 coll-offset-md-0 coll-md-12 coll-offset-cus-1 coll-cus-10" >
            <div id="wrapper">
            <?php foreach ($data['bodyTypes'] as $bodyType):?>
                <div class="aloneBodyType">
                    <a class="link" href="/cars/<?= $bodyType->saidTypeEnglish()?>/1"><?=$bodyType->title?></a>
                </div>
            <?php endforeach;?>
            </div>
        </div>
    </div>
</div>

<?php if($data['showTypeAutoGallery']!=0):?>
<div class="container" id="carsGallery">
    <div class="row">
            <?php foreach ($data['currentBodyTypes'] as $bodyType):?>
                <div class="coll-lg-6 coll-offset-sm-1 coll-sm-10 coll-offset-exs-0 coll-exs-12">
                    <div class="">
                    <img class="carExample" src="../../webroot/img/autopark/icon_auto_type/<?= $bodyType->image?>">
                    <div class="aboutTypeCar">
                        <p class="titleBodyType"><?= $bodyType->title?></p>
                        <div class="blockText"><p class="descriptionBodyType"><?= $bodyType->description?></p></div>
                    </div>
                    </div>
                </div>
            <?php endforeach;?>
    </div>
</div>
<?php endif;?>

<?php if(isset($data['showCars']) && $data['showCars'] == 1 && $data['showTypeAutoGallery'] == 0):?>
<div class="container" id="tableCars">
    <div class="row">
        <div class="coll-lg-12">
            <table class="responsive">
                <tr>
                    <th>Держ. номер</th>
                    <th>Марка</th>
                    <th>Модель</th>
                    <th>Колір</th>
                    <th>К-сть дверей</th>
                    <th>К-сть місць</th>
                    <th>Виробник</th>
                    <th>Рік випуску</th>
                </tr>
                <?php foreach ($data['cars'] as $car): ?>
                    <tr>
                        <td><?=$car->state_auto_number?></td>
                        <td><?=$car->mark?></td>
                        <td><?=$car->model?></td>
                        <td><?=$car->colour?></td>
                        <td><?=$car->number_of_doors?></td>
                        <td><?=$car->number_of_seats?></td>
                        <td><?=$car->manufacturer?></td>
                        <td><?=$car->year_of_issue?></td>
                    </tr>
                <?php endforeach;?>
            </table>

        </div>
    </div>
</div>
<?php endif;?>


<div class="pstrnav">
    <?=$data['pagination']?>
</div>

<script src="../../webroot/js/user/client/jquery.min.js"></script>
<script src="../../webroot/js/user/client/responsive-tables.js"></script>







