

<link href = "../../webroot/css/main/test.css" rel = "stylesheet" type = "text/css"/>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link href = "../../webroot/css/main/date_choice.css" rel = "stylesheet" type = "text/css"/>
<link href = "../../webroot/css/main/wickedpicker.css" rel = "stylesheet" type = "text/css"/>
<link href = "../../webroot/css/main/main.css" rel = "stylesheet" type = "text/css"/>
<link href = "../../webroot/css/template/my_grid.css" rel = "stylesheet" type = "text/css"/>

<link rel="stylesheet" href="../../webroot/css/main/modal.css">



<script type="text/javascript" src="https://formden.com/static/cdn/formden.js"></script>




<h2 id="poslygi">Головна</h2>


<div id="podstavka" >
    <h3 id="zakaz">Замовте зручне таксі без запізнень одним кліком!</h3>
    <form action="" method="post" id="form">
        <div class="knopka101">
            <input  type="text" class="form-control" name = "number" placeholder = "Введіть Ваш номер" id="numb1">
        </div>
        <div class="knopka101 kn2">
            <button id="numb2" type="submit" onclick="">Замовити</button>
        </div>
    </form>
    <p id="operand" class="operator">Оператор передзвонить Вам через 30 секунд<br>та уточнить всі деталі замовлення</p>
</div>


<h4 id="turbota">Ми турбуємося про Ваш затишок</h4>
<div class="pol md">
    <div><img src="../../webroot/img/template/1.png" alt="WI-FI в таксі"></div>
    <div><img src="../../webroot/img/template/2.png" alt="Музика в таксі"></div>
    <div><img src="../../webroot/img/template/3.png" alt="Багажник в таксі"></div>
    <div><img src="../../webroot/img/template/4.png" alt="Місця для тварин в таксі"></div>
    <div><img src="../../webroot/img/template/5.png" alt="Допомога з багажем в таксі"></div>
    <div><img src="../../webroot/img/template/6.png" alt="Дитяче крісло в таксі"></div>
</div>
<div class="container md" id="contr">
    <div class="row">
        <div class="coll-lg-2 txt"><p>WI-FI в машині</p></div>
        <div class="coll-lg-2 txt" id="f2"><p>Музика на Ваш смак</p></div>
        <div class="coll-lg-2 txt" id="f3"><p>Вмісткий багажник</p></div>
        <div class="coll-lg-2 txt" id="f4"><p>Місце для тварин</p></div>
        <div class="coll-lg-2 txt" id="f5"><p>Погрузка та розгрузка</p><p id="f5_1">багажу</p> </div>
        <div class="coll-lg-2 txt" id="f6"><p>Дитяче крісло</p></div>
    </div>
</div>
<div class="container okay content">
    <div class="row m1">
        <div class="coll-md-4 coll-offset-sm-2 coll-sm-4 coll-exs-12">
            <img class="cicle mar_left" src="../../webroot/img/template/1.png" alt="WI-FI в таксі">
            <div class="texta txt_left"><p>WI-FI в машині</p></div>
        </div>
        <div class="coll-md-4 coll-sm-4 coll-exs-12">
            <img class="cicle" src="../../webroot/img/template/2.png" alt="Музика в таксі">
            <div class="texta"><p>Музика на Ваш смак</p></div>
        </div>
        <div class="clearfix t1"></div>
        <div class="coll-md-4 coll-offset-sm-2 coll-sm-4 coll-exs-12 im_tabl">
            <img class="cicle mar_right" src="../../webroot/img/template/3.png" alt="Багажник в таксі">
            <div class="texta txt_right"><p>Вмісткий багажник</p></div>
        </div>
        <div class="clearfix sm1"></div>
        <div class="coll-md-4 coll-sm-4 coll-exs-12 ryad2 im_tabl">
            <img class="cicle mar_left" src="../../webroot/img/template/4.png" alt="Місця для тварин в таксі">
            <div class="texta txt_left"><p>Місце для тварин</p></div>
        </div>
        <div class="coll-md-4 coll-offset-sm-2 coll-sm-4 coll-exs-12 ryad2 im_tabl">
            <img class="cicle" src="../../webroot/img/template/5.png" alt="Допомога з багажем в таксі">
            <div class="texta"><p>Погрузка та розгрузка<br>багажу</p></div>
        </div>
        <div class="coll-md-4 coll-sm-4 coll-exs-12 ryad2 im_tabl">
            <img class="cicle mar_right" src="../../webroot/img/template/6.png" alt="Дитяче крісло в таксі">
            <div class="texta txt_right"><p>Дитяче крісло</p></div>
        </div>
    </div>
