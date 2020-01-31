<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;
use App\Role;
use App\Mail\VerificationUser;
use Illuminate\Support\Facades\Mail;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'first_name' => 'required|string|max:191',
            'last_name' => 'required|string|max:191',
            'email' => 'required|string|email|max:191|unique:users',
            'phone' => 'required|numeric|digits_between:8,15',
            'password' => 'required|string|min:6|confirmed',
            'image' => 'required',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $request = app('request');
//        return $request;
        if ($request->hasFile('image')) {
            $userimage = $request->file('image');
             $filename = 'user' . time() . preg_replace('/\..+$/', '', $request->file('image')->getClientOriginalName());
             $image = Image::make($userimage);
            /* $image->resize(355, 237);*/
             Storage::put('image/' . $filename . '.' . $request->file('image')->getClientOriginalExtension(), (string) $image->encode());
             $userProfile = $filename . '.' . $request->file('image')->getClientOriginalExtension();
        }
        else {
            $userProfile = null;
        }
       $user= User::create([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'image' => $userProfile,
            'password' => bcrypt($data['password']),
        ]);
        $roleModel = Role::where('name','user')->first();
        $user->assignRole($roleModel);
        // Mail::to($data['email'])->send(new VerificationUser($user));
        return $user;
    }
    
    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));

        // $this->guard()->login($user);

        return $this->registered($request, $user)
                        ?: redirect($this->redirectPath());
    }
}
