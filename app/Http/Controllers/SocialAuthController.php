<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\FacebookService;
use Socialite;
use App\User;

class SocialAuthController extends Controller
{
	const FB_SCOPES = ['email', 'public_profile', 'read_insights', 'read_audience_network_insights', 'manage_pages', 
						'ads_read','ads_management', 'business_management'];

    public function fbRedirect()
    {
        return Socialite::driver('facebook')
        		->scopes(['email', 'public_profile','read_insights', 'read_audience_network_insights', 'manage_pages', 
                        'ads_read','ads_management', 'business_management'])
        		->redirect();   
    }   

    public function fbCallback(FacebookService $service)
    {
        $providerUser = \Socialite::driver('facebook')->user(); 

        $user = $service->createOrGetUser($providerUser);

        auth()->login($user);

        return redirect()->to('/fb_insight');



    }
}
