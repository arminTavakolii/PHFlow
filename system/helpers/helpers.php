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

function flashExists($name)
{
    return isset($_SESSION["temporary_flash"][$name]) === true ? true : false;
}

function allFlashes()
{
    if (isset($_SESSION["temporary_flash"])) {
        $temporary = $_SESSION["temporary_flash"];
        unset($_SESSION["temporary_flash"]);
        return $temporary;
    }
    else{
        return false;
    }
}

function error($name, $message = null)
{
    if(empty($message))
    {
        if (isset($_SESSION["temporary_errorFlash"][$name])) {
            $temporary = $_SESSION["temporary_errorFlash"][$name];
            unset($_SESSION["temporary_errorFlash"][$name]);
            return $temporary;
        }
        else{
            return false;
        }
    }else{
        $_SESSION["errorFlash"][$name] = $message;
    }
}

function errorExists($name = null)
{
  if($name === null)
  {
      return isset($_SESSION['temporary_errorFlash']) === true ? count($_SESSION['temporary_errorFlash']) : false;
  }
  else{
    return isset($_SESSION['temporary_errorFlash'][$name]) === true ? true : false;
  }
}

function allErrors()
{
    if (isset($_SESSION["temporary_errorFlash"])) {
        $temporary = $_SESSION["temporary_errorFlash"];
        unset($_SESSION["temporary_errorFlash"]);
        return $temporary;
    }
    else{
        return false;
    }
}

function currentDomain()
{
    $httpProtocol = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === "on") ? "https://" : "http://";
    $currentUrl = $_SERVER['HTTP_HOST'];
    return $httpProtocol.$currentUrl;
}

function redirect($url)
{
    $url = trim($url, '/ ');
    $url = strpos($url, currentDomain()) === 0 ?  $url : currentDomain() . '/' . $url;
    header("Location: ".$url);
    exit;
}