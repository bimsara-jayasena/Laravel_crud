<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Models\Admin;
use App\Models\Catagory;
use App\Models\Item;
use App\Models\User;
use Exception;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;


use Illuminate\Http\RedirectResponse;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

use function PHPUnit\Framework\isEmpty;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('Register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(RegisterRequest $request)
    {
        
        try{
            $fields=$request->validated();
           
            $nameExist=Admin::where('firstname',$request->firstname)
                            ->where('lastname',$request->lastname)->get();
            $usernameExist=Admin::where('username',$request->username)->get();

            if(!$nameExist->isEmpty()){
                return redirect()->back()->with('error','this name is already exist');
            }else if(!$usernameExist->isEmpty()){
                return redirect()->back()->with('error','this user name is already exist');
            }else{
            $user = Admin::create([
                'firstname' => $request->firstname,
                'lastname' => $request->lastname,
                'email' => $request->email,
                'username' => $request->username,
                'role'=>$request->role,
                'password' => Hash::make($request->password),
            ]);
    
            event(new Registered($user));
    
           Auth::login($user);
           session()->put('firstname', $user->firstname);
           return redirect()->route('dashboard');
        }
           
            
        }catch(Exception $e){
            return redirect()->route('test')->with('error',$e->getMessage());
        }
    }
}
