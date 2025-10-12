<?php

// Custom Post Types (teams, portfolios, services,  etc)
// start custom post types here

// Teams
if (is_singular('teams') || is_singular('team') || is_post_type_archive('teams') || is_post_type_archive('team') || is_tax('team-category')) {
	get_template_part('inc/page-header/breadcrumbs-team');
	return;
}

// Portfolios
if (is_singular('portfolios') || is_post_type_archive('portfolios') || is_tax('portfolio-category')) {
	get_template_part('inc/page-header/breadcrumbs-portfolio');
	return;
}

// Services
if (is_singular('services') || is_post_type_archive('services') || is_tax('service-category')) {
	get_template_part('inc/page-header/breadcrumbs-service');
	return;
}

// End custom post types

// Blog home (posts page)
if (is_home()) {
	get_template_part('inc/page-header/breadcrumbs-blog');
	return;
}


// plugins
// WooCommerce
if (class_exists('WooCommerce')) {
	if (is_product()) {
		get_template_part('inc/page-header/breadcrumbs-shop-single');
		return;
	}

	if (is_shop() || is_product_category() || is_product_tag()) {
		get_template_part('inc/page-header/breadcrumbs-shop');
		return;
	}
}

// 404 page
if (is_404()) {
	get_template_part('inc/page-header/breadcrumbs-404');
	return;
}

// Pages / custom post types / taxonomies / common
if (is_page()) {
	get_template_part('inc/page-header/breadcrumbs');
	return;
}

// Single blog post
if (is_singular('post')) {
	get_template_part('inc/page-header/breadcrumbs-single');
	return;
}

// Archives (catch-all fallback, only runs if none of the above matched)
if (is_archive()) {
	get_template_part('inc/page-header/breadcrumbs-archive');
	return;
}

// Search
if (is_search()) {
	get_template_part('inc/page-header/breadcrumbs-search');
	return;
}
