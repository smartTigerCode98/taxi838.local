


<link rel="stylesheet" href="../../webroot/css/user/admin/login.css" media="screen" type="text/css"
      xmlns="http://www.w3.org/1999/html"/>
<link rel="stylesheet" href="../../webroot/css/main/modal.css">


<div class="login-page">
    <div id="titleAdmin"><h1>Авторизація адміністратора</h1></div>
    <div class="form">
        <form class="register-form" method="post">
            <input type="text" name="email" placeholder="Емейл" value="<?=$data['email']?>"/>
            <input type="password"  name="password" placeholder="Пароль" value=""/>
            <div class="g-recaptcha" data-sitekey="6Lfbh1kUAAAAAOwL_hhqIHTpEWp_ZXTwYrAef7ie"></div>
            <input type=submit id="button" name="submit" value="увійти">
        </form>
    </div>
</div>


<input type="hidden" id="n1">
<div class="modal-overlay">
    <div class="modal">

        <a class="close-modal">
            <svg viewBox="0 0 20 20">
                <path fill="#000000" d="M15.898,4.045c-0.271-0.272-0.713-0.272-0.986,0l-4.71,4.711L5.493,4.045c-0.272-0.272-0.714-0.272-0.986,0s-0.272,0.714,0,0.986l4.709,4.711l-4.71,4.711c-0.272,0.271-0.272,0.713,0,0.986c0.136,0.136,0.314,0.203,0.492,0.203c0.179,0,0.357-0.067,0.493-0.203l4.711-4.711l4.71,4.711c0.137,0.136,0.314,0.203,0.494,0.203c0.178,0,0.355-0.067,0.492-0.203c0.273-0.273,0.273-0.715,0-0.986l-4.711-4.711l4.711-4.711C16.172,4.759,16.172,4.317,15.898,4.045z"></path>
            </svg>
        </a>

        <div class="modal-content">
            <h3 class="titleModal">Помилка!</h3>
            <?php if(isset($data['errors']) && is_array($data['errors'])):?>
                <div>
                    <?php foreach ($data['errors'] as $error): ?>
                        <p> <?php echo $error ?></p>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>


<script src='https://www.google.com/recaptcha/api.js'></script>
<script src=" https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="../../webroot/js/main/modal.js"></script>

<?php
if(isset($data['errors'])){
    echo "<script>
    $(document).ready(function(){
        document.getElementById('n1').click();

    });

</script>";
}
?>

