<?php

namespace System\Request\Traits;

use System\Database\DBConnection\DBConnection;

trait HasValidationRules
{

    public function numberValidation($name, $ruleArray)
    {
        foreach($ruleArray as $rule){
            if($rule == 'required')
            $this->required($name);
            elseif(strpos($rule, "max:") === 0)
            {
                $rule = str_replace('max:', "", $rule);
                $this->maxNumber($name, $rule);
            }
            elseif(strpos($rule, "min:") === 0)
            {
                $rule = str_replace('min:', "", $rule);
                $this->minNumber($name, $rule);
            }
            elseif(strpos($rule, "exists:") === 0)
            {
                $rule = str_replace('exists:', "", $rule);
                $rule = explode(',', $rule);
                $key = isset($rule[1]) == false ? null : $rule[1];
                $this->existsIn($name, $rule[0], $key);
            }
            elseif($rule == 'number')
            {
                $this->number($name);
            }
        }
    }
    protected function maxStr($name, $count)
    {
        if ($this->checkFieldExist($name)) {
            if (strlen($this->request[$name]) >= $count && $this->checkFirstError($name)) {
                $this->setError($name, "$name max length equal or lower than $count character");
            }
        }
    }

    protected function minStr($name, $count)
    {
        if ($this->checkFieldExist($name)) {
            if (strlen($this->request[$name]) <= $count && $this->checkFirstError($name)) {
                $this->setError($name, "$name min length equal or upper than $count character");
            }
        }
    }

    protected function required($name)
    {
        if ((!isset($this->request[$name]) || $this->request[$name] === '') && $this->checkFirstError($name)) {
            $this->setError($name, "$name is required");
        }
    }

    protected function number($name)
    {
        if ($this->checkFieldExist($name)) {
            if (!is_numeric($this->request[$name]) && $this->checkFirstError($name)) {
                $this->setError($name, "$name must be number format");
            }
        }
    }

    protected function date($name)
    {
        if ($this->checkFieldExist($name)) {
            if (!preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/", $this->request[$name]) && $this->checkFirstError($name)) {
                $this->setError($name, "$name must be date format");
            }
        }
    }

    protected function email($name)
    {
        if ($this->checkFieldExist($name)) {
            if (!filter_var($this->request[$name], FILTER_VALIDATE_EMAIL) && $this->checkFirstError($name)) {
                $this->setError($name, "$name must be email format");
            }
        }
    }

    public function existsIn($name, $table, $field = "id")
    {
        if ($this->checkFieldExist($name)) {
            if ($this->checkFirstError($name)) {
                $value = $this->$name;
                $sql = "SELECT COUNT(*) FROM $table WHERE $field = ?";
                $statement = DBConnection::getDBConnectionInstance()->prepare($sql);
                $statement->execute([$value]);
                $result = $statement->fetchColumn();
                if ($result == 0 || $result === false) {
                    $this->setError($name, "$name not already exist");
                }
            }
        }
    }

    public function unique($name, $table, $field = "id")
    {
        if ($this->checkFieldExist($name)) {
            if ($this->checkFirstError($name)) {
                $value = $this->$name;
                $sql = "SELECT COUNT(*) FROM $table WHERE $field = ?";
                $statement = DBConnection::getDBConnectionInstance()->prepare($sql);
                $statement->execute([$value]);
                $result = $statement->fetchColumn();
                if ($result != 0) {
                    $this->setError($name, "$name must be unique");
                }
            }
        }
    }

    protected function confirm($name)
    {
        if ($this->checkFieldExist($name)) {
            $fieldName = "confirm_".$name;
            if(!isset($this->$fieldName)){
                $this->setError($name, " $name $fieldName not exist");
            }
            elseif($this->$fieldName != $this->$name){
                $this->setError($name, "$name confirmation does not match");
            }
        }
    }
    
}
