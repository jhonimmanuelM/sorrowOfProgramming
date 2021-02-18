<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Exception;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use DB;
use Redirect;
class GoogleController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function handleGoogleCallback()
    {
        try {

            $user = Socialite::driver('google')->user();
            $finduser = User::where('email', $user->email)->first();

            if($finduser){

                Auth::login($finduser);
                $id = AUTH::user()->id;
                $user  = User::where('id',$id)->update(['avatar' => $user->avatar_original,'google_id' => $user->id]);
                return redirect()->intended('/');

            }else{
		$emailNotCreated =1;
              	return redirect()->to('/login')->with('emailNotCreated', $emailNotCreated);
                // $empId = User::orderBy('id','DESC')->first();
                // $empId =$empId->employee_number + 1;
                // $newUser = User::create([
                //     'name' => $user->name,
                //     'email' => $user->email,
                //     'google_id'=> $user->id,
                //     'employee_number' => $empId,
                //     'password' => encrypt('admin@123'),
                //     'avatar' => $user->avatar_original
                // ]);
                // DB::table('model_has_roles')->insert(['role_id'=>2,'model_type' => 'App\Models\User','model_id'=> $newUser->id]);
                // Auth::login($newUser);
                // return redirect()->intended('/');
            }

        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }
}
