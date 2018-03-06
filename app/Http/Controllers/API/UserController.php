<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Auth;
use Validator;

class UserController extends Controller
{
    public $successStatus = 200;

    /**
     * login API
     * 
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request) {
        if(Auth::attempt(['email' => $request->input('email'), 'password' => $request->input('password')])) {
            $user = Auth::user();
            $user['token'] = $user->createToken('MyApp')->accessToken;

            return response()->json($user, $this->successStatus);
        }
        else {
            return response()->json(['error' => 'Unauthorised'], 401);
        }
    }

    /**
     * register API
     * 
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request) {

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'c_password' => 'required|same:password',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 401);            
        }

        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);
        $user['token'] = $user->createToken('MyApp')->accessToken;
        // $success['user'] = $user;

        return response()->json($user, $this->successStatus);
    }

    /**
     * current user details API
     * 
     * @return \Illuminate\Http\Response
     */
    public function getDetails() {
        $user = Auth::user();
        return response()->json($user, $this->successStatus);
    }
}
