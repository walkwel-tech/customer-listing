<?php

//If it is going to need database, then it's probably smart to require it before we start
require_once LIB_PATH . DS . 'database.php';

class DatabaseObject
{
    public static function findBySql($sql = "")
    {
        global $database;
        $resultSet   = $database->query($sql);
        $objectArray = [];
        $rows        = $database->fetchArray($resultSet);
        while ($row = current($rows)) {
            $objectArray[] = static::instantiate($row);
            next($rows);
        }

        return $objectArray;
    }

    public static function findAll()
    {
        return self::findBySql("SELECT * FROM " . static::$tableName);
    }

    public static function findLimited($limit = 10, $page = 1)
    {
        $offset = ($page - 1) * $limit;

        return self::findBySql("SELECT * FROM " . static::$tableName . " limit $limit offset $offset");
    }

    public static function findById($id)
    {
        if (empty($id)) {
            return false;
        }
        global $database;
        $id           = $database->escapeValue($id);
        $result_array = self::findBySql("SELECT * FROM " . static::$tableName . " WHERE id = {$id} LIMIT 1");

        return !empty($result_array) ? array_shift($result_array) : false;
    }

    public static function countAll()
    {
        global $database;
        $sql        = "SELECT COUNT(*) FROM " . static::$tableName;
        $resultSet  = $database->query($sql);
        $row        = $database->fetchArray($resultSet);

        return array_shift($row[0]);
    }

    protected static function instantiate($record)
    {
        $object = new static;
        foreach ($record as $attribute => $value) {
            if ($object->hasAttribute($attribute)) {
                $object->$attribute = $value;
            }
        }

        return $object;
    }

    private function hasAttribute($attribute)
    {
        $object_vars = $this->attributes();

        return array_key_exists($attribute, $object_vars);
    }

    public function attributes()
    {
        $attributes = [];
        foreach (static::$dbFields as $field) {
            if (property_exists($this, $field)) {
                $attributes[$field] = $this->$field;
            }
        }

        return $attributes;
    }

    protected function sanitizeAttributes()
    {
        global $database;
        $cleanAttributes = [];

        foreach ($this->attributes() as $key => $value) {
            $cleanAttributes[$key] = $database->escapeValue($value);
        }

        return $cleanAttributes;
    }

    public function insertionAttributes()
    {
        global $database;
        $cleanAttributes = [];

        foreach ($this->attributes() as $key => $value) {
            if ($key != "id") {
                $cleanAttributes[$key] = $database->escapeValue($value);
            }
        }

        return $cleanAttributes;
    }

    public function validateAttributes($attributes = [])
    {
        foreach ($attributes as $attribute) {
            if ($this->hasAttribute($attribute) && empty($this->$attribute)) {
                return false;
            }
        }

        return true;
    }

    public function getDBFields()
    {
        return static::$dbFields;
    }

    // CRUD Functions
    public function save()
    {
        // A new record won't have an id yet.
        return (isset($this->id) || ($this->id != null)) ? $this->update() : $this->create();
    }

    public function create()
    {
        global $database;
        $attributes = $this->insertionAttributes();
        $sql        = "INSERT INTO " . static::$tableName . " (";
        $sql .= join(", ", array_keys($attributes));
        $sql .= ") VALUES (\"";
        $sql .= join("\", \"", array_values($attributes));
        $sql .= "\")";

        if ($database->query($sql)) {
            $this->id = $database->insertID();

            return true;
        } else {
            return false;
        }
    }

    public function update()
    {
        global $database;
        $attributes      = $this->sanitizeAttributes();
        $attribute_pairs = [];
        foreach ($attributes as $key => $value) {
            $attribute_pairs[] = "{$key}='{$value}'";
        }
        $sql = "UPDATE " . static::$tableName . " SET ";
        $sql .= join(", ", $attribute_pairs);
        $sql .= " WHERE id=" . $database->escapeValue($this->id);
        $database->query($sql);

        return ($database->affected_rows() == 1) ? true : false;
    }

    public function delete()
    {
        global $database;
        $sql = "DELETE FROM " . static::$tableName . " ";
        $sql .= "WHERE id=" . $database->escapeValue($this->id) . " ";
        $sql .= "LIMIT 1";
        $database->query($sql);

        return ($database->affected_rows() == 1) ? true : false;
    }
}
