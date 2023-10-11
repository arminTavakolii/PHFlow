<?php

function dd($value, $die = true){
    var_dump($value);
    if($die)
    exit();
}

