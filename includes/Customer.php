<?php

// If it is going to need the database, then it is probably smart to require it before we start.
require_once LIB_PATH . DS . "database.php";

class Customer extends DatabaseObject
{
    protected static $tableName   = "customer";
    protected static $dbFields    = [
        'id',
        'first_name',
        'last_name',
        'street',
        'city',
        'state',
        'zip',
    ];

    public $id;
    public $first_name;
    public $last_name;
    public $street;
    public $city;
    public $state;
    public $zip;

    public static function createTable()
    {
        global $database;
        $sql = 'CREATE table IF NOT EXISTS ' . static::$tableName . ' ' ;
        $sql .= '(';
        $sql .= '`id` INT NOT null AUTO_INCREMENT'
                . ', `first_name` VARCHAR(30) NOT null'
                . ', `last_name` VARCHAR(30) NOT null'
                . ', `street` VARCHAR(30) NOT null'
                . ', `city` VARCHAR(30) NOT null'
                . ', `state` CHAR(2) NOT null'
                . ', `zip` CHAR(5) NOT null'
                . ', PRIMARY KEY(`id`) ';

        $sql .= ')';

        return $database->query($sql);
    }

    public static function make($first_name, $last_name, $street, $city, $state, $zip)
    {
        $customer             = new self;
        $customer->first_name = $first_name;
        $customer->last_name  = $last_name;
        $customer->street     = $street;
        $customer->city       = $city;
        $customer->state      = $state;
        $customer->zip        = $zip;

        return $customer;
    }

    public function name()
    {
        return "{$this->first_name} {$this->last_name}";
    }
}
