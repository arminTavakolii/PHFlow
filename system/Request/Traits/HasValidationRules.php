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
}



