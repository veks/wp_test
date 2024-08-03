<?php get_header(); ?>

	<div class="container">

		<div class="row">

			<div class="col-12">

				<?php
				if ( have_posts() ) {
					while ( have_posts() ) {

						the_post();

						echo '<h1 class="mb-5">' . get_the_title() . '</h1>';

						the_content();


					}
				} else {
					echo 'content none';
				}
				?>

			</div>

		</div>

	</div>
<?php get_footer(); ?>