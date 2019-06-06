

<!--<link href = "../../webroot/css/main/test.css" rel = "stylesheet" type = "text/css"/>-->
<link rel="stylesheet" href="../../webroot/css/main/modal.css">
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link href = "../../webroot/css/main/wickedpicker.css" rel = "stylesheet" type = "text/css"/>
<link rel="stylesheet" href="../../webroot/css/user/client/order.css" media="screen" type="text/css" />




<div class="coll-lg-6 coll-md-12" id="map"></div>
<div class="coll-lg-6 coll-md-12" id="formOrder">
    <form method="post" class="formOrder">
        <div id="wrapper">

            <div class="field" id="firstField">
                <select  id="selectId" class="selectAuto">
                    <?php foreach ($data['bodyTypes'] as $bodyType):?>
                        <option value="<?=$bodyType->title?>"><?=$bodyType->title?></option>
                    <?php endforeach;?>
                </select>
            </div>
            <input type="hidden" name="automobile">

            <div class="field distance">
                <select name="services" id="selectId2" class="select_service">
                    <?php foreach ($data['services'] as $service):?>
                        <option value="<?=$service->id?>"><?=$service->title?></option>
                    <?php endforeach;?>
                </select>
            </div>

            <div class="field distance">
                <input type="text" name="where_" id="where_" class="styleInput" placeholder="Куди" value="<?=$data['where']?>">
            </div>
            <div class="field distance">
                <input type="text" name="whence" id="whence" class="styleInput" placeholder="Звідки" value="<?=$data['whence']?>">
            </div>
            <div class="field distance">
                <input style="text-align: center" type="text" id="datepicker1" class="styleInput" name="when_" placeholder="Коли" value="<?=$data['when']?>">
            </div>
            <div class="field distance">
                <input  type="text"  class="styleInput timepicker" name="time"  placeholder="О котрій">
            </div>

            <div class="field distance">
                <input type="text" name="comment" class="styleInput" placeholder="Коментар" value="<?=$data['comment']?>">
            </div>
            <div class="field distance">
                <input type="text" name="distance" id="distance" placeholder="Відстань у км" class="styleInput" readonly>
            </div>

        <input type="hidden" name="but" id="flag" value="Построить маршрут" onclick="codeAddress()">

        </div>
        <div id="submit">
            <button id="forward" type="submit" name="toOrder" value="ok">Замовити</button>
        </div>
    </form>
</div>




<input type="hidden" id="n1">
<!-- modal -->
<div class="modal-overlay">
    <div class="modal">

        <a class="close-modal">
            <svg viewBox="0 0 20 20">
                <path fill="#000000" d="M15.898,4.045c-0.271-0.272-0.713-0.272-0.986,0l-4.71,4.711L5.493,4.045c-0.272-0.272-0.714-0.272-0.986,0s-0.272,0.714,0,0.986l4.709,4.711l-4.71,4.711c-0.272,0.271-0.272,0.713,0,0.986c0.136,0.136,0.314,0.203,0.492,0.203c0.179,0,0.357-0.067,0.493-0.203l4.711-4.711l4.71,4.711c0.137,0.136,0.314,0.203,0.494,0.203c0.178,0,0.355-0.067,0.492-0.203c0.273-0.273,0.273-0.715,0-0.986l-4.711-4.711l4.711-4.711C16.172,4.759,16.172,4.317,15.898,4.045z"></path>
            </svg>
        </a><!-- close modal -->

        <div class="modal-content">
            <?php if(isset($data['descriptor']) && $data['descriptor']==0):?>
                <h3 class="titleModal">Шановний клієнте!</h3>
                <p class="msgModal">Вартість Вашого замовлення складає <?php echo $data['price'];?> грн</p>
                <p class="msgModal">Натисніть OK, щоб підтвердити замовлення, або закрийте це повідомлення, щоб відхилити замовлення.</p>
                <form action="" method="post" id="answer">
                    <input type="hidden" name="answer" value="success">
                    <button  type="submit" id="help" name="answer" value="success">Ok</button>
                </form>
            <?php elseif ($data['descriptor'] == 1):?>
                <h4 class="titleModal"> Ваше замовлення успішно зареєстровано!</h4>
                <p class="msgModal">Дякуємо за те, що користуєтесь службою таксі TAXI 838.</p>
                <p class="msgModal">Щасливої поїздки.</p>
            <?php elseif ($data['descriptor'] == 2):?>
                <h4 class="titleModal">Помилка!</h4>
                <p class="msgModal"><?php echo $data['error'];?></p>
            <?php endif;?>
        </div><!-- content -->

    </div><!-- modal -->
</div><!-- overlay -->










<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.0/jquery.min.js"></script>
<script src='http://maps.googleapis.com//maps/api/js?key=AIzaSyBsu1mdA89pNTv3y0QfA8GfZt9g51rIjBY&callback=initMap'></script>
<script src="../../webroot/js/user/client/index.js"></script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="../../webroot/js/main/select.js"></script>
<script src="../../webroot/js/main/choice_service.js"></script>
<script src="../../webroot/js/user/client/choice_auto_account.js"></script>
<script src="../../webroot/js/main/datepicker.js"></script>


<script src=" https://code.jquery.com/jquery-1.12.4.js"></script>
<script src=" https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>


<script type="text/javascript" src="//cdn.jsdelivr.net/momentjs/latest/moment-with-locales.min.js"></script>
<script type="text/javascript" src="../../webroot/js/main/wickedpicker.js"></script>

<script src="../../webroot/js/main/modal.js"></script>

<!--<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.0/jquery.min.js"></script>-->
<!--<script src='http://maps.googleapis.com//maps/api/js?key=AIzaSyBsu1mdA89pNTv3y0QfA8GfZt9g51rIjBY&callback=initMap'></script>-->
<!--<script src="../../webroot/js/user/client/index.js"></script>-->



<?php
if(isset($data['resultAddOrder'])){
    echo "<script>
    $(document).ready(function(){
        document.getElementById('n1').click();

    });

</script>";
}
if(isset($data['error'])){
    echo "<script>
    $(document).ready(function(){
        document.getElementById('n1').click();

    });

</script>";
}
if(isset($data['price'])) {
    echo "<script>
    $(document).ready(function(){
        document.getElementById('n1').click();

    });

</script>";
}
?>