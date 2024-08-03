<?php

/**
 * Slider Block Template.
 *
 * @param array        $block      The block settings and attributes.
 * @param string       $content    The block inner HTML (empty).
 * @param bool         $is_preview True during AJAX preview.
 * @param (int|string) $post_id    The post ID this block is saved to.
 */

//echo '<pre>' . print_r( $block, true ) . '</pre>';

// Create id attribute allowing for custom "anchor" value.
$id = 'slider-' . $block['id'];

if ( ! empty( $block['anchor'] ) ) {
	$id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'slider';
if ( ! empty( $block['className'] ) ) {
	$className .= ' ' . $block['className'];
}
if ( ! empty( $block['align'] ) ) {
	$className .= ' align' . $block['align'];
}
if ( $is_preview ) {
	$className .= ' is-admin';
}

?>
<div id="<?php echo esc_attr( $id ); ?>" class="<?php echo esc_attr( $className ); ?>">
	<?php if ( have_rows( 'slides' ) ): ?>
		<div class="swiper">
			<div class="swiper-wrapper">
				<!-- Slides -->
				<?php while ( have_rows( 'slides' ) ): the_row();
					$image = get_sub_field( 'image' );
					$text = get_sub_field( 'text' );
					?>
					<div class="swiper-slide">
						<?php echo wp_get_attachment_image( $image['id'], 'full' ); ?>
						<div class="text"><?php echo $text; ?></div>
					</div>
				<?php endwhile; ?>
				...
			</div>
			<div class="swiper-pagination"></div>

			<div class="swiper-button-prev"></div>
			<div class="swiper-button-next"></div>
		</div>
	<?php else: ?>
		<p>Please add some slides.</p>
	<?php endif; ?>
</div>