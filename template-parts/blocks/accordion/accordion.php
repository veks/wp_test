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
$id = 'accordion-' . $block['id'];

if ( ! empty( $block['anchor'] ) ) {
	$id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'accordions';
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
	<?php if ( have_rows( 'accordion' ) ): ?>
		<div class="accordions">
			<?php $key = 0; ?>
			<?php while ( have_rows( 'accordion' ) ): the_row();
				$title  = get_sub_field( 'title' );
				$text   = get_sub_field( 'text' );
				$active = get_sub_field( 'active' ) ? ' is-expanded' : '';
				?>
				<h3 data-houdini-toggle="accordion-key-<?php echo $key; ?>" class="accordion-title"><?php echo $title; ?></h3>
				<div class="accordion<?php echo $active; ?>" id="accordion-key-<?php echo $key; ?>">
					<?php echo $text; ?>
				</div>

				<?php $key ++; ?>
			<?php endwhile; ?>
		</div>
	<?php else: ?>
		<p>Please add some accordions.</p>
	<?php endif; ?>
</div>