
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>TAXI 838</title>
    <meta name="description" content="Замовлення таксі в Києві онлайн або за номером 838. Низькі тарифи. Різноманітний автопарк. Бронювання замовлень у фірмовій книзі або за допомогою мобільного додатку.">
    <link href = "../../webroot/css/template/header.css" rel = "stylesheet" type = "text/css"/>
    <link href = "../../webroot/css/template/my_grid.css" rel = "stylesheet" type = "text/css"/>
</head>
<body>
<div class="container">
    <header class="head">
        <div class=" coll-lg-5 coll-md-7 coll-sm-7 coll-cus-8" id="logotipchik">
            <img class="logo" src="../../webroot/img/template/LOGO.png" alt="LOGO TAXI 838">
            <div id="slog_up">
                <h1 id="taxi838">TAXI 838</h1>
                <p id="slogan">Швидко. Зручно. Економно.</p>
            </div>
        </div>
        <div class="coll-md-2 coll-offset-1-exs coll-exs-3 phone">
            <img class="telephon" src="../../webroot/img/template/trubka.png" alt="phone">
            <a id="numb" href="tel:+380838"> 838 </a>
        </div>

        <nav  class="coll-lg-6 coll-md-8 navigation">
            <div>
                <div id="log_reg" class="coll-offset-lg-10 coll-lg-2 coll-offset-md-9 coll-md-3">
                    <?php if (!Session::get('user')):?>
                     <div id="exit_icon" style="display: flex; align-content: flex-end"><a href="/user/login"><img  src="../../webroot/img/template/exit.png"></a></div>
<!--                     <div id="exit_title"><a href="#" class="size_font_ex_reg">Вхід</></div>-->
                     <div id="reg_icon"><a href="/user/registration"><img  src="../../webroot/img/template/registration.png"></a></div>
<!--                     <div id="reg_title"><a href="#" class="size_font_ex_reg">Реєстрація</a></div>-->
                    <?php endif; ?>
                    <?php if (Session::get('user')):?>
                    <div id="logout" style="display: flex; align-content: flex-end"><a href="/account/logout"><img  src="../../webroot/img/template/logout.png"></a></div>
                    <?php endif; ?>
                </div>
                <div id="nav_panel">
                    <?php if (Session::get('user')):?>
                    <div class="otstyp"><a href="/account/"> АККАУНТ</a></div>
                    <?php endif; ?>
                    <?php if (!Session::get('user')):?>
                    <div class="otstyp "> <a href="/main">ГОЛОВНА</a></div>
                    <?php endif; ?>
                    <div class="otstyp "> <a href="/services">ПОСЛУГИ</a></div>
                    <div class="otstyp "> <a href="/tariffs">ТАРИФИ</a></div>
                    <div class="otstyp "> <a href="/cars">АВТОПАРК </a></div>
                    <div class="otstyp net" id="last_men" style="float: right" > <a href="/about">ПРО НАС</a></div>
                </div>
            </div>
        </nav>

        <div class="knopka">
            <input type="checkbox" id="hmt" class="hidden-menu-ticker">
            <label  for="hmt">
                <img id="knopka" class="arm" src="../../webroot/img/template/knopka.png" alt="Меню">
            </label>
            <ul class="hidden-menu" id="cheked">
                <input type="checkbox" id="hmt" class="hidden-menu-ticker1">
                <label  for="hmt" id="otstypkrest">
                    <img id="krest" src="../../webroot/img/template/krest.png" alt="Закрити">
                </label>
                <div id="menybar">
                    <?php if (!Session::get('user')):?>
                    <div><a class="menybar" href="/main">ГОЛОВНА</a></div>
                    <?php endif; ?>
                    <?php if (Session::get('user')):?>
                        <div class="spisok"><a class="menybar" href="/account/"> АККАУНТ</a></div>
                    <?php endif; ?>
                    <div class="spisok"><a class="menybar" href="/services">ПОСЛУГИ</a></div>
                    <div class="spisok"><a class="menybar" href="/tarrifs">ТАРИФИ</a></div>
                    <div class="spisok"><a class="menybar" href="/cars">АВТОПАРК</a></div>
                    <div class="spisok"><a class="menybar" href="/about">ПРО НАС</a></div>
                    <?php if (Session::get('user')):?>
                    <div id="login">
                        <div class="float">
                            <a href="/account/logout"><img  id="log_icon_for_tablet" src="../../webroot/img/template/logout.png"></a>
                        </div>
                        <div id="wrap_title_log"> <a id="log_title" class="menybar"  href="/account/destroy">Вихід</a></div>
                    </div>
                    <?php endif;?>
                    <?php if (!Session::get('user')):?>
                    <div id="login">
                        <div class="float">
                            <a href="/user/login"><img  id="log_icon_for_tablet" src="../../webroot/img/template/login.png"></a>
                        </div>
                    </div>
                          <div id="wrap_title_log"> <a id="log_title" class="menybar"  href="/user/login">Вхід</a></div>

                    <div id="reg_user">
                        <div class="float" id="wrap_reg">
                            <a href="/user/registration"><img id="reg_icon_for_tablet" src="../../webroot/img/template/user.png"></a>
                            <div id="reg_title"><a class="menybar"  href="/user/registration">Реєстрація</a></div>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>
            </ul>
        </div>
    </header>
</div>
<div id="shashki"><img src="../../webroot/img/template/shask.png" alt="Полоса шашок таксі"> </div>
</body>
</html>