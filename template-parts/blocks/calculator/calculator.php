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
$id = 'calculator-' . $block['id'];

if ( ! empty( $block['anchor'] ) ) {
	$id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'calculator';
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
	<h4>Vacation calculator</h4>
	<form>
		<div class="row g-3 align-items-center">
			<div class="col-auto">
				<input type="number" name="x1" class="form-control" min="0" value="1200">
			</div>
			<div class="col-auto">
				<select name="operator" class="form-select">
					<option value="minus">-</option>
					<option value="plus" selected>+</option>
					<option value="division">/</option>
					<option value="multiplication">*</option>
				</select>
			</div>
			<div class="col-auto">
				<input type="number" name="x2" class="form-control" min="0" value="1100">
			</div>
		</div>


		<?php wp_nonce_field( 'calculator', 'calculator_nonce' ); ?>
		<input type="hidden" name="action" value="calculator">

		<div class="fw-bold">Result: <span class="result">2300</span></div>
	</form>
</div>