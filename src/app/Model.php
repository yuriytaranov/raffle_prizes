<?php

namespace app;
use Exception;
class Model {
    protected $_fields = [];
    protected $_values = [];

    protected function describe()
    {
        $fields = Database()->query("describe `{$this->table}`")->fetchAll();
        array_map(function($row){
            $this->_fields[$row['Field']] = $row['Field'];
            $this->_values[$row['Field']] = null;
        }, $fields);
    }

    public function __get($name)
    {
        if(isset($this->_fields[$name])) {
            return $this->_fields[$name];
        }
        throw new Exception("Field {$name} not found in model");
    }

    public function __set($name, $value)
    {
        $this->_values[$name] = $value;
    }

    public function array()
    {
        return $this->_values;
    }

    public function update()
    {
        $update = array_map(function($field){
            return "`{$field}` = :{$field}";
        }, $this->_fields);
        $updateSql = implode(', ', $update);
        Database()->query("update `{$this->table}` set {$updateSql} where `id` = {$this->id}", $this->_values);
    }

    public function insert()
    {
        $quotedFields = [];
        $aliases = [];
        $values = [];

        $fields = $this->_fields;
        unset($fields['id']);
        foreach($fields as $field) {
            $quotedFields[] = "`{$field}`";
            $aliases[] = ":{$field}";
            $values[":{$field}"] = $this->_values[$field];
        }
        $sqlFields = implode(', ', $quotedFields);
        $sqlAliases = implode(', ', $aliases);
        $this->id = Database()->insert("insert into `{$this->table}`({$sqlFields}) values({$sqlAliases})", $values);
        
    }

    public function one($field, $value)
    {
        $result = Database()->query("select * from `{$this->table}` where `{$field}` = :value", [':value' => $value])->fetchAll();
        array_walk($this->_fileds, function($field) use($result){
            $this->_values[$field] = $result[$field];
        });
    }

    public function list()
    {
        $result = Database()->query("select * from `{$this->table}`")->fetchAll();
        $models = array_map(function($row){
            return new static($row);
        }, $result);
        return $models;
    }

    public function __construct($load = null) 
    {
        $this->describe();
        if(! is_null($load)) {
            array_walk($this->_fields, function($field) use($load){
                $this->_values[$field] = $load[$field];
            });
        }
    }
}