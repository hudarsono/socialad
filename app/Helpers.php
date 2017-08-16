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
		'attention_event' => "Attention Event",
		'landing_page_view' => "Landing Page View",
		'like' => "Like",
		'link_click' => "Link Click",
		'offsite_conversion.fb_pixel_initiate_checkout' => "Pixed Checkout",
		'offsite_conversion.fb_pixel_view_content' => "Pixel View",
		'photo_view' => "Photo View",
		'post' => "Post",
		'post_like' => "Post Like",
		'page_engagement' => "Page Engagement",
		'post_engagement' => "Post Engagement",
		'offsite_conversion' => "Offsite Conversion",
		'view_content' => "View Content",
		'offsite_conversion.fb_pixel_add_to_cart' => "Pixel Add Cart",
		'add_to_cart' => "Add Cart",
		'offsite_conversion.fb_pixel_purchase' => "Pixed Purchase",
		'page_follow' => "Page Follow",
		'purchase' => "Purchase",
		'comment' => "Comment"
	];

	return collect($action_map)->get($action_type, $action_type);
}

function param_list() {
	return [
		'impressions',
		'ctr',
		'cpc',
		'reach',
		'spend'
	];
}

function action_list() {
	return [
		'attention_event',
		'landing_page_view',
		'like',
		'link_click',
		'offsite_conversion.fb_pixel_initiate_checkout',
		'offsite_conversion.fb_pixel_view_content',
		'photo_view',
		'post',
		'post_like',
		'page_engagement',
		'post_engagement',
		'offsite_conversion',
		'view_content',
		'offsite_conversion.fb_pixel_add_to_cart',
		'add_to_cart',
		'offsite_conversion.fb_pixel_purchase',
		'page_follow',
		'purchase',
		'comment'
		];
}