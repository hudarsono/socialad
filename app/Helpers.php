<?php

function action_value($action_type, $actions_array) {
	if ($index = array_search($action_type, array_column($actions_array, "action_type"))){
		return (int)$actions_array[$index]["value"];
	} else {
		return false;
	}
}

function action_type_humanize($action_type) {
	$action_map = [
		'impressions' => "Impressions",
		'ctr' => "CTR",
		'cpc' => "CPC",
		'reach' => "Reach",
		'spend' => "Spend",
		'clicks' => "Clicks",
		'cpm' => "Cost 1k imps",
		'cpp' => "Cost 1k reach",
		'cost/purchase' => "Cost per Purchase",
		'cost/comment' => "Cost per Comment",
		// 'attention_event' => "Attention Event",
		// 'landing_page_view' => "Landing Page View",
		'like' => "Page Like",
		'link_click' => "Link Click",
		'offsite_conversion.fb_pixel_initiate_checkout' => "Initiate Checkout",
		'offsite_conversion.fb_pixel_view_content' => "View Content",
		'offsite_conversion.fb_pixel_lead' => "Lead",
		// 'photo_view' => "Photo View",
		'post' => "Post Shares",
		'post_like' => "Post Like",
		'page_engagement' => "Page Engagement",
		'post_engagement' => "Post Engagement",
		// 'offsite_conversion' => "Offsite Conversion",
		// 'view_content' => "View Content",
		'offsite_conversion.fb_pixel_add_to_cart' => "Adds to Cart",
		// 'add_to_cart' => "Add Cart",
		'offsite_conversion.fb_pixel_purchase' => "Purchase",
		// 'page_follow' => "Page Follow",
		// 'purchase' => "Purchase",
		'comment' => "Post Comment"
	];

	return collect($action_map)->get($action_type, $action_type);
}

function param_list() {
	return [
		'reach',
		'impressions',
		'ctr',
		'cpc',
		'spend',
		'clicks',
		'cpm',
		'cpp'
	];
}

function action_list() {
	return [
		'like',
		'link_click',
		'offsite_conversion.fb_pixel_lead',
		'post',
		'post_like',
		'page_engagement',
		'post_engagement',
		'offsite_conversion.fb_pixel_view_content',
		'offsite_conversion.fb_pixel_add_to_cart',
		'offsite_conversion.fb_pixel_initiate_checkout',
		'offsite_conversion.fb_pixel_purchase',
		'offsite_conversion.fb_pixel_lead',
		'cost/purchase',
		'comment',
		'cost/comment'
		];
}