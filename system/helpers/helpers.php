<?php

function dd($value, $die = true){
    var_dump($value);
    if($die)
    exit();
}

function old($name)
{
    if(isset($_SESSION["temporary_old"][$name])){
        return $_SESSION["temporary_old"][$name];
    }
    else{
        return null;
    }
}

function flash($name, $message = null)
{
    if(empty($message))
    {
        if (isset($_SESSION["temporary_flash"][$name])) {
            $temporary = $_SESSION["temporary_flash"][$name];
            unset($_SESSION["temporary_flash"][$name]);
            return $temporary;
        }
        else{
            return false;
        }
    }else{
        $_SESSION["flash"][$name] = $message;
    }
}
