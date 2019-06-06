<?php

class BodyType extends Model
{
    protected $table = "body_types";

    protected $idField = "title";

    public static function getAllBodyTypes()
    {
        return BodyType::getExistingRecords();
    }

    public function cars()
    {
        return $this->hasMany('cars', 'body_type');
    }

    public static function getPriceBehindKM($nameType)
    {
        $bodyType = BodyType::find($nameType);

        if($bodyType){
            return $bodyType->price_behind_km;
        }

        return false;
    }

    public static function getCountRecords():int
    {
        $bodyType = new self();
        return $bodyType->builder::select('COUNT(*)')->from($bodyType->table)->assemble()[0]['COUNT(*)'];
    }

    public static function getRecordsFromRange($hov, $startingFromWhere)
    {
        $bodyTypes = new self();

        return $bodyTypes->convertToObject($bodyTypes->builder::select()->from($bodyTypes->table)->limit($hov)->offset($startingFromWhere)->get());
    }

    public static function getIdByTypeName($typeName)
    {
        $bodyType = new self();

        $bodyType = $bodyType->builder::select()->from($bodyType->table)->where('image = ?', $typeName.'.JPG')->assemble();

        if($bodyType){
            return $bodyType[0]['title'];
        }

        return false;
    }

    public function saidTypeEnglish():string
    {
        return explode('.', $this->image)[0];
    }

    public static function getAllBodyTypeWhosCarsIsFree()
    {

        $resultCheck = array();

        $bodyTypes = BodyType::getExistingRecords();

        if($bodyTypes){
            foreach ($bodyTypes as $bodyType){
               $body_type = BodyType::find($bodyType->title);
               if($body_type){
                   if($body_type->cars()->and('is_free = ?', 1)->get())
                   {
                       $resultCheck[]= $body_type;
                   }
               }
            }
        }

        return $resultCheck;
    }

    public static function getBodyTypes()
    {
        $bodyType = new self();

        $result = $bodyType->builder::select()->from($bodyType->table)->orderBy('price_behind_km', 'ASC')->get();

        if($result){
            return $bodyType->convertToObject($result);
        }

        return false;
    }
}