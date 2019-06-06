<?php

class Driver extends Model
{
    protected $idField = 'callsign';

    public function saidCallsignDriver()
    {
        return $this->callsign;
    }

    public function saidNameDriver()
    {
        return $this->name;
    }

    public function saidSurnameDriver()
    {
        return $this->surname;
    }

    public function saidPatronymicDriver()
    {
        return $this->patronymic;
    }

    public function getLicense()
    {
        return $this->license;
    }

    public function checkDriverIsIll():bool
    {
        if($this->is_ill == 1){
            return true;
        }

        return false;
    }


    public function goToTheHospital()
    {
        $this->is_ill = 1;
        $this->save();
    }

    public function leaveTheHospital()
    {
        $this->is_ill = 0;
        $this->save();
    }

    public function checkDriverOnHoliday():bool
    {
        if($this->on_holiday == 1){
            return true;
        }

        return false;
    }

    public function goOnHoliday()
    {
        $this->on_holiday = 1;
        $this->save();
    }

    public function comeBackFromHoliday()
    {
        $this->on_holiday = 0;
        $this->save();
    }

    public function willPoisonTheOrder()
    {
        $this->is_free = 0;
        $this->save();
    }

    public function willReturnFromTheOrder()
    {
        $this->is_free = 1;
        $this->save();
    }

    public function checkDriverIsFree():bool
    {
        if($this->is_free == 1){
            return true;
        }

        return false;
    }

    public function checkDriverIsDismissed():bool
    {
        if($this->is_dismissed == 1){
            return true;
        }

        return false;
    }

    public function dismissDriver()
    {
        $this->is_dismissed = 1;

        $this->save();
    }

    public function returnDriver()
    {
        $this->is_dismissed = 0;

        $this->save();
    }

    public function recruit()
    {
        $this->save();
    }

    public static function getAllWhoIsSick()
    {
        $drivers = new self();

        $drivers = $drivers->where('is_dismissed = ?', 1)->get();

        return $drivers;
    }

    public static function getAllWhoIsHealthy()
    {
        $drivers = new self();

        $drivers = $drivers->where('is_dismissed = ?', 0)->get();

        return $drivers;
    }

    public static function getAllWhoIsHoliday()
    {
        $drivers = new self();

        $drivers = $drivers->builder::select()->from($drivers->table)->where('on_holiday = ?', 1)->get();

        return $drivers;
    }

    public static function getAllWhoCanTax()
    {
        $drivers = new self();

        $drivers = $drivers->where('on_holiday = ?', 0)->get();

        return $drivers;
    }

    public static function getAllWhoIsFree()
    {
        $drivers = new self();

        $drivers = $drivers->where('is_free = ?', 1)->get();

        return $drivers;
    }

    public static function getAllWhoOnOrder()
    {
        $drivers = new self();

        $drivers = $drivers->where('is_free = ?', 0)->get();

        return $drivers;
    }

    public static function getAllWhoIsDismissed()
    {
        $drivers = new self();

        $drivers = $drivers->where('is_dismissed = ?', 1)->get();

        return $drivers;
    }

    public static function getAllStaffDrivers()
    {
        $drivers = new self();

        $drivers = $drivers->where('is_dismissed = ?', 0)->get();

        return $drivers;
    }


    public static function getFirstDriverWhoIsFree()
    {
        $driver = new self();
        try{
            $driver = $driver->builder::select()->from($driver->table)->where('is_free = ?', 1)
                ->getFirst();

            Driver::update($driver[0]['callsign'], ['is_free' => 0]);

        }catch (Exception $exception){$exception->getMessage();}

//        print_r($driver);

        return $driver[0]['callsign'];
    }


}