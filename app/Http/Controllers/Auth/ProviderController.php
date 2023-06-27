<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ProviderController extends Controller
{
    public function redirect($provider)
    {
       
            return Socialite::driver($provider)->redirect();
    
    }
    public function callback($provider)
    {

        try {
            // Get user Information from provider
            $SocialUser = Socialite::driver($provider)->stateless()->user();
            // Get user information from database
            $user = User::where('email', $SocialUser->getEmail())->first();
            if ($user) {
                // Update user information in database if user is exists
                $user->update([
                    'name' => $SocialUser->name,
                    'provider_id' => $SocialUser->id,
                    'provider' => $provider,
                    'provider_token' => $SocialUser->token,
                ]);
            } else {
                // Create new one
                $user = User::create([
                    'name' => $SocialUser->name,
                    'email' => $SocialUser->email,
                    'provider' => $provider,
                    'provider_id' => $SocialUser->id,
                    'provider_token' => $SocialUser->token,
                    'role' => 2,
                ]);
            }
            Auth::login($user);
            return redirect('/dashboard');
        } catch (Exception $e) {
            return $this->failedResponse($e->getMessage());
        } 
        // catch (InvalidStateException $e) {
        //     $SocialUser = Socialite::driver($provider)->stateless()->user();
        //     return redirect()->route('register');
        // }
    }



    /**
     * Send a failed response with a message
     *
     * @param $message
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function failedResponse($message)
    {
        return redirect('/')->with(['message' => $message]);
    }
}
