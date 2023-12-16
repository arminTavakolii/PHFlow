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
    
}

