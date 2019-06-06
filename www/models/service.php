<?php

class Service extends Model
{
    protected $idField = 'id';

    public function sayTitle()
    {
        return $this->title;
    }

    public function sayDescription()
    {
        return $this->description;
    }

    public static function getIdByName($nameService)
    {
        $service = new self();

        $service->builder::select()->from($service->table)->where('title = ?', $nameService)->assemble();

        if($service){
            return $service[0]['id'];
        }

        return false;
    }

    public static function saidPrice($idService)
    {
        return Service::find($idService)->price;
    }

    public static function getCountRecords()
    {
        $services = new self();

        return $services->builder::select('COUNT(*)')->from($services->table)->assemble()[0]['COUNT(*)'];
    }

    public static function getRecordsFromRange($hov, $startingFromWhere)
    {
        $services = new self();

        return $services->convertToObject($services->builder::select()->from($services->table)->limit($hov)->offset($startingFromWhere-1)->get());
    }
}