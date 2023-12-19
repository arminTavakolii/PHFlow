<?php

namespace System\Request;



use System\Request\Traits\HasFileValidationRules;
use System\Request\Traits\HasRunValidation;
use System\Request\Traits\HasValidationRules;

class Request
{

    use HasValidationRules,HasFileValidationRules,HasRunValidation;
    
    protected $errorExist = false;
    protected $request;
    protected $files = null;
    protected $errorVariablesName = [];
    
}

public function __construct()
    {
        if(isset($_POST)) {
            $this->postAttributes();
        }
        if(!empty($_FILES))
            $this->files = $_FILES;
        $rules = $this->rules();
        empty($rules) ? : $this->run($rules);
        $this->errorRedirect();
    }

    protected function rules()
    {
        return [];
    }

