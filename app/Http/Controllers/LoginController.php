<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
class LoginController extends Controller
{
    //
    public function logUserin (Request $request) 
    {
        validator([
            'username' => 'required',
            'password' => 'required'
        ]);

        //check password

        $user = User::where('username', $request->username)->get();
        if (count($user) < 1){
            $error = 'This is not a valid user';
                return view('login')->with(['issue' => $error, 'username' => $request->username]);
        }else{
            //check passwords
            $passed = password_verify($request->password, $user[0]->password);

            if($passed){
                //create session
                session(['user_id'=> $user[0]->id]);
                
                return redirect('/dashboard');
            }else{
                $error = 'Password is incorrect';
                return view('login')->with(['issue' => $error, 'username' => $request->username]);
            }
        }
    }

    public function logout () 
    {
        session()->flush();
        return redirect('/');
    }
}
