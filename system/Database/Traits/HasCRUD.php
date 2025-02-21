<?php

namespace System\Database\Traits;

use System\Database\DBConnection\DBConnection;

trait HasCRUD{

    protected function createMethod($values){
        
        $values = $this->arrayToCastEncodeValue($values);
        $this->arrayToAttributes($values, $this);
        return $this->saveMethod();
    }


}