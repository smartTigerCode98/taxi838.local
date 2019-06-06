

<link rel="stylesheet" href="../../../webroot/css/main/modal.css">
<link rel="stylesheet" href="../../../webroot/css/user/admin/delete.css">

<input type="hidden" id="n1">
<div class="modal-overlay">
    <div class="modal">
        <div class="modal-content">
            <?php if(isset($data['showConfirmationBlock']) && $data['showConfirmationBlock'] == 1 && !isset($data['resultDelete'])):?>
                <h3 class="titleModal">Підтвердження видалення запису</h3>
                <div>
                    <p class="answer">Натисніть ВИДАЛИТИ для видалення цього запису,<br>або СКАСУВАТИ, для скасування видалення.</p>
                    <a class="backToTable" href="/admin/show/<?=$data['nameClass']?>">СКАСУВАТИ</a>
                    <form method="post">
                        <input type="hidden" name="confirmation" value="1">
                        <input class="goDelete" type="submit" value="ВИДАЛИТИ">
                    </form>
                </div>
            <?php endif;?>
            <?php if (isset($data['resultDelete']) && $data['resultDelete'] == 1):?>
                <h3 class="titleModal">Результат видалення запису</h3>
                <div>
                    <p class="answer">Запис успішно видалено</p>
                    <a class="backToTable" href="/admin/show/<?=$data['nameClass']?>">Повернутися до таблиці <?=$data['nameForTable']?></a>
                </div>
            <?php endif;?>
            <?php if(isset($data['resultDelete']) && $data['resultDelete'] != 1): ?>
                <div class="error">
                    <p class="answer">При видалені запису сталася помилка.</p>
                    <a class="backToTable" href="/admin/show/<?=$data['nameClass']?>">Повернутися до таблиці <?=$data['nameForTable']?></a>
                </div>
            <?php endif;?>
        </div>
    </div>
</div>



<script src=" https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="../../../webroot/js/main/modal.js"></script>

<?php
if(isset($data['showConfirmationBlock'])){
    echo "<script>
    $(document).ready(function(){
        document.getElementById('n1').click();

    });

</script>";
}
?>