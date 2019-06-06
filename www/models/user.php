<?php

class User extends Model
{
    protected $idField ='id';


    public static function checkName($name)
    {
        if(strlen($name) >= 2){
            return true;
        }

        return false;
    }

    public static function checkSurname($surname)
    {
        if(strlen($surname) >= 2){
            return true;
        }

        return false;
    }

    public static function checkPassword($password)
    {
        if(strlen($password) >= 6){
            return true;
        }

        return false;
    }

    public static function checkEmail($email)
    {
        if(filter_var($email, FILTER_VALIDATE_EMAIL)){
            return true;
        }
        return false;
    }

    public static function checkEmailExist($email)
    {
        $client = new self();
        $response = $client->builder::select()->where('email = ?', $email)->get();
        if($response){
            return $response[0]['id'];
        }
        return false;
    }

    public static function checkMobileExist($mobile)
    {
        $client = new self();
        $response = $client->builder::select()->where('mobile = ?', $mobile)->get();
        if($response){
            return true;
        }
        return false;
    }

    public static function checkValidMobile($mobile)
    {
        $pattern = "/^\+380\d{3}\d{2}\d{2}\d{2}$/";
        if(preg_match($pattern, $mobile)){
            return true;
        }
        return false;
    }

    public function  registrationClient()
    {
        return $this->save();
    }

    public static function checkUserData($email, $password)
    {
        $client = new self();
        $response = $client->builder::select()->where('email=?', $email)->and('password=?', $password)->getFirst();
        if ($response) {
           return $response[0]['id'];
       }else{
           return false;
       }
    }

    public function checkClientIsActive()
    {
        if($this->confirmation_code == 0){
            return true;
        }else{
            return false;
        }
    }

    public function isActiveUser()
    {
        User::update($this->id, ['confirmation_code' => 0]);
    }


    public static function clientSearchByCode($code)
    {
        $client = new User();
        $clientFields = $client->builder::select()->from($client->table)->where('confirmation_code = ?', $code)->get();
        if($clientFields){
            return $clientFields[0]['id'];
        }
        return false;
    }

    public static function changeClientPassword($idClient, $newPassword)
    {
        $result = self::update($idClient, ['password'=>$newPassword]);
       return $result;
    }

    public function orders()
    {
        return $this->hasMany('orders', 'client');
    }

    public function discount()
    {
        return$this->hasOne('discounts', 'client');
    }


    public static function getIdByMobile($mobile)
    {
        $client = new self();

        $result = $client->builder::select()->from($client->table)->where('mobile = ?', $mobile)->getFirst();

        if ($result){
            return $result['0']['id'];
        }

        return false;
    }


}