<?php

namespace App;

use Laravel\Socialite\Contracts\User as ProviderUser;

class FacebookService
{
    public function createOrGetUser(ProviderUser $providerUser)
    {
        $user = User::whereEmail($providerUser->getEmail())
                    ->first();

        if ($user) {
            // update token 
            $user->update(['fb_access_token' => $providerUser->token]);

            return $user;
        } else {

            $user = User::create([
                'name' => $providerUser->getName(),
                'email' => $providerUser->getEmail(),
                'fb_access_token' => $providerUser->token
            ]);

            return $user;

        }

    }
}