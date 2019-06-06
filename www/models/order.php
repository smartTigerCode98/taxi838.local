<?php

class Order extends Model{

    protected $idField = 'number_order';


    public static function calculatePrice($distance, $typeService, $typeAuto)
    {
        return $distance*BodyType::getPriceBehindKM($typeAuto) + Service::saidPrice($typeService);
    }

    public static function filterOrders($idClient,$minPrice = null, $maxPrice = null, $minDistance = null, $maxDistance = null, $service = null, $automobile = null)
    {
        $orders = new self();

        $ordersRows = $orders->builder::select()->from($orders->table)->where("1 = ?", 1);


        if($minPrice != null){

            $ordersRows->and('price >= ?', $minPrice);
        }

        if($maxPrice != null){

            $ordersRows->and('price <= ?', $maxPrice);
        }

        if($minDistance != null){

            $ordersRows->and('distance >= ?', $minDistance);
        }

        if($maxDistance != null){

            $ordersRows->and('distance <= ?', $maxDistance);
        }

        if($service != null){

            $ordersRows->and('service = ?', $service);
        }

        if($automobile != null){

            $ordersRows->and('automobile = ?', $automobile);
        }

        $ordersRows = $ordersRows->and('client = ?', $idClient)->get();

        if($ordersRows){

            return $orders->convertToObject($ordersRows);

        }else{

            return false;
        }

    }

    public static function calculateTotalPrice($listOrders)
    {
        $sum = 0;

        foreach ($listOrders as $listOrder){

            $sum += $listOrder->price;
        }

        return $sum;
    }

    public static function calculateTotalDistance($listOrders)
    {
        $distance = 0;

        foreach ($listOrders as $listOrder){

            $distance += $listOrder->distance;
        }

        return $distance;
    }

    public static function setNullStateAutoNumber($id)
    {
        self::update($id,['state_auto_number' => NULL]);
    }

    public static function setNullDriver($id)
    {
        self::update($id,['driver' => NULL]);
    }

    public static function getNewOrders()
    {
        $order = new self();

        $orders = $order->builder::select()->from($order->table)->where('performance = ', 0)->get();

        if($orders){
            return $order->convertToObject($orders);
        }

        return false;
    }
}