<?php

class DiscountCards extends Model{

    protected $table = 'discount_cards';

    protected $idField = 'count_travels';


    public static function getStartDiscount()
    {
        $startDiscount = DiscountCards::find(0);

        if($startDiscount){
            return $startDiscount->discount;
        }

        return false;
    }

    public static function checkNecessityUpdateDiscount($idClient)
    {
        $allDiscounts = DiscountCards::getExistingRecords();

        $user = User::find($idClient);


        $discountObj = $user->discount;

        $currentTravelsClient = $discountObj->travels;

        $currentDiscountClient = $discountObj->discount;

        foreach ($allDiscounts as $discount){
                if($currentTravelsClient >= $discount->count_travels){
                    $currentDiscountClient = $discount->discount;
                }
        }

        if($currentDiscountClient != $discountObj->discount){
            Discount::update($idClient, ['discount' => $currentDiscountClient]);
        }


    }
}