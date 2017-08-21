<?php

namespace App;

use Laravel\Socialite\Contracts\User as ProviderUser;
use Illuminate\Http\Request;
use App\Role;
use Exception;

class FacebookService
{
    public function createOrGetUser(ProviderUser $providerUser)
    {
        $user = User::whereEmail($providerUser->getEmail())
                    ->first();

        if ($user) {
            // update token 
            $user->fb_access_token = $providerUser->token;
            $user->name = $providerUser->getName();
            $user->save();

            return $user;
        } else {
            //return Redirect::back()->withErrors(["Sorry, you are not yet registered."]);
            throw new Exception("Sorry, you are not yet registered.");
            // $user = User::create([
            //     'name' => $providerUser->getName(),
            //     'email' => $providerUser->getEmail(),
            //     'role_id' => Role::USER_ROLE_ID,
            //     'fb_access_token' => $providerUser->token
            // ]);

            // return $user;

        }

    }
}