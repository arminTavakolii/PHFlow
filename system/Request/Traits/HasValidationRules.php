<?php

namespace System\Request\Traits;

use System\Database\DBConnection\DBConnection;

trait HasValidationRules
{
    protected function maxStr($name, $count)
    {
        if($this->checkFieldExist($name)){
            if (strlen($this->request[$name]) >= $count && $this->checkFirstError($name)){
                $this->setError($name, "$name max length equal or lower than $count character");
            }
        }
    }

    protected function minStr($name, $count)
    {
        if($this->checkFieldExist($name)){
            if (strlen($this->request[$name]) <= $count && $this->checkFirstError($name)){
                $this->setError($name, "$name min length equal or upper than $count character");
            }
        }
    }

    protected function required($name)
    {
        if((!isset($this->request[$name]) || $this->request[$name] === '') && $this->checkFirstError($name)){
            $this->setError($name,"$name is required");
        }
    }

    protected function number($name)
    {
        if($this->checkFieldExist($name)){
            if(!is_numeric($this->request[$name]) && $this->checkFirstError($name))
            {
                $this->setError($name,"$name must be number format");
            }
        }
    }

}



