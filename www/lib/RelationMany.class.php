<?php

class RelationMany extends Relation
{
    public function get()
    {
        $result = $this->builder->get();
        $models = [];
        $numberModel = 0;
        foreach ($result as $record){
            $models[] = new $this->nameClass($record);
            foreach ($record as $key=>$value) {
                if(!$this->idField)
                    if (mb_strpos($key, "i") == 0 and mb_strpos($key, "d") == 1) {
                        $models[$numberModel]->idField = $key;
                    }
                $models[$numberModel]->idValue = $value;
            }
            $numberModel+=1;
        }

        return $models;
    }
}