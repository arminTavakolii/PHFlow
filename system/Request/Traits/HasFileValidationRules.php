<?php

namespace System\Request\Traits;


trait HasFileValidationRules
{
    protected function fileValidation($name, $ruleArray)
    {
        foreach ($ruleArray as $rule) {
            if ($rule == "required") {
                $this->fileRequired($name);
            } elseif (strpos($rule, "mimes:") === 0) {
                $rule = str_replace('mimes:', "", $rule);
                $rule = explode(',', $rule);
                $this->fileType($name, $rule);
            } elseif (strpos($rule, "max:") === 0) {
                $rule = str_replace('max:', "", $rule);
                $this->maxFile($name, $rule);
            } elseif (strpos($rule, "min:") === 0) {
                $rule = str_replace('min:', "", $rule);
                $this->minFile($name, $rule);
            }
        }
    }

