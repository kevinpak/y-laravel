<?php


namespace App\Http\Controllers\Users;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

/**
 * This class is the class of login users of application
 * It implement Logout an Login method
 *
 * @package Test
 * @author  SerRroWeb <https://serproweb.ru/>
 * @access  public
 *
 */


class LoginController extends Controller
{

    /**
    * show Login Form
    *
    */

    public function loginForm() {
        return view("auth.login");
    }

    /**
     * Login user
     * @param Illuminate\Http\Request
     * @return redirection to dashbord or redirect with error
     */

    public function login(Request $request) {

        // validations data
        $validataData = Validator::make($request->all(), [
            'email' => "required|email|max:255",
            'password' => "required"
        ]);

        if($validataData->fails()) {
            return redirect()
                    ->back()
                    ->withErrors($validataData);

        }
        $crendentials = $request->only('email', "password");

        if(Auth::attempt($crendentials)) {
            // Redirect to dashbord
            return redirect()->intended("dashbord");
        }else {
            // redirect with error
            return redirect()->back()->with("error", "Invalid credentials");
        }

    }


    /**
     * Logout user
     */
    public function logout() {
        Auth::logout();
        // redirection
        return redirect()->route('login');
    }

}



