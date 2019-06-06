
<link rel="stylesheet" href="../../webroot/css/user/client/history.css" media="screen" type="text/css" />

<link rel="stylesheet" href="../../webroot/css/user/client/responsive-tables.css" media="screen" type="text/css" />
<script src="../../webroot/js/user/client/jquery.min.js"></script>
<script src="../../webroot/js/user/client/responsive-tables.js"></script>






<h1 id="titleHistory">Історія замовлень</h1>
<h2 id="filterHistory">Фільтри замовлень</h2>


<form method="post">
    <div class="container">
        <div class="row">
            <div class=" coll-lg-6 coll-offset-sm-1 coll-sm-10 coll-offset-exs-0 coll-exs-12">
                <div class="main">
                    <div class="field">
                        <label class="labelFilter" for="minPrice">Мінімальна вартість поїздки</label>
                        <input class="fieldFilter" type="number" name="minPrice" id="minPrice" value="<?=$data['minPrice']?>">
                    </div>

                    <div class="field">
                        <label class="labelFilter" for="maxPrice">Максимальна вартість поїздки</label>
                        <input class='fieldFilter' type="number" name="maxPrice" id="maxPrice" value="<?=$data['maxPrice']?>">
                    </div>
                </div>
            </div>

            <div class=" coll-lg-6 coll-offset-sm-1 coll-sm-10 coll-offset-exs-0 coll-exs-12">
                <div class="main">
                    <div class="field">
                        <label class="labelFilter" for="minDistance">Мінімальний шлях поїздки </label>
                        <input class="fieldFilter" type="number" name="minDistance" id="minDistance" value="<?=$data['minDistance']?>">
                    </div>

                    <div class="field">
                        <label class="labelFilter" for="maxDistance">Максимальний шлях поїздки</label>
                        <input class="fieldFilter" type="number" name="maxDistance" id="maxDistance" value="<?=$data['maxDistance']?>">
                    </div>
                </div>
            </div>

        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="coll-offset-lg-2 coll-lg-8 coll-offset-sm-1 coll-sm-10 coll-offset-exs-0 coll-exs-12">
                <div class="wrapper">
<!--                    <div class="selectValue" id="handler">-->
                        <select name="serviceFilter" class="selectFilter">
                            <option disabled selected value>Оберіть послугу</option>
                            <?php foreach ($data['services'] as $service):?>
                                <option value="<?=$service->title?>"><?=$service->title?></option>
                            <?php endforeach;?>
                        </select>
<!--                    </div>-->
<!--                    <div class="selectValue">-->
                        <select name="automobileFilter" class="selectFilter">
                            <option disabled selected value>Оберіть авто</option>
                            <?php foreach ($data['automobile'] as $automobile):?>
                                <option value="<?=$automobile->title?>"><?=$automobile->title?></option>
                            <?php endforeach;?>
                        </select>
<!--                    </div>-->
                </div>
            </div>
        </div>
    </div>

    <input type="submit" name="filterTrips" value="Фільтрація поїздок" class="buttonControl">
    <a href="/account/history" class="allTravels">Всі поїздки</a>
</form>




<h2 id="orders">Замовлення</h2>

<div class="container">
    <div class="row">
        <div class="coll-lg-12">
            <table class="responsive">
                <tr>
                    <th>Куди</th>
                    <th>Звідки</th>
                    <th>Коли</th>
                    <th>О котрій</th>
                    <th>Автомобіль</th>
                    <th>Послуга</th>
                    <th>Шлях(км)</th>
                    <th>Ціна(грн)</th>
                </tr>
                <?php foreach ($data['orders'] as $order): ?>
                    <tr>
                        <td><?=$order->where_?></td>
                        <td><?=$order->whence?></td>
                        <td><?=$order->when_?></td>
                        <td><?=$order->time?></td>
                        <td><?=$order->automobile?></td>
                        <td><?=$order->service?></td>
                        <td><?=$order->distance?></td>
                        <td><?=$order->price?></td>
                    </tr>
                <?php endforeach;?>
            </table>

        </div>
    </div>
</div>


<div class="container">
    <div class="row">
        <div class=" coll-offset-lg-3 coll-lg-6 coll-offset-md-2 coll-md-8 coll-offset-sm-0 coll-sm-6 coll-exs-12">
            <div class="main">
                <div class="field">
                    <label class="fieldStatistic" for="totalPrice" id="">Загальна вартість здійснених поїздок</label>
                    <input class="fieldNameValue" type="text" readonly name="totalPrice" id="totalPrice" value="<?=$data['totalPrice']?> грн.">
                </div>
            </div>
        </div>

        <div class=" coll-offset-lg-3 coll-lg-6 coll-offset-md-2 coll-md-8 coll-offset-sm-0 coll-sm-6 coll-exs-12" id="secondBlock">
            <div class="main">
                <div class="field">
                    <label class="fieldStatistic" for="totalPrice">Загальний шлях поїздок</label>
                    <input class="fieldNameValue" type="text" readonly name="totalPrice" id="totalPrice" value="<?=$data['totalDistance']?> км">
                </div>
            </div>
        </div>
    </div>
</div>

<!--<div class="container">-->
<!--    <div class="row">-->
<!--        <div class="coll-offset-lg-3 coll-lg-3">-->
<!--            <div style="width: 400px; height: 200px; background-color: black"></div>-->
<!--        </div>-->
<!--        <div class="coll-lg-3">-->
<!--            <div style="width: 400px; height: 200px; background-color: black"></div>-->
<!--        </div>-->
<!--    </div>-->
<!--</div>-->










