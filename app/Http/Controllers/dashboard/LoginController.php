<?php

namespace App\Http\Controllers\dashboard;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\User;
use App\helper\Message;

class LoginController extends Controller {

    /**
     * return login view
     */
    public function index() {
        return view("dashboard.login");
    }

    /**
     * login 
     */
    public function login(Request $request) {
        $error = Message::$LOGIN_ERROR;
        try {
            $user = User::query()
                    ->where("username", $request->username)
                    ->orWhere("email", $request->email)
                    ->orWhere("phone", $request->phone)
                    //->where("password", $request->password)
                    ->first();
            
            if ($user) {
                if (!Hash::check($request->password, $user->password)) {
                    return redirect("/login?status=0&msg=$error");
                }
                
                Auth::login($user);
                return redirect('/');
            }
            
//            $credentials = $request->only('username', 'password'); 
//
//            if (Auth::attempt($credentials)) {
//                // Authentication passed...
//            } 
        } catch (Exception $ex) {}
        return redirect("/login?status=0&msg=$error");
    }
    
    /**
     * logout 
     * 
     */
    public function logout() {
        Auth::logout();
        return redirect("/login");
    }

}
