<?php

namespace System\Session;

class Session
{

    public function set($name, $value)
    {
        $_SESSION[$name] = $value;
    }

    public function get($name)
    {
        return isset($_SESSION[$name]) ? $_SESSION[$name] : false;
    }

    public function remove($name)
    {
        if(isset($_SESSION[$name]))
        unset($_SESSION[$name]);
    }

}