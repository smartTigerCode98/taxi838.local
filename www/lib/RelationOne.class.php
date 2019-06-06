<?php

class RelationOne extends Relation
{
    public function get()
    {
        $result = $this->builder->getFirst();
        if($result){
        $model = new $this->nameClass($result[0]);
        foreach ($result[0] as $key=>$value){
                if(!$this->idField)
                    if (mb_strpos($key, "i") == 0 and mb_strpos($key, "d") == 1) {
                        $model->idField = $key;
                    }
                $model->idValue = $value;
            }


        return $model;
    }
    return false;
    }
}