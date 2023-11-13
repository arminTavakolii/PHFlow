<?php

namespace System\Auth;

use App\User;
use System\Session\Session;


class Auth
{
   
    private $redirectTo = "/login";

    private function userMethod()
    {
      if(!Session::get('user'))
      {
          return redirect($this->redirectTo);
      }
      $user = User::find(Session::get('user'));
      if(empty($user))
      {
          Session::remove('user');
          return redirect($this->redirectTo);
      }
      else
      return $user;
    }

}