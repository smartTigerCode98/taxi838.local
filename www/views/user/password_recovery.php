
<link rel="stylesheet" href="../../webroot/css/user/client/password_recovery.css" media="screen" type="text/css"
      xmlns="http://www.w3.org/1999/html"/>
<link rel="stylesheet" href="../../webroot/css/main/modal.css">


<h1 id="passRecovery">Відновлення паролю</h1>

<?php if(!isset($data['code_is_send']) && !isset($data['bad_code']) && !isset($data['success_code']) && !isset($data['repeatInput']) && !isset($data['success'])):?>
<div class="login-page">
    <div class="form">
        <form class="register-form" method="post">
            <input type="text" name="email" placeholder="Введіть емейл"/>
            <div class="g-recaptcha" data-sitekey="6Lfbh1kUAAAAAOwL_hhqIHTpEWp_ZXTwYrAef7ie"></div>
            <input type=submit id="button" name="get_code" value="отримати код відновлення">
        </form>
    </div>
</div>
<?php endif;?>

<?php if(isset($data['code_is_send']) || isset($data['bad_code'])):?>
    <div class="login-page">
        <div class="form">
            <form class="register-form" method="post">
                <input type="password" name="code" placeholder="Введіть код відновлення"/>
                <div class="g-recaptcha" data-sitekey="6Lfbh1kUAAAAAOwL_hhqIHTpEWp_ZXTwYrAef7ie"></div>
                <input type=submit id="button" name="submit_code" value="надіслати код відновлення">
            </form>
        </div>
    </div>
<?php endif;?>

<?php if(isset($data['success_code']) || isset($data['repeatInput'])):?>
    <div class="login-page">
        <div class="form">
            <form class="register-form" method="post">
                <input type="password" name="newPassword" placeholder="Введіть новий пароль"/>
                <input type="password" name="repeatNewPassword" placeholder="Повторіть пароль"/>
                <div class="g-recaptcha" data-sitekey="6Lfbh1kUAAAAAOwL_hhqIHTpEWp_ZXTwYrAef7ie"></div>
                <input type=submit id="button" name="setNewPassword" value="змінити пароль">
            </form>
        </div>
    </div>
<?php endif;?>


<input type="hidden" id="n1">
<div class="modal-overlay">
    <div class="modal">

        <a class="close-modal">
            <svg viewBox="0 0 20 20">
                <path fill="#000000" d="M15.898,4.045c-0.271-0.272-0.713-0.272-0.986,0l-4.71,4.711L5.493,4.045c-0.272-0.272-0.714-0.272-0.986,0s-0.272,0.714,0,0.986l4.709,4.711l-4.71,4.711c-0.272,0.271-0.272,0.713,0,0.986c0.136,0.136,0.314,0.203,0.492,0.203c0.179,0,0.357-0.067,0.493-0.203l4.711-4.711l4.71,4.711c0.137,0.136,0.314,0.203,0.494,0.203c0.178,0,0.355-0.067,0.492-0.203c0.273-0.273,0.273-0.715,0-0.986l-4.711-4.711l4.711-4.711C16.172,4.759,16.172,4.317,15.898,4.045z"></path>
            </svg>
        </a>

        <div class="modal-content">
            <?php if(isset($data['descriptor']) && $data['descriptor']==0):?>
                <h3 class="titleModal">Помилка!</h3>
                <?php if(isset($data['errors']) && is_array($data['errors'])):?>
                    <div>
                        <?php foreach ($data['errors'] as $error): ?>
                            <p> <?php echo $error ?></p>
                        <?php endforeach; ?>
                    </div>
                <?php endif;?>
                <?php elseif ($data['descriptor'] == 1):?>
                    <h3 class="titleModal">Шановний клієнте!</h3>
                    <div>
                            <p> <?php echo $data['success'] ?></p>
                    </div>
                <?php endif;?>

        </div>
    </div>
</div>


<script src='https://www.google.com/recaptcha/api.js'></script>
<script src=" https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="../../webroot/js/main/modal.js"></script>

<?php
if(isset($data['errors']) || isset($data['success'])){
    echo "<script>
    $(document).ready(function(){
        document.getElementById('n1').click();

    });

</script>";
}
?>