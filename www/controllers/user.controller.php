<?php

class UserController extends Controller
{

    public function __construct(array $data = array())
    {
        parent::__construct($data);

    }


    public function registration()
    {

        $this->data['descriptor'] = 0;
        $this->data['name'] = '';
        $this->data['surname'] = '';
        $this->data['email']= '';
        $this->data['mobile'] = '';
        $this->data['password'] = '';
        $this->data['passwordRepeat'] = '';
        $this->data['success'] = false;

        if($_POST){

            $reCaptcha = new GCaptcha();
            $result = $reCaptcha->verifyResponse($_SERVER['REMOTE_ADDR'], $_POST['g-recaptcha-response'])->isSuccess();


            $this->data['name'] = $_POST['name'];
            $this->data['surname'] = $_POST['surname'];
            $this->data['email'] = $_POST['email'];
            $this->data['mobile'] = $_POST['mobile'];
            $this->data['password'] = $_POST['password'];
            $this->data['passwordRepeat'] = $_POST['passwordRepeat'];
            $this->data['errors'] = false;

            if(!$result){
                $this->data['errors'][] = "Підтвердіть, що Ви не робот";
            }

            if(!User::checkName( $this->data['name'])){
                $this->data['errors'][] = "Ім'я не повино бути коротшим за два символи";
            }

            if(!preg_match("~^[a-zа-яґєіїё\,\\\'\s-]{1,30}$~ui", $this->data['name'])){
                $this->data['errors'][] = "Ім'я повино містити тільки літери";
            }

            if(!User::checkSurname( $this->data['surname'])){
                $this->data['errors'][] = "Прізвище не повино бути коротшим за два символи";
            }

            if(!preg_match("~^[a-zа-яґєіїё\,\\\'\s-]{1,30}$~ui", $this->data['surname'])){
                $this->data['errors'][] = "Прізвище повино містити тільки літери";
            }

            if(!User::checkEmail( $this->data['email'])){
                $this->data['errors'][] = "Неправильно введений емейл";
            }


            if(User::checkEmailExist(($this->data['email']))){
                $this->data['errors'][] = 'Користувач з таким емейлом вже існує';
            }

            if(User::checkMobileExist(($this->data['mobile']))){
                $this->data['errors'][] = 'Користувач з таким номером мобільного телефона вже існує';
            }

            if(!User::checkValidMobile($this->data['mobile'])){
                $this->data['errors'][] = 'Не валідний формат номера мобільного телефону.
                 Введіть у форматі: +380XXXXXXXXX';
            }

            if(!User::checkPassword( $this->data['password'])){
                $this->data['errors'][] = "Пароль не повинен бути коротшим за щість символів";
            }

            if(strcmp($this->data['password'], $this->data['passwordRepeat'])!=0){
                $this->data['errors'][] = "Паролі не збіглися";
            }

            if($this->data['errors'] != true && $result == true){
                $this->model = new User(['name'=>$this->data['name'],
                                           'surname'=>$this->data['surname'],
                                           'email'=>$this->data['email'],
                                           'mobile' => $this->data['mobile'],
                                           'password'=>md5(Config::get('salt').$this->data['password']),
                                           'role'=>'client',
                                           'confirmation_code' => md5(Config::get('salt').$this->data['email'])], true, true);
              $this->data['success'] = $this->model->registrationClient();
              if($this->data['success']){
                  $mail = new Mailer($this->data['email'], $this->data['name'],
                                     'Підтвердження почти для сайту TAXI 838',
                                     $this->model->name.", перейдіть за посиланням http://taxi838.local/user/login/".$this->model->confirmation_code
                                     ." ,якщо Ви реєструвалися на сайті TAXI 838, або проігноруйте це повідомлення, якщо не реєструвалися.");

                  $mail->send();

                  $this->data['descriptor'] = 1;

                  $discount = new Discount(['client' => User::getIdByMobile($this->data['mobile']), 'discount' => DiscountCards::getStartDiscount(), 'travels' => 0], true, true);
                  $discount->save();
              }
            }

        }

        return "../views/user/registration.php";
    }

    public function login()
    {

        $this->data['email']= '';
        $this->data['password'] = '';
        if(isset($_POST['button'])){

            $reCaptcha = new GCaptcha();
            $result = $reCaptcha->verifyResponse($_SERVER['REMOTE_ADDR'], $_POST['g-recaptcha-response'])->isSuccess();

            $this->data['email'] = $_POST['email'];
            $this->data['password'] = $_POST['password'];

            $this->data['errors'] = false;


            $idClient = null;



            if ($result){
                $idClient = User::checkUserData($this->data['email'], md5(Config::get('salt').$_POST['password']));
            }

            if(!$result){
                $this->data['errors'][] = "Підтвердіть, що Ви не робот";
            }

            elseif($idClient == false){
                $this->data['errors'][] = "Неправильний емейл чи пароль";
            }else{
                $client = User::find($idClient);
                if($client->checkClientIsActive()) {

                    $role = $client->role;
                    if ($role == 'client') {
                        Session::set('user', $idClient);
                        Session::set('role', $role);
                        header('Location: /account/');
                    }
                }else{
                    $this->data['errors'][] = "Ви не підтвердили електронну адресу, яку вказали під час реєстрації.
                    Будь ласка, перевірте власну скриньку.";
                }
            }
        }else{
            if (isset($this->getParams()[0])){
                $idClient = User::clientSearchByCode($this->getParams()[0]);
                if($idClient) {
                    $client = User::find($idClient);
                    $client->isActiveUser();
                    Session::set('user', $idClient);
                    Session::set('role', $client->role);
                    header('Location: /account/');
                }
            }
        }

        return "../views/user/login.php";
    }

