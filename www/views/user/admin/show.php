

<link rel="stylesheet" href="../../../webroot/css/user/admin/show.css" media="screen" type="text/css" />


<h1>Перегляд таблиці <?=$data['nameForTable']?></h1>



<div style="text-align: center">
<table style="margin: 0 auto">
    <tr>
        <?php foreach ($data['params'] as $param): ?>
        <th><?=$param['name']?></th>
        <?php endforeach;?>
        <th>Редагування</th>
        <th>Видалення</th>
    </tr>
<?php foreach ($data['records'] as $record): ?>
<tr>
   <?php  foreach ($data['params'] as $nameField => $params):?>
   <?php if (!$params['text_area'] && $nameField != 'image'):?>
           <td><?= $record->$nameField ?></td>
    <?php endif;?>
   <?php if($nameField != 'image' && $params['text_area']):?>
    <td><textarea readonly class="blockText"><?= $record->$nameField ?></textarea></td>
       <?php endif;?>
       <?php if($nameField == 'image'):?>
           <td><img  src="<?=$params['pathToImage'].$record->$nameField?> " style="width: 100px;"></td>
    <?php endif;?>
    <?php endforeach;?>

    <?php foreach ($data['params'] as $nameField => $params):?>
    <?php  reset($data['params'])?>
    <?php if ($nameField == key($data['params'])):?>
            <td><a href="/admin/update/<?=$data['nameClass']?>/<?=$record->$nameField ?>" class="update">Редагувати</a></td>
            <td><a href="/admin/delete/<?=$data['nameClass']?>/<?=$record->$nameField ?>">Видалити</a></td>
        <?php break?>
    <?php endif;?>
    <?php endforeach;?>
</tr>
<?php endforeach;?>
</table>

<a href="/admin/add/<?=$data['nameClass']?>" id="create">Створити</a>

</div>
