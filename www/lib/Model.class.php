<?php

class Model{

    protected $table = null;
    protected $idField = null;
    protected $idValue;
    protected $idAutoincrement = true;
    protected $isNew = false;
    public $attributes = [];
    protected $builder;


    /**
     * @return null
     */
    public function getTable()
    {
        return $this->table;
    }

    /**
     * @return int|null|string
     */
    public function getIdField()
    {
        return $this->idField;
    }

    /**
     * @return mixed
     */
    public function getIdValue()
    {
        return $this->idValue;
    }

    public function __construct($attributes = null, $idAutoincrement = true, $isNew = false)
    {
        if ($attributes) {
            $this->attributes = $attributes;
            foreach ($attributes as $key=>$value){
                if(mb_strpos($key,"i") == 0 and mb_strpos($key,"d") == 1){

                    $this->idField = $key;
                    $this->idValue = $value;
                }
            }
        }
        $this->isNew = $isNew;
        $this->setTable();
        $this->builder = SQLBuilder::table($this->table);
    }

    public function save()
    {
        if($this->isNew){
           return self::create($this->attributes);
        }else{
            self::update($this->idValue, $this->attributes);
        }
    }

    private function setTable()
    {
        if (!$this->table) {
            $nameClass = get_class($this);
            $nameClass = mb_strtolower($nameClass);
            $nameTable = $nameClass.'s';
            $this->table = $nameTable;
            // echo $this->table;
        }
    }

    public function __get($property)
    {
        if(method_exists($this, $property)){
            return $this->$property()->get();
        }
        if($this->attributes) {
            foreach ($this->attributes as $key=>$val)
            {
                if($property==$key)
                    return $val;
            }
        }
        return false;
    }

    public function __set($property, $value)
    {
        if($this->attributes) {
            foreach ($this->attributes as $key=>$val)
            {
                if($property==$key)
                    $this->attributes[$key] = $value;
            }
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

    public function get()
    {
        $result = $this->builder->get();
        $nameClass = get_class($this);
        $models = [];
        $numberModel = 0;
        foreach ($result as $record){
            $models[] = new $nameClass($record);
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

    public static function getExistingRecords()
    {
        $models = new static();
        return $models->get();
    }

    public function getFirst()
    {
        $result = $this->builder->getFirst();
        $nameClass = get_class($this);
        $model = new $nameClass ();
        foreach ($result[0] as $key=>$value){
            $model->attributes[$key]=$value;
            $model->$key = $value;
            if(!$this->idField)
                if(mb_strpos($key,"i") == 0 and mb_strpos($key,"d") == 1) {
                    $model->idField = $key;
                }
            $model->idValue = $value;

        }

        return $model;
    }

    public static function getFirstExistingRecord()
    {
        $models = new static();
        return $models->getFirst();
    }

    //CRUD methods
    public static function create($param = [])
    {
        $countPlaceholders = count($param);
        $placeholders = "";
        $fields = "";
        foreach ($param as $key=>$value)
        {
            if($countPlaceholders!=1){
                $placeholders.=':'.$key.',';
                $fields.= $key.',';
            }else{
                $placeholders.=':'.$key;
                $fields.= $key;
            }
            $countPlaceholders -= 1;
        }
        $model = new static();
        $model->isNew = true;
       return  $model->builder->fields($fields)->values($placeholders, $param)->runInsert();
    }

    public static function find($id)
    {
        $model = new static();
        $response = $model->builder->where($model->idField.'='.'?',$id)->getFirst();
        if($response){
            $model->attributes = $response[0];
            $model->idValue = $id;
            return $model;
        }
        return false;
    }

    public static function update($id, $args = [])
    {
        $query = "";
        $count_args = count($args);
        $args_new = [];
        foreach ($args as $key=>$value)
        {
            $args_new[] = $value;
            if($count_args!=1){
                $query.=$key.'='.'?'.',';
            }else{
                $query.=$key.'='.'?';
            }
            $count_args-=1;
        }
        $model = new static();
        return $model->builder->where($model->idField.'='.'?', $id)->set($query, $args_new)->runUpdate();
    }

    public static function delete($id)
    {
        $model = new static();
        return $model->builder->where($model->idField.'='.'?', $id)->runDelete();
    }

    public function convertToObject($result)
    {
        $nameClass = get_class($this);
        $models = [];
        $numberModel = 0;
        foreach ($result as $record){
            $models[] = new $nameClass($record);
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

    public function hasMany($table, $foreignKey)
    {
        return new RelationMany($table, $foreignKey, $this);
    }

    public function hasOne($table, $foreignKey)
    {
        return new RelationOne($table, $foreignKey, $this);
    }
}