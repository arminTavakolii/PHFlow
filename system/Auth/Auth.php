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

    private function checkMethod()
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
        return true;
    }

    private function checkLoginMethod()
    {
        if(!Session::get('user'))
        {
            return false;
        }
        $user = User::find(Session::get('user'));
        if(empty($user))
        {
           return false;
        }
        else
        return true;
    }

    private function loginByEmailMethod($email, $password)
    {
        $user = User::where('email', $email)->get();
        if(empty($user))
        {
            error('login', 'کاربر وجود ندارد');
            return false;
        }
        if(password_verify($password, $user[0]->password) && $user[0]->is_active == 1)
        {
            Session::set("user", $user[0]->id);
            return true;
        }
        else
        {
            error("login", 'کلمه ی عبور اشتباه است');
            return false;
        }
    }

    private function loginByIdMethod($id)
    {
        $user = User::find($id);
        if(empty($user))
        {
            error("login", "کاربر وجود ندارد");
            return false;
        }
        else
        {
            Session::set("user", $user->id);
            return true;
        }
    }

}