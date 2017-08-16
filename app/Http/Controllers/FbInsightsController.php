<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\View;
use FacebookAds\Api;
use FacebookAds\Object\Ad;

class FbInsightsController extends Controller
{

	public function __construct()
	{
	    $this->middleware('auth');
	}

    public function keywordStats()
    {
    	// validate input 
    	if (count(request()->params) + count(request()->actions) == 0) {
    		return Redirect::back()->withErrors(["Select at least one parameter"])->with('input', Input::all());
    	}

    	Api::init(config('services.facebook.client_id'), 
    				config('services.facebook.client_secret'), 
    				Auth::user()->fb_access_token);
		$api = Api::instance();

		try {
			$ad = new Ad(request()->ad_id);
			$r = $ad->getKeywordStats(array('name',"impressions", "ctr", "cpc", "reach", "spend", "actions"));

			$data = $r->getResponse()->getContent();
		}
		catch (\Exception $e) {
			return Redirect::back()->withErrors([$e->getMessage()])->with('input', Input::all());
		}
		
 		$params = [];
		foreach ($data["data"] as $i) {
			if (!isset($i["actions"])) continue;
			array_push($params, array_column($i['actions'], "action_type"));
		}

		$data["actions"] = collect($params)->flatten()->unique();

		return view::make('fbinsights.keyword_stats', compact('data'))->withInput(Input::all());

    }

    public function index()
    {
    	return view('fbinsights.keyword_stats', []);
    }
}
