
<link href = "../../webroot/css/tariff/tariff.css" rel = "stylesheet" type = "text/css"/>
<h1 id="tariff">Тарифи</h1>

<div id="message">
    <div class="container">
        <div class="row">
            <div class="coll-offset-lg-2 coll-lg-8 coll-offset-md-1 coll-md-10" id="information">
                    <div id="content">Шановні клієнти, вартість Вашої поїдки складається з вартості відстані, яку Ви проїдете під час поїздки, вартості
                        послуги, яку Ви оберете та типу автомобіля, в якому забажаєте здійснити подорож.</div>
            </div>
        </div>
    </div>
</div>

<div id="table" class="coll-offset-lg-2 coll-lg-4 coll-md-4 coll-offset-sm-2 coll-sm-4 coll-exs-8 coll-offset-cus-1 coll-cus-10">
<table>
    <tr>
        <th class="title">Назва послуги</th>
        <th class="title">Ціна</th>
    </tr>
    <?php foreach ($data['tariffs'] as $tariff):?>
    <tr>
        <td class="title_service"><?=$tariff->title?></td>
        <td class="price"><?=$tariff->price?> грн</td>
    </tr>
    <?php endforeach; ?>
</table>
</div>


<div id="table" class="coll-lg-4 coll-sm-4 coll-exs-12">
    <table>
        <tr>
            <th class="title">Тип авто</th>
            <th class="title">Вартість проїзду за км</th>
        </tr>
        <?php foreach ($data['auto_tariffs'] as $tariff):?>
            <tr>
                <td class="title_service"><?=$tariff->title?></td>
                <td class="price"><?=$tariff->price_behind_km?> грн</td>
            </tr>
        <?php endforeach; ?>
    </table>
</div>




