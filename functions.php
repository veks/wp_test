<?php

defined( 'ABSPATH' ) || exit;

if ( ! function_exists( 'register_blocks' ) ) {
	function register_blocks() {

		// check function exists.
		if ( function_exists( 'acf_register_block_type' ) ) {

			// register block.
			acf_register_block_type(
				[
					'name'            => 'slider',
					'title'           => 'Slider',
					'description'     => 'Slider block',
					'render_template' => 'template-parts/blocks/slider/slider.php',
					'category'        => 'ACF',
					'icon'            => 'images-alt2',
					'enqueue_assets'  => function () {
						wp_enqueue_style( 'swiper-theme', 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css', [], '11' );
						wp_enqueue_script( 'swiper', 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js', [], '11', true );

						wp_enqueue_style( 'block-slider', get_template_directory_uri() . '/template-parts/blocks/slider/slider.css', [], '1.0.0' );
						wp_enqueue_script( 'block-slider', get_template_directory_uri() . '/template-parts/blocks/slider/slider.umd.js', [], '1.0.0', true );
					},
				]
			);

			acf_register_block_type(
				[
					'name'            => 'accordion',
					'title'           => 'Accordion',
					'description'     => 'Accordion block',
					'render_template' => 'template-parts/blocks/accordion/accordion.php',
					'category'        => 'ACF',
					'icon'            => 'editor-ol',
					'enqueue_assets'  => function () {
						wp_enqueue_style( 'houdini-theme', 'https://cdn.jsdelivr.net/gh/cferdinandi/houdini@11.0.4/dist/css/houdini.min.css', [], '11.0.4' );
						wp_enqueue_script( 'houdini', 'https://cdn.jsdelivr.net/gh/cferdinandi/houdini@11.0.4/dist/js/houdini.min.js', [], '11.0.4', true );
						wp_enqueue_script( 'houdini-polyfills', 'https://cdn.jsdelivr.net/gh/cferdinandi/houdini@11.0.4/dist/js/houdini.polyfills.min.js', [], '11.0.4', true );

						wp_enqueue_style( 'block-accordion', get_template_directory_uri() . '/template-parts/blocks/accordion/accordion.min.css', [], '1.0.0' );
						wp_enqueue_script( 'block-accordion', get_template_directory_uri() . '/template-parts/blocks/accordion/accordion.umd.min.js', [], '1.0.0', true );
					},
				]
			);

			acf_register_block_type(
				[
					'name'            => 'calculator',
					'title'           => 'Calculator',
					'description'     => 'Calculator block',
					'render_template' => 'template-parts/blocks/calculator/calculator.php',
					'category'        => 'ACF',
					'icon'            => 'calculator',
					//'supports'        => [ 'mode' => false ],
					'enqueue_assets'  => function () {
						wp_register_script( 'block-calculator', get_template_directory_uri() . '/template-parts/blocks/calculator/calculator.umd.min.js', [], '1.0.0', true );
						wp_localize_script( 'block-calculator', 'block_calculator', [ 'ajaxUrl' => admin_url( 'admin-ajax.php' ), ] );
						wp_enqueue_script( 'block-calculator' );
					},
				]
			);
		}
	}

	add_action( 'acf/init', 'register_blocks' );
}

if ( ! function_exists( 'add_enqueue_scripts' ) ) {
	function add_enqueue_scripts() {
		wp_enqueue_style(
			'bootstrap',
			'https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css',
			false,
			'5.3.3'
		);

	}
}

add_action( 'wp_enqueue_scripts', 'add_enqueue_scripts' );

if ( ! function_exists( 'setup_theme' ) ) {
	function setup_theme() {
		register_nav_menus(
			[
				'header-nav-menu' => 'Menu',
			]
		);

		// Add support for editor styles.
		add_theme_support( 'editor-styles' );
		add_editor_style( [ 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css' ] );
	}

	add_action( 'after_setup_theme', 'setup_theme' );
}

if ( ! function_exists( 'ajax_calculator' ) ) {
	function ajax_calculator() {
		if ( isset( $_POST['calculator_nonce'] ) && wp_verify_nonce( $_POST['calculator_nonce'], 'calculator' ) ) {
			if ( ! empty( $_POST ) && isset( $_POST['x1'] ) && isset( $_POST['x2'] ) && isset( $_POST['operator'] ) ) {
				$x1      = intval( sanitize_text_field( wp_unslash( $_POST['x1'] ) ) );
				$x2      = intval( sanitize_text_field( wp_unslash( $_POST['x2'] ) ) );
				$methods = [ 'minus', 'plus', 'division', 'multiplication' ];
				$method  = sanitize_text_field( wp_unslash( $_POST['operator'] ) );

				if ( in_array( $method, $methods, true ) ) {
					switch ( $method ) {
						case 'plus':
							$result = $x1 + $x2;
							break;
						case 'minus':
							$result = $x1 - $x2;
							break;
						case 'division':
							$result = $x1 / $x2;
							break;
						case 'multiplication':
							$result = $x1 * $x2;
							break;
						default:
							$result = 0;
							break;
					}

					wp_send_json_success( [ 'result' => ceil( $result ) ]
					);
				} else {
					wp_send_json_error( [ 'message' => 'Error calculation methods' ] );
				}
			} else {
				wp_send_json_error( [ 'message' => 'Error form data' ] );
			}
		}
	}

	if ( wp_doing_ajax() ) {
		add_action( 'wp_ajax_nopriv_calculator', 'ajax_calculator' );
		add_action( 'wp_ajax_calculator', 'ajax_calculator' );
	}
}


