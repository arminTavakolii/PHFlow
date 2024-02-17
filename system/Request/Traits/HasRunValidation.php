<?php

namespace System\Request\Traits;

trait HasRunValidation
{
    protected function errorRedirect()
    {
        if($this->errorExist == false){
            return $this->request;
        }
        return back();
    }
    private function checkFirstError($name)
    {
        if(!errorExists($name) && !in_array($name, $this->errorVariablesName)){
            return true;
        }
        return false;
    }

    private function checkFieldExist($name)
    {
        
    }

    
}
