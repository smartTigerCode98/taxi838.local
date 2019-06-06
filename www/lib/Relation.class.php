<?php

class Relation
{
    protected $table;

    protected $foreignKey;

    protected $idField;

    protected $valueId;

    protected $builder;

    protected $nameClass = null;

    public function __construct($table, $foreignKey, $fatherThis, $nameClass = null)
    {

        $this->table = $table;

        $this->foreignKey = $foreignKey;

        $this->idField = $fatherThis->idField;

        $this->valueId = $fatherThis->getIdValue();

        $this->builder = SQLBuilder::table($this->table);

        $this->builder = $this->builder->where($this->foreignKey.'='.'?', $this->valueId);

        if($nameClass == null){
            $this->nameClass =  ucfirst($table);
            $this->nameClass = mb_substr($this->nameClass, 0, -1);
        }else{
            $this->nameClass = $nameClass;
        }
    }

    public function __call($method, $arguments)
    {
        if(is_array($arguments)){
            $countArguments = count($arguments);
            if($countArguments === 2) {
                $response = $this->builder->$method($arguments[0], $arguments[1]);
                // return $response;
            }else if ($countArguments === 1){
                $response = $this->builder->$method($arguments[0]);
                // return $response;
            }else{
                $response = $this->builder->$method();
            }
            if($response instanceof SQLBuilder)
                return $this;
            return $response;
        }
        return false;
    }

    public static function __callStatic($method, $arguments)
    {
        $model = new static();
        if(is_array($arguments)){
            $countArguments = count($arguments);
            if($countArguments === 2) {
                $response = $model->builder->$method($arguments[0], $arguments[1]);
                $model->builder=$response;

            }else if($countArguments === 1){
                $response = $model->builder->$method($arguments[0]);
                $model->builder=$response;

            }else{
                $response = $model->builder->$method();
                $model->builder=$response;

            }

            //return $response;
            return $model;
        }
        return false;
    }

}