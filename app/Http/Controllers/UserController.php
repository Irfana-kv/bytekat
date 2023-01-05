<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    //
    public function users()
    {
        $title = 'Users';
        $userList = User::get();
        return view('Admin.user.list', compact('title', 'userList'));
    }

    public function userCreate()
    {
        $title = 'Create User';
        $key = 'Add';
        return view('Admin.user.add', compact('title', 'key'));
    }

    public function userStore(Request $request)
    {
        $request->validate([
            'name' => 'required|max:191',
            'email' => 'required|email|unique:users,email,NULL,id,deleted_at,NULL',
            'type' => 'required',
            'password' => ['required',  Password::min(8)->letters()->mixedCase()->numbers()->symbols()],
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->type = $request->type;
        $user->password = Hash::make($request->password);
        $user->email_verified_at = now();
        $user->remember_token = rand(0, 10000000000);
        if ($user->save()) {
            session()->flash('success', 'User has been created successfully');
            return redirect('users');
        } else {
            return back()->with('error', 'Error while creating user');
        }
    }


    public function userEdit($id)
    {
        if ($id > 0) {
            $user = User::find($id);
            $title = 'Edit User';
            $key = 'Edit';
            return view('Admin.user.add', compact('title', 'key', 'user'));
        } else {
            return back()->with('error', 'Error User ID not Found');
        }
    }

    public function statusChange(Request $request)
    {
        $state = $request->state;
        $primary_key = $request->primary_key;
        if ($state == 'true') {
            $status = "Active";
        } else {
            $status = "Inactive";
        }
        $user = User::find($primary_key);
        $user->status = $status;
        if ($user->save()) {
            echo (json_encode(array('status' => true, 'message' => 'Status has been changed succesfully')));
        } else {
            echo (json_encode(array('status' => false, 'message' => 'Error while changing the status')));
        }
    }

    public function deleteUser($id)
    {
        if ($id > 0) {
            $user = User::find($id);
            if ($user->delete()) {
                echo (json_encode(array('status' => true)));
            } else {
                echo (json_encode(array('status' => false, 'message' => 'Some error occured,please try after sometime')));
            }
        }
    }



    public function userUpdate(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|max:191',
            'email' => 'required|email|unique:users,email,' . $id . ',id,deleted_at,NULL',
            'type' => 'required',
        ]);

        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->type = $request->type;
        if ($user->save()) {
            session()->flash('success', 'User has been updated successfully');
            return redirect('users');
        } else {
            return back()->with('error', 'Error while creating user');
        }
    }
}
