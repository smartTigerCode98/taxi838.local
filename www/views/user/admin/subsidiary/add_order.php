


<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link href = "../../../../webroot/css/main/wickedpicker.css" rel = "stylesheet" type = "text/css"/>
<link rel="stylesheet" href="../../../../webroot/css/user/client/order.css" media="screen" type="text/css" />
<link rel="stylesheet" href="../../../../webroot/css/user/admin/subsidiary/add_order.css" media="screen" type="text/css" />



<div class="coll-lg-12 coll-md-12" id="formOrder"">
<form method="post">
    <div id="wrapper">
        <div class="field">
            <select name="services" id="selectId2" class="select_service">
                <?php foreach ($data['services'] as $service):?>
                    <option value="<?=$service->id?>"><?=$service->title?></option>
                <?php endforeach;?>
            </select>
        </div>
        <div class="field distance">
            <input type="text" name="from" id="from" class="styleInput" placeholder="Куди">
        </div>
        <div class="field distance">
            <input type="text" name="to" id="to" class="styleInput" placeholder="Звідки">
        </div>
        <div class="field distance">
            <input style="text-align: center" type="text" id="datepicker1" class="styleInput" name="when" placeholder="Коли">
        </div>
        <div class="field distance">
            <input  type="text"  class="styleInput timepicker" name="time"  placeholder="О котрій">
        </div>
        <div class="field distance">
            <select  id="selectId" class="selectAuto">
                <option value="Звичайна автівка">Звичайна автівка</option>
                <option value="Автобус">Автобус</option>
                <option value="Лімузин">Лімузин</option>
                <option value="Гібрид">Гібрид</option>
            </select>
        </div>
        <input type="hidden" name="automobile">
        <div class="field distance">
            <input type="text" name="comment" class="styleInput" placeholder="Коментар">
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



<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.0/jquery.min.js"></script>
<script src='http://maps.googleapis.com//maps/api/js?key=AIzaSyBsu1mdA89pNTv3y0QfA8GfZt9g51rIjBY&callback=initMap'></script>
<script src="../../../../webroot/js/user/client/index.js"></script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="../../../../webroot/js/main/select.js"></script>
<script src="../../../../webroot/js/main/choice_service.js"></script>
<script src="../../../../webroot/js/user/client/choice_auto_account.js"></script>
<script src="../../../../webroot/js/main/datepicker.js"></script>


<script src=" https://code.jquery.com/jquery-1.12.4.js"></script>
<script src=" https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>


<script type="text/javascript" src="//cdn.jsdelivr.net/momentjs/latest/moment-with-locales.min.js"></script>
<script type="text/javascript" src="../../../../webroot/js/main/wickedpicker.js"></script>