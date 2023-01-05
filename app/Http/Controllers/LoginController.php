<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
  //
  public function login()
  {
    return view('Admin.login');
  }

  public function loginSubmit(Request $request)
  {
    $request->validate([
      'username' => 'required|email',
      'password' => 'required',
    ]);

    if (auth()->guard('web')->attempt(['email' => $request->username, 'password' => $request->password])) {
      if (auth()->user()->type == 'Admin') {
        if (auth()->user()->status == 'Active') {
          return redirect('users');
        } else {
          return redirect()->back()->withErrors('Your Account is inactive Please contact admin');
        }
      } else {
        return redirect()->back()->withErrors('Invalid Credentials');
      }
    } else {
      return redirect()->back()->withErrors('Invalid Credentials');
    }
  }

  public function loginUser()
  {
    return view('Web.login');
  }

  public function loginUserSubmit(Request $request)
  {
    $request->validate([
      'username' => 'required|email',
      'password' => 'required',
    ]);

    $remember_me = $request->remember?true:false;

    if (auth()->guard('customers')->attempt(['email' => $request->username, 'password' => $request->password],$remember_me)) {
      if (Auth::guard('customers')->user()->type == 'User') {
        if (Auth::guard('customers')->user()->status == 'Active') {
          return redirect('products');
        } else {
          return redirect()->back()->withErrors('Your Account is inactive Please contact admin');
        }
      } else {
        return redirect()->back()->withErrors('Invalid Credentials');
      }
    } else {
      return redirect()->back()->withErrors('Invalid Credentials');
    }
  }

  public function customerLogout(){
    Auth::guard('customers')->logout();
    return redirect('/');
}

public function adminLogout(){
  Auth::guard('web')->logout();
  return redirect('/admin');
}

}