    public function password_recovery()
    {
        $this->data['email']= '';
        $this->data['descriptor'] = null;
        $this->data['errors'] = null;
        $this->data['success'] = null;

        if(isset($_POST['get_code'])){

            $reCaptcha = new GCaptcha();

            $result = $reCaptcha->verifyResponse($_SERVER['REMOTE_ADDR'], $_POST['g-recaptcha-response'])->isSuccess();

            $this->data['email'] = $_POST['email'];


            if(!User::checkEmail( $this->data['email'])){
                $this->data['errors'][] = "Неправильно введений емейл";
                $this->data['descriptor'] = 0;
            }

            if(!$result){
                $this->data['errors'][] = "Підтвердіть, що Ви не робот";
                $this->data['descriptor'] = 0;
            }



            $idClient = User::checkEmailExist($this->data['email']);

            if(!$idClient){
                $this->data['errors'][] = 'Клієнта з таким емейлом не існує.';
                $this->data['descriptor'] = 0;
            }

            if($this->data['errors']!=true && $idClient){
                $client = User::find($idClient);
                Session::set('idClient', $client->id);
                Session::set('codeRecovery', generate_code(6));
                $mail = new Mailer($this->data['email'], $this->data['email'],
                    'Відновлення пароля для аккаунту на сайті TAXI 838',
                     Session::get("codeRecovery")." - код для відновлення пароля для Вашого аккаунту. Введіть його в поле 'Введіть код відновлення'/");
                $mail->send();
                $this->data['code_is_send'] = true;
                $this->data['success'] = "Код для відновлення пароля від Вашого аккаунту надіслано на Вашу електрону адресу.
                                          Будь ласка, перевірте свою почтову скриньку.";
                $this->data['descriptor'] = 1;
            }
        }

        if(isset($_POST['submit_code'])){
            if(strcmp($_POST['code'], Session::get('codeRecovery'))==0){
                $this->data['success_code'] = true;
            }else{
                $this->data['bad_code'] = true;
                $this->data['errors'][] = "Неправильний код відновлення";
                $this->data['descriptor'] = 0;
            }
        }

        if(isset($_POST['setNewPassword'])){

            $reCaptcha = new GCaptcha();

            $result = $reCaptcha->verifyResponse($_SERVER['REMOTE_ADDR'], $_POST['g-recaptcha-response'])->isSuccess();

            if(!User::checkPassword($_POST['newPassword'])){
                $this->data['errors'][] = "Пароль не повинен бути коротшим за щість символів";
                $this->data['descriptor'] = 0;
            }

            if(strcmp($_POST['newPassword'], $_POST['repeatNewPassword'])!=0){
                $this->data['errors'][] = "Паролі не збіглися";
                $this->data['descriptor'] = 0;
            }

            if(!$result){
                $this->data['errors'][] = "Підтвердіть, що Ви не робот";
                $this->data['descriptor'] = 0;
            }

            if($this->data['errors']!=true){
                $result = User::changeClientPassword(Session::get("idClient"), md5(Config::get('salt').$_POST['newPassword']));
                echo $result;
                if($result){
                    $this->data['success'] = 'Пароль успішно було змінено.';
                    $this->data['descriptor'] = 1;
                    echo '2345';
                    Session::delete('codeRecovery');
                    Session::set('user', Session::get("idClient"));
                    Session::set('role', 'client');
                    Router::redirect('/account/');
                }
            }else{
                $this->data['repeatInput'] = true;
            }
        }


        return "../views/user/password_recovery.php";
    }

    public function admin_login()
    {
        $this->data['email']= '';
        $this->data['password'] = '';
        if(isset($_POST['submit'])){

            $reCaptcha = new GCaptcha();
            $result = $reCaptcha->verifyResponse($_SERVER['REMOTE_ADDR'], $_POST['g-recaptcha-response'])->isSuccess();

            $this->data['email'] = $_POST['email'];
            $this->data['password'] = md5(Config::get('salt').$_POST['password']);

            $this->data['errors'] = false;

            $idAdmin = null;


            $result = true;



            if($result){
                $idAdmin = User::checkUserData( $this->data['email'],  $this->data['password']);
            }

            if(!$result){
                $this->data['errors'][] = "Підтвердіть, що Ви не робот";
            }elseif($idAdmin == false){
                $this->data['errors'][] = "Неправильний емейл чи пароль";
            }else{
                $admin = User::find($idAdmin);
                $role = $admin->role;
                if($role == 'admin'){
                    Session::set('user', $idAdmin);
                    Session::set('role', $role);
                    header('Location: /admin');
                }
            }

        }

        Session::set('notShowIt', 1);

        return "../views/user/admin_login.php";
    }

}

function generate_code($length){
    $num = range(0, 9);
    $alf = range('a', 'z');
    $_alf = range('A', 'Z');
    $symbols = array_merge($num, $alf, $_alf);
    shuffle($symbols);
    $code_array = array_slice($symbols, 0, (int)$length);
    $code = implode("", $code_array);
    return $code;
}

