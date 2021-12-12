<?php
namespace App\Http\Controllers\API;

use App\Models\User;
//use App\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\Routing\Controller;
use Illuminate\Support\Str;
use Session;
use Validator;


class UserApiController extends Controller
{

    use AuthenticatesUsers;



    public function getToken(Request $request)
    {
        return json_response(["OK"]);
    }


    public function login(Request $request)
    {
        $request->validate([
            'remember' => 'nullable|in:0,1',
            'email' => 'nullable|email',
            'password' => 'nullable',
        ]);

        $credentials = $request->only('email', 'password');
        Auth::attempt($credentials, $request->has('remember'));

        // Check for Trotle
        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }

        // Sucess Login
        if (Auth::check()) {
            $user = Auth::user();
            $user->remember_token = Str::random(40);
            //$user->api_token = Str::random(40);
            $user->save();
            //$user->roles =  $user->getUserRoles();            //$user = $request->user()->toArray();


            return json_response(
                $user
            );
        }

        // Fail
        else {
            $this->incrementLoginAttempts($request);
            $e = array();

            $user = User::where("email",  $credentials['email'])->first();

            if($user!= null) {
                array_push($e, "Contraseña errada");
            }else{
                array_push($e, "No existe usuario ".$credentials['email']);
            }
            return json_response(null, -1, 200, $e);
        }

    }


    public function logout(Request $request)
    {
        $user = Auth::user();
        if ($user) {
            $user->api_token = null;
            $user->save();
        }

        //$nada =  Auth::user();

        return json_response([$user], Auth::check() ? -1 : 0);
    }

    public function getUser(Request $request)
    {
        $user = Auth::user();

        return json_response([$user], Auth::check() ? 0 : -1);
    }

}
