



<link rel="stylesheet" href="../../../webroot/css/main/modal.css">
<link rel="stylesheet" href="../../../webroot/css/user/admin/update.css" media="screen" type="text/css" />

<h1>Створення запису</h1>

<form method="post" enctype="multipart/form-data">
    <div class="container">
        <div class="row">
            <div class="coll-offset-lg-3 coll-lg-6">
                <div class="main">
                    <?php foreach ($data['params'] as $param => $paramList):?>
                        <?php if ($paramList['update'] == 1):?>
                            <?php if ($paramList['text_area'] == false):?>
                                <div class="field">
                                    <label for="<?=$param?>"><?=$paramList["name"]?></label>
                                    <?php if(strcmp($paramList["html_type"], 'foreign')==0):?>
                                        <select name="<?=$param?>">
                                            <?php foreach ($data['foreignRecords'] as $foreignRecord):?>
                                            <?php foreach ($data['foreignFields'] as $field => $value): ?>
                                                <?php if(strcmp($field, $data['foreignField'])==0):?>
                                                <option value="<?=$foreignRecord->$field?>"><?=$foreignRecord->$field?></option>
                                                    <?php break;?>
                                               <?php endif;?>
                                            <?php endforeach;?>
                                            <?php endforeach;?>
                                        </select>
                                    <?php else:?>
                                    <input name="<?=$param?>" type="<?=$paramList["html_type"]?>"  id="<?=$param?>">
                                    <?php endif;?>
                                </div>
                            <?php else:?>
                                <div class="field">
                                    <label for="<?=$param?>" class="overrideLabel"><?=$paramList["name"]?></label>
                                    <textarea name="<?=$param?>" id="<?=$param?>" class="textBlock"></textarea>
                                </div>
                            <?php endif;?>
                        <?php endif;?>
                    <?php endforeach;?>
                    <a href="/admin/show/<?=$data['nameClass']?>" class="annulment">СКАСУВАТИ</a>
                    <input type="submit" name="save" value="ЗБЕРЕГТИ" class="buttonControl">
                </div>
            </div>
        </div>
    </div>
</form>



<input type="hidden" id="n1">
<div class="modal-overlay">
    <div class="modal">

        <a class="close-modal">
            <svg viewBox="0 0 20 20">
                <path fill="#000000" d="M15.898,4.045c-0.271-0.272-0.713-0.272-0.986,0l-4.71,4.711L5.493,4.045c-0.272-0.272-0.714-0.272-0.986,0s-0.272,0.714,0,0.986l4.709,4.711l-4.71,4.711c-0.272,0.271-0.272,0.713,0,0.986c0.136,0.136,0.314,0.203,0.492,0.203c0.179,0,0.357-0.067,0.493-0.203l4.711-4.711l4.71,4.711c0.137,0.136,0.314,0.203,0.494,0.203c0.178,0,0.355-0.067,0.492-0.203c0.273-0.273,0.273-0.715,0-0.986l-4.711-4.711l4.711-4.711C16.172,4.759,16.172,4.317,15.898,4.045z"></path>
            </svg>
        </a>

        <div class="modal-content">
            <h3 class="titleModal">Результат створення запису</h3>
            <?php if(isset($data['resultCreate']) && $data['resultCreate'] == 1):?>
                <div>
                    <p class="answer">Запис успішно створено.</p>
                    <a class="backToTable" href="/admin/show/<?=$data['nameClass']?>">Повернутися до таблиці <?=$data['nameForTable']?></a>
                </div>
            <?php else: ?>
                <div>
                    <p class="answer">При створені запису сталася помилка.</p>
                </div>
            <?php endif;?>
        </div>
    </div>
</div>
</div>


<script src=" https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="../../../webroot/js/main/modal.js"></script>

<?php
if(isset($data['resultCreate'])){
    echo "<script>
    $(document).ready(function(){
        document.getElementById('n1').click();

    });

</script>";
}
?>