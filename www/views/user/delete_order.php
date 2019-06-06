
<link rel="stylesheet" href="../../webroot/css/user/client/history.css" media="screen" type="text/css" />
<link rel="stylesheet" href="../../webroot/css/user/client/delete_order.css" media="screen" type="text/css" />
<link rel="stylesheet" href="../../webroot/css/user/client/responsive-tables.css" media="screen" type="text/css" />
<script src="../../webroot/js/user/client/jquery.min.js"></script>
<script src="../../webroot/js/user/client/responsive-tables.js"></script>





<h1 id="deleteOrder">Актуальні замовлення</h1>
<div class="container" id="table">
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
                    <th>Дія</th>
                </tr>
                <?php foreach ($data['current_orders'] as $order): ?>
                    <tr>
                        <td><?=$order->where_?></td>
                        <td><?=$order->whence?></td>
                        <td><?=$order->when_?></td>
                        <td><?=$order->time?></td>
                        <td><?=$order->automobile?></td>
                        <td><?=$order->service?></td>
                        <td><?=$order->distance?></td>
                        <td><?=$order->price?></td>
                        <td><a class="delete" href="/account/delete_order/<?=$order->number_order?>">Скасувати</a></td>
                    </tr>
                <?php endforeach;?>
            </table>

        </div>
    </div>
</div>


