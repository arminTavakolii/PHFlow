<?php

namespace System\Session;

class Session
{

    public function set($name, $value)
    {
        $_SESSION[$name] = $value;
    }

}