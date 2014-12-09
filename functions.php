<?php

// First, create a function that includes the path to your favicon
function add_favicon() {
  	$favicon_url = get_stylesheet_directory_uri() . '/images/favicon.ico';
	echo '<link rel="shortcut icon" href="' . $favicon_url . '">';
}
  
// Now, just make sure that function runs when you're on the login page and admin pages  
add_action('login_head', 'add_favicon');
add_action('admin_head', 'add_favicon');

function wp_authenticate_email( $username ) {
    $user = get_user_by( 'email', $username );
    if ( ! empty( $user->user_login ) ) {
        $username = $user->user_login;
    }
    return $username;
}
add_action( 'wp_authenticate', 'wp_authenticate_email' );
 

/**
 * Filter page title
 */
function my_wp_title( $title, $sep ) {
	global $paged, $page;

	if ( is_feed() )
		return $title;

	// Add the site name.
	$title .= get_bloginfo( 'name' );

	// Add the site description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		$title = "$title $sep $site_description";

	// Add a page number if necessary.
	if ( $paged >= 2 || $page >= 2 )
		$title = "$title $sep " . sprintf( __( 'Page %s', 'twentytwelve' ), max( $paged, $page ) );

	return $title;
}
add_filter( 'wp_title', 'my_wp_title', 10, 2 );

/**
 * Remove query strings from static resources
 */
function remove_query_strings( $src ) {

	$parts = explode( '?ver', $src );
	return $parts[0];

}
add_filter( 'script_loader_src', 'remove_query_strings', 15, 1 );
add_filter( 'style_loader_src', 'remove_query_strings', 15, 1 );

/**
 * Change login logo
 */
function login_logo() {

	echo '<style type="text/css">
		h1 a {
			background-image: url(' . get_template_directory_uri() . '/images/logo.png) !important;
		}

		.login form input,
		.login form input:focus {
			outline: none !important;
			box-shadow: none !important;
			border-color: none !important
		}

		.wp-core-ui .button-primary {
			background: #43AC6A;
			border-color: #358753;
		}

		.wp-core-ui .button-primary:hover,
		.wp-core-ui .button-primary:focus {
			background: #358753;
			outline: none !important;
			box-shadow: none !important;
			border-color: none !important
		}

	</style>';
}
add_action( 'login_head', 'login_logo' );


/**
 * Change login image URL
 */
function login_url() {

	return get_bloginfo( 'wpurl' );

}
add_filter( 'login_headerurl', 'login_url' );


/**
 * Change login url text
 */
function login_url_text() {

	return 'Flegg Pool League';
	
}
add_filter( 'login_headertitle', 'login_url_text' );


/**
 * Enqueue styles & scripts
 */
function print_front_styles() {

	wp_enqueue_style( 'fplleague-style', get_stylesheet_uri() );
	wp_enqueue_script( 'fplleague-app', get_template_directory_uri() . '/fplleague.js', array('jquery'), false, true );

}
add_action( 'wp_enqueue_scripts', 'print_front_styles' );

/**
 * Allow for ID to passed to team page
 */
function parameter_query_vars( $vars ) {

	$vars[] = 'id';
	return $vars;

}
add_filter( 'query_vars', 'parameter_query_vars' );

/**
 * Add rewrite rule for ID passed to team page
 */
function add_rewrite_rules( $rules ) {

	$newRules = array(
		'team/([^/]+)/?$' => 'index.php?pagename=team&id=$matches[1]',
		'division/([^/]+)/?$' => 'index.php?pagename=division&id=$matches[1]'
	);
	$rules = $newRules + $rules;
	return $rules;

}
add_filter( 'rewrite_rules_array', 'add_rewrite_rules' );
