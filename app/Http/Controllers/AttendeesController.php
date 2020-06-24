<?php

namespace App\Http\Controllers;

use App\Attendance;
use App\Talk;
use Illuminate\Http\Request;
use App\User;

class AttendeesController extends Controller
{
    //
    public function create(Request $request)
    {
        validator(
            [
                $request->username => 'required | unique',
                $request->email =>    'required | unique | email',
                $request->password => 'required',
                $request->_token => 'required'
            ]
            ); //validate data in backend

            //check if password is equal

            if ( $request->password === $request->password2){
                $password = password_hash($request->password, CRYPT_BLOWFISH); //hash password

                $saved = User::firstOrCreate(['email' => $request->email, 'username' => $request->username, 'password' => $password]); //first check whether email and username has been created before saving

                if ( $saved ) {
                    return redirect('/');
                }else{
                    $error = 'User not saved';
                    return view('register')->with(['issue' => $error, 'username' => $request->username, 'email' => $request->email]);
                }
            }else{
                $error = 'Password does not match';
                return view('register')->with(['issue' => $error, 'username' => $request->username, 'email' => $request->email]);
            }

    }

    //add attendee to talk
    //create attendance
    public function add(Request $request)
    {
        validator([
            'attendee_id' => 'required',
            'talk_id'  => 'required',
        ]);
        
        //initailize
        $attendee_id = $request->attendee_id;
        $talk_id = $request->talk_id;

        //check if logged in
        if (session()->get('user_id')){
            //continue adding
            $check_attendee_id = User::find($attendee_id);

            //check if attendee_id exist
            if ($check_attendee_id){

                //check talk id
                $check_talk = Talk::find($talk_id);

                if($check_talk){
                    //add to attendance
                    $attendance = new Attendance();
                    $attendance->talk_id = $talk_id;
                    $attendance->attendee_id = $attendee_id;

                    $saved = $attendance->save();

                    if ($saved){
                        //return 201
                        return response($content =['message' => 'Attendee added to talk successfully', 'data' => [], 'response'=> 'created'], 201);
                    }else{
                        //return 400
                        return response($content =['message' => 'error occurred', 'data' => [], 'response'=> 'error'], 400);
                    }
                }else{
                    //return 404 error
                    return response($content =['message' => 'Bad request', 'data' => [], 'response'=> 'error'], 404);
                }

            }else{
                //return 403 error
                return response($content =['message' => 'Unauthorized attendee', 'data' => [], 'response'=> 'error'], 403);
            }

        }else{
            //return 403 error
            return response($content =['message' => 'Unauthorized request', 'data' => [], 'response'=> 'error'], 403);
        }
        
        
    }
}
