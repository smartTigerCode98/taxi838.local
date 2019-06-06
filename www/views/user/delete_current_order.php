


<link rel="stylesheet" href="../../webroot/css/main/modal.css">
<link rel="stylesheet" href="../../webroot/css/user/admin/delete.css">

<div style="width: 400px; height: 270px; background-color: white"></div>

<input type="hidden" id="n1">
<div class="modal-overlay">
    <div class="modal">
        <div class="modal-content">
            <?php if(isset($data['showConfirmationBlock']) && $data['showConfirmationBlock'] == 1 && !isset($data['resultDelete'])):?>
                <h3 class="titleModal">Підтвердження видалення запису</h3>
                <div>
                    <p class="answer">Натисніть ВИДАЛИТИ для видалення цього замовлення,<br>або СКАСУВАТИ, для скасування видалення.</p>
                    <a class="backToTable" style="width: 220px" href="/account/current_orders">СКАСУВАТИ</a>
                    <form method="post">
                        <input type="hidden" name="confirmation" value="1">
                        <input class="goDelete" style="width: 220px" type="submit" value="ВИДАЛИТИ">
                    </form>
                </div>
            <?php endif;?>
            <?php if (isset($data['resultDelete']) && $data['resultDelete'] == 1):?>
                <h3 class="titleModal">Результат видалення запису</h3>
                <div>
                    <p class="answer">Запис успішно видалено</p>
                    <a class="backToTable" style="width: 330px; height: 50px" href="/account/current_orders/">Повернутися до таблиці Актуальні замовлення</a>
                </div>
            <?php endif;?>
            <?php if(isset($data['resultDelete']) && $data['resultDelete'] != 1): ?>
                <div class="error">
                    <p class="answer">При видалені запису сталася помилка.</p>
                    <a class="backToTable" style="width: 250px" href="/account/current_orders/">Повернутися до таблиці Актуальні замовлення</a>
                </div>
            <?php endif;?>
        </div>
    </div>
</div>

<script src=" https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="../../webroot/js/main/modal.js"></script>

<?php
if(isset($data['showConfirmationBlock'])){
    echo "<script>
    $(document).ready(function(){
        document.getElementById('n1').click();

    });

</script>";
}
?>