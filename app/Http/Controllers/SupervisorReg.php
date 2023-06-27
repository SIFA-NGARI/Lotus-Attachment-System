<?php

namespace App\Http\Controllers;


use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class SupervisorReg extends Controller
{
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'phone' => ['required'],    
        ]);
       
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role'=> $request->role,
            'phone_number'=> $request->phone,
        ]);

        event(new Registered($user));

        return redirect('admin_reg_supp')->with('success','Successful Registration');
    }
}
