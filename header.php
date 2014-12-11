<!doctype html>
<!-- <html lang="en" class="no-js" manifest="<?php echo get_template_directory_uri() . '/appcache.manifest.php'; ?>"> -->
<html lang="en" class="no-js">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, minimal-ui">
		<meta name="apple-mobile-web-app-capable" content="yes">
		<!-- For non-Retina (@1× display) iPhone, iPod Touch, and Android 2.1+ devices: -->
		<link rel="apple-touch-icon" href="<?php echo get_template_directory_uri(); ?>/images/apple-touch-icon.png"><!-- 57×57px -->
		<!-- For the iPad mini and the first- and second-generation iPad (@1× display) on iOS ≤ 6: -->
		<link rel="apple-touch-icon" sizes="72x72" href="<?php echo get_template_directory_uri(); ?>/images/apple-touch-icon-72x72.png">
		<!-- For the iPad mini and the first- and second-generation iPad (@1× display) on iOS ≥ 7: -->
		<link rel="apple-touch-icon" sizes="76x76" href="<?php echo get_template_directory_uri(); ?>/images/apple-touch-icon-76x76.png">
		<!-- For iPhone with @2× display running iOS ≤ 6: -->
		<link rel="apple-touch-icon" sizes="114x114" href="<?php echo get_template_directory_uri(); ?>/images/apple-touch-icon-114x114.png">
		<!-- For iPhone with @2× display running iOS ≥ 7: -->
		<link rel="apple-touch-icon" sizes="120x120" href="<?php echo get_template_directory_uri(); ?>/images/apple-touch-icon-120x120.png">
		<!-- For iPad with @2× display running iOS ≤ 6: -->
		<link rel="apple-touch-icon" sizes="144x144" href="<?php echo get_template_directory_uri(); ?>/images/apple-touch-icon-144x144.png">
		<!-- For iPad with @2× display running iOS ≥ 7: -->
		<link rel="apple-touch-icon" sizes="152x152" href="<?php echo get_template_directory_uri(); ?>/images/apple-touch-icon-152x152.png">
		<!-- For iPhone 6 Plus with @3× display: -->
		<link rel="apple-touch-icon" sizes="180x180" href="<?php echo get_template_directory_uri(); ?>/images/apple-touch-icon-180x180.png">
		<link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/images/favicon.ico">
		<title><?php wp_title('|', true, 'right'); ?></title>

	<?php wp_head(); ?>
	</head>

	<body <?php body_class(); ?>>

        <div class="overlay"></div>

<?php if ( is_home() ): ?>
        
        <div class="splash fade-in">
            <h1 class="splash-title fade-in"><?php echo get_bloginfo('name'); ?></h1>
            <a href="#" class="splash-arrow fade-in">&nbsp;</a>
        </div>

<?php endif; ?>
        
        <header>
            
            <div class="row">
            
                <div class="large-6 columns">
                    
                    <h1><a class="title" href="<?php echo get_bloginfo('wpurl'); ?>"><?php echo get_bloginfo('name'); ?></a></h1>
                    
                </div>
                
                <div class="large-6 columns">
                    
                    <ul class="inline-list">
                        
<?php
    $pages = get_pages( array('sort_column' => 'menu_order', 'exclude' => array(116, 125) ) );
    foreach( $pages as $page ) :
?>
                        <li>
                        <?php if ( $page->post_name == 'teams' ) { ?>
                            <a class="teams-trigger toggle-on" href="#">Teams</a>
                        <?php } else { ?>
                            <a href="<?php echo get_page_link($page->ID); ?>"><?php echo $page->post_title; ?></a>
                        <?php } ?>
                        </li>
<?php                        
endforeach;

$db = new FPLLeague_Database;
$current_season = $db->get_current_season();
$divisions = $db->get_every_division( $current_season['id'] );

foreach( $divisions as $division ) :
	$division_url = get_bloginfo( 'wpurl' ) . '/division/' . $division['id'];
?>
                        <li>
                            <a href="<?php echo $division_url; ?>"><?php echo $division['name']; ?></a>
                        </li>

<?php endforeach ?>

                    </ul>
                    
                </div>
                
            </div>

        </header>
        
        <div id="teams">
            <div class="row">
                <div class="large-12 columns">
                    <?php echo do_shortcode('[fplleague id=999999 type=teams]'); ?>
                </div>
            </div>
        </div>

        <div id="main" class="row">

			<div class="content large-12 columns">
