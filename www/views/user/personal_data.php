

<link rel="stylesheet" href="../../webroot/css/main/modal.css">
<link rel="stylesheet" href="../../webroot/css/user/admin/update.css" media="screen" type="text/css" />

<link rel="stylesheet" href="../../webroot/css/user/client/personal_data.css" media="screen" type="text/css" />
<h1 id="personalPage">Персональні дані</h1>
<form method="post" enctype="multipart/form-data">
    <div class="container">
        <div class="row">
            <div class="coll-offset-lg-3 coll-lg-6">
                <div class="main">
                    <div class="field">
                        <label for="name">Ім'я</label>
                        <input name="name" type="text" readonly value="<?=$data['user']->name?>" id="name">
                    </div>

                    <div class="field">
                        <label for="surname">Прізвище</label>
                        <input name="surname" type="text" readonly value="<?=$data['user']->surname?>" id="surname">
                    </div>


                    <div class="field">
                        <label for="email">Емейл</label>
                        <input name="email" type="text" readonly value="<?=$data['user']->email?>" id="email">
                    </div>

                    <div class="field">
                        <label for="mobile">Мобільний телефон</label>
                        <input name="mobile" type="text" readonly value="<?=$data['user']->mobile?>" id="mobile">
                    </div>

                    <div class="field">
                        <label for="mobile">Дисконтна карта(%)</label>
                        <input name="mobile" type="text" readonly value="<?=$data['discount']->discount?>" id="mobile">
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>