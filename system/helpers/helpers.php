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