</div>
<div class="two_block" id="pok">
    <div id="forma">
        <h5 id="kniga">Книга TAXI Online</h5>
        <div id="oblogka_knigi">
            <div id="coll-1-kniga">
                <p>Куди</p>
                <p id="ch1">Звідки</p>
                <p id="ch2">Коли</p>
                <p id="ch5">О котрій</p>
                <p id="ch3">Авто</p>
                <p class="ch6">Послуга</p>
                <p class="ch6">Коментар</p>
                <p id="ch4">Номер</p>
            </div>
            <div class="polya">
                <form action="" method="post">
                    <div class="knopka9 next">
                        <input type="text" title="" class="numb4 wh"  name = "whereFirst" value="<?php echo $data['where'];?>">
                    </div>
                    <div class="knopka9 next" id="field2">
                        <input type="text" title="" class="numb4 "  name = "whenceFirst" value="<?php echo $data['whence'];?>">
                    </div>
                    <div class="knopka9 next" id="pole2">
                        <input style="text-align: center" type="text" id="datepicker" readonly="readonly" class="numb4" name="when[0]" value="<?php echo $data['when']?>">
                    </div>

                    <div class="knopka9 next" id="pole2">
                        <input  type="text"  class="numb4 timepicker" name="time[0]">
                    </div>


                    <div class="knopka9 next" id="pole2">
                        <select  id="selectId" class="selectCar">
                           <?php foreach ($data['bodyTypes'] as $bodyType):?>
                               <option value="<?=$bodyType->title?>"><?=$bodyType->title?></option>
                            <?php endforeach;?>
                        </select>
                    </div>

                    <input type="hidden" name="automobileFirst">

                    <div class="knopka9 next" id="pole3">
                        <select name="services[0]" id="selectId2" class="select_service">
                            <?php foreach ($data['services'] as $service):?>
                            <option value="<?=$service->id?>"><?=$service->title?></option>
                            <?php endforeach;?>
                        </select>
                    </div>

                    <div class="knopka9 next" id="pole3">
                        <input class="numb4" type="text" placeholder="за бажанням" name="comment[0]" value="<?php echo $data['comment']?>">
                    </div>

                    <div class="knopka9 next" id="pole3">
                        <input type="text" title="" class="numb4  huy" name="mobile[0]" value="<?php echo $data['mobile']?>">
                    </div>

                    <div class="knopka9 next1">
                        <input type="text" name ="whereSecond" class="numb4 vvod" placeholder="Куди" value="<?php echo $data['where']?>">
                    </div>

                    <div class="knopka9 next1" id="field2">
                        <input type="text" name ="whenceSecond" class="numb4 vvod" placeholder="Звідки" value="<?php echo $data['whence']?>">
                    </div>

                    <div class="knopka9 next1" id="pole2">
                        <input style="text-align: center" type="text" id="datepicker1" class="numb4" name="when[1]" placeholder="Коли" value="<?php echo $data['when']?>">
                    </div>

                    <div class="knopka9 next1" id="pole2">
                        <input  type="text"  class="numb4 timepicker" name="time[1]"  placeholder="О котрій">
                    </div>

                    <div class="knopka9 next1" id="pole2">
                        <select  id="selectId" class="select">
                            <?php foreach ($data['bodyTypes'] as $bodyType):?>
                                <option value="<?=$bodyType->title?>"><?=$bodyType->title?></option>
                            <?php endforeach;?>
                        </select>
                    </div>
                    <input type="hidden" name="automobileSecond">
                    <div class="knopka9 next1" id="pole3">
                        <select name="services[1]" id="selectId2" class="select_service">
                            <?php foreach ($data['services'] as $service):?>
                                <option value="<?=$service->id?>"><?=$service->title?></option>
                            <?php endforeach;?>
                        </select>
                    </div>

                    <div class="knopka9 next1" id="pole3">
                        <input class="numb4" type="text" placeholder="Коментар(за бажанням)" name="comment[1]" value = "<?php echo $data['comment']?>">
                    </div>

                    <div class="knopka9 next1" id="pole3">
                        <input  type="text"  name="mobile[1]" class="numb4 vvod" placeholder="Номер" value="<?php echo $data['mobile']?>">
                    </div>

                    <input  type="hidden" name="distance">

                    <div id="otpravka">
                        <button id="numb3" type="submit" name="toOrder" value="ok">Замовити</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
    <div id="forma2">
        <h6 id="pitanya">Виникли питання? Отримай відповідь на них<br>в нашому CALL-центрі!</h6>
        <div id="disp"><a href="#"><img class="disp1" src="../../webroot/img/template/disp.png" alt="Диспетчер"></a></div>
        <div id="wrapper"><p id="description">Оператори безкоштовної гарячої лінії служби таксі TAXI 838 працюють цілодобово(24/7), тому Ви можете отримати відповідь на будь-яке питання по роботі сервісу,
                набравши короткий номер 0838. Якщо Ви бажаєте висловити свої пропозиції з приводу якості обслуговування клієнтів, звертайтесь в цетр контролі якоті обслуговування клієнтів за номером 1838.</p></div>
    </div>
