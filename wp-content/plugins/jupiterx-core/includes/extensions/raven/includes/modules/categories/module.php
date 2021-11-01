<?php

namespace JupiterX_Core\Raven\Modules\Categories;

defined( 'ABSPATH' ) || die();

use JupiterX_Core\Raven\Base\Module_base;

class Module extends Module_Base {

	public function get_widgets() {
		return [ 'categories' ];
	}

	public function __construct() {
		parent::__construct();

		add_action( 'wp_ajax_raven_categories_editor', [ $this, 'handle_editor' ] );
	}

	public static function get_taxonomy( $post_type ) {
		$taxonomy_map = [
			'blog' => 'category',
			'portfolio' => 'portfolio_category',
			'product' => 'product_cat',
		];

		$additional_valid_tax = [];
		$valid_post_type      = 'blog' === $post_type ? 'post' : $post_type;

		$taxonomies = get_object_taxonomies( $valid_post_type, 'object' );

		foreach ( $taxonomies as $taxonomy ) {
			$additional_valid_tax[] = $taxonomy->name;
		}

		$total_taxonomies = array_merge( [ $taxonomy_map[ $post_type ] ], $additional_valid_tax );

		$filtered_taxonomies = apply_filters( 'jupiterx_elements_categories_taxonomies', $total_taxonomies, $post_type );

		return $filtered_taxonomies;
	}

	public function handle_editor() {
		$post_type = filter_input( INPUT_POST, 'post_type' );

		$args = [
			'taxonomy' => self::get_taxonomy( $post_type ),
		];

		wp_send_json_success( get_terms( $args ) );
	}

}
