<?php

class Car extends Model
{

    protected $idField = 'state_auto_number';

    public static function getRecordsFromRange($hov, $startingFromWhere)
    {
        $bodyTypes = new self();

        return $bodyTypes->convertToObject($bodyTypes->builder::select()->from($bodyTypes->table)->limit($hov)->offset($startingFromWhere)->get());
    }

    public static function getCountRecords():int
    {
        $cars = new self();
        return $cars->builder::select('COUNT(*)')->from($cars->table)->assemble()[0]['COUNT(*)'];
    }

    public static function getAllCarsWhoISFree()
    {
        $cars = new self();

        $searchCar  = $cars->builder::select()->from($cars->table)->where('is_free = ?', 1)->get();

        if($searchCar){

            return $cars->convertToObject($searchCar);

        }

        return false;
    }

    public static function getFirstCarWhoIsFree($bodyType)
    {
        $cars = new self();

        $cars = $cars->builder::select()->from($cars->table)->where('is_free = ?', 1)->and('body_type = ?', $bodyType)->getFirst();

        if($cars){
            $state_auto_number = $cars[0]['state_auto_number'];

            Car::update($state_auto_number, ['is_free' => 0]);

            return $state_auto_number;
        }

        return false;
    }
}