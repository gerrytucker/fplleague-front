<?php
/**
 * Template Name: Team Template
 */
get_header();
?>

				<div class="row">

					<div class="large-12 columns">

						<?php
						if ( $wp_query->query_vars['id'] )
							$id_team = $wp_query->query_vars['id'];

						echo do_shortcode( '[fplleague id=' . $id_team . ' type=team]');
						?>

					</div>

				</div>

<?php get_footer(); ?>
