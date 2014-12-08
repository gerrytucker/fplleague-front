<?php get_header(); ?>

				<div class="row">

					<div class="large-12 columns">

						<?php while(have_posts()): the_post(); ?>
                        
                            <?php the_title(); ?>
                        
                            <?php the_content(); ?>
                        
						<?php endwhile; ?>

					</div>

				</div>

<?php get_footer(); ?>
