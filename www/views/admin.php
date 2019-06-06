
<?php if(Session::get('notShowIt')==null):?>
<?php include ("template/admin/admin_header.php");?>
<?php else:?>
    <?php Session::delete('notShowIt')?>
<?php endif;?>

<?=$data['content']?>