</div>
<div class="container" id="aplication">
    <div class="row">
        <div class="coll-offset-lg-2 coll-lg-3 coll-offset-md-2 coll-md-3  coll-sm-12 center">
            <img id="smartphone" src="../../webroot/img/template/phone.png" alt="Смартфон з додатком TAXI 838">
        </div>
        <div class="coll-lg-5 coll-md-6 coll-sm-12 abzaC center">
            <h6  id="vstanovi"><strong id="smart">Встанови додаток</strong> "TAXI 838"!</h6>
            <p id="bezlich">Безліч людей щодня користуються послугами служб таксі.<br>
                Якщо у Вас немає можливості здійснити дзвінок в нашу службу,<br>
                але є вихід до мережі Інтернет, то Ви можете замовити таксі в <strong>Києві</strong><br>на
                нашому сайті. Але ще більш зручним буде використовувати<br>
                <strong>мобільний</strong> додаток таксі "<strong id="podcherk">TAXI 838</strong>".
            </p>
            <div id="download">
                <div><a href="#>"><img class="download" src="../../webroot/img/template/01.png" alt="Apple"></a></div>
                <div class="app_google mid"><a href="#>"><img class="download" src="../../webroot/img/template/02.png" alt="Android"></a></div>
                <div class="app_google"><a href="#>"><img class="download" src="../../webroot/img/template/03.png" alt="Windows"></a></div>
            </div>
        </div>
    </div>
</div>

<div id="check_in_block">
    <div id="cell">
        <div id="wrapper_discount">
        <div class="container">
            <div class="row">
                <div class="coll-offset-lg-2 coll-lg-8 coll-offset-sm-1 coll-sm-10" id="discount">
                    <p id="title_reg_discount">Зареєструйтесь та отримайте дисконтну карту зі стартовою знижкою у <?=$data['startDiscount']?>% на кожну поїздку!</p>
                </div>
            </div>
        </div>
        <div id="but_reg"><a href="/user/registration/" class="button7">Зареєструватися</a></div>
        </div>
    </div>
</div>


<p id="after_reg_title">Після реєстрації Ви зможете</p>
<div class="container">
    <div class="row">
        <div class="coll-offset-lg-4 coll-lg-4 coll-offset-sm-1 coll-sm-10">
            <div class="image_after"><img src="../../webroot/img/main/after1.JPG"><p class="description_image">Контролювати всі свої поїздки</p></div>
            <div class="image_after"><img src="../../webroot/img/main/after2.JPG"><p class="description_image">Перевіряти баланс бонусів</p></div>
            <div class="image_after"><img src="../../webroot/img/main/after3.JPG"><p class="description_image">Запам'ятовувати маршрути</p></div>
            <div class="image_after"><img src="../../webroot/img/main/after4.JPG"><p class="description_image">Нарощувати знижку</p></div>
        </div>
    </div>
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
                <p class="msgModal">Оплата буде здійснюватися після поїздки.</p>
            <p class="msgModal">Дякуємо за те, що користуєтесь службою таксі TAXI 838</p>
            <?php elseif ($data['descriptor'] == 2):?>
                <h4 class="titleModal">Помилка!</h4>
                <p class="msgModal"><?php echo $data['error'];?></p>
            <?php endif;?>
        </div><!-- content -->

    </div><!-- modal -->
</div><!-- overlay -->




<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="../../webroot/js/main/select.js"></script>
<script src="../../webroot/js/main/choice_service.js"></script>
<script src="../../webroot/js/main/choice_car"></script>
<script src="../../webroot/js/main/datepicker.js"></script>


<script src=" https://code.jquery.com/jquery-1.12.4.js"></script>
<script src=" https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>


<script type="text/javascript" src="//cdn.jsdelivr.net/momentjs/latest/moment-with-locales.min.js"></script>
<script type="text/javascript" src="../../webroot/js/main/wickedpicker.js"></script>


<!--<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.0/jquery.min.js"></script>-->
<script src='http://maps.googleapis.com//maps/api/js?key=AIzaSyBsu1mdA89pNTv3y0QfA8GfZt9g51rIjBY&callback=initMap'></script>
<script src="../../webroot/js/main/distance.js"></script>

<!--<script src="../../webroot/js/main/ajax.js"></script>-->


<script src="../../webroot/js/main/modal.js"></script>


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


