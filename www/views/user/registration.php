
<link rel="stylesheet" href="../../webroot/css/user/client/registration.css" media="screen" type="text/css" />
<link rel="stylesheet" href="../../webroot/css/main/modal.css">


<h1 id="registration">Реєстрація</h1>
<div class="login-page">
    <div class="form">
        <form class="register-form" method="post">
            <input type="text" name="name" placeholder="Ім'я" value="<?=$data['name']?>"/>
            <input type="text" name="surname" placeholder="Прізвище" value="<?=$data['surname']?>"/>
            <input type="text" name="email" placeholder="Емейл" value="<?=$data['email']?>"/>
            <input type="text" name="mobile" placeholder="Мобільний телефон" value="<?=$data['mobile']?>"/>
            <input type="password"  name="password" placeholder="Пароль" value="<?=$data['password']?>"/>
            <input type="password"  name="passwordRepeat" placeholder="Повторіть пароль" value="<?=$data['passwordRepeat']?>"/>
            <div class="g-recaptcha" data-sitekey="6Lfbh1kUAAAAAOwL_hhqIHTpEWp_ZXTwYrAef7ie"></div>
            <button>зареєструватися</button>
            <p class="message">Вже зареєстровані? <a href="/login">Увійти</a></p>
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
            <?php if(isset($data['descriptor']) && $data['descriptor']==0):?>
                <h3 class="titleModal">Помилка!</h3>
                <?php if(isset($data['errors']) && is_array($data['errors'])):?>
                    <div>
                        <?php foreach ($data['errors'] as $error): ?>
                            <p class="errMsg"> <?php echo $error ?></p>
                        <?php endforeach; ?>
                    </div>
                <?php endif;?>
            <?php elseif ($data['descriptor'] == 1):?>
                <h4 class="titleModal"><?=$data['name']?>, Ви успішно зареєстровані!</h4>
                <p class="msgModal">Для активації Вашого аккаунту, ми вислали Вам листа на електрону адресу,
                    яку Ви вказали під час реєстрації. Будь ласка, перевірте почтову скриньку.</p>
            <?php endif;?>
        </div>
    </div>
</div>

<script src=" https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="../../webroot/js/main/modal.js"></script>
<script src='https://www.google.com/recaptcha/api.js'></script>




<?php
if(isset($data['errors'])){
    echo "<script>
    $(document).ready(function(){
        document.getElementById('n1').click();

    });

</script>";
}
if(isset($data['success']) && $data['success'] == true){
    echo "<script>
    $(document).ready(function(){
        document.getElementById('n1').click();

    });

</script>";
}
?>
