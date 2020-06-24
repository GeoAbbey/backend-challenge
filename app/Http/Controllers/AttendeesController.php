<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class AttendeesController extends Controller
{
    //
    public function create(Request $request)
    {
        validator(
            [
                $request->name => 'required | unique',
                $request->email =>    'required | unique | email',
                $request->password => 'required',
                $request->_token => 'required'
            ]
            ); //validate data in backend

            //check if password is equal

            if ( $request->password === $request->password2){
                $password = password_hash($request->password, CRYPT_BLOWFISH); //hash password

                $saved = User::firstOrCreate(['email' => $request->email, 'name' => $request->name, 'password' => $password]); //first check whether email and username has been created before saving

                if ( $saved ) {
                    return redirect('/login');
                }else{
                    $error = 'User not saved';
                    return view('register')->with(['issue' => $error, 'username' => $request->name, 'email' => $request->email]);
                }
            }else{
                $error = 'Password does not match';
                return view('register')->with(['issue' => $error, 'username' => $request->name, 'email' => $request->email]);
            }

    }
}
