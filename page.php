<?php get_header(); ?>
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
			<?php

			while ( have_posts() ) : the_post();
				the_post();

				echo '<h1 class="mb-5">' . get_the_title() . '</h1>';

				the_content();
			endwhile;
			?>
		</main>
		<?php get_sidebar( 'content-bottom' ); ?>
	</div>

<?php get_footer(); ?>