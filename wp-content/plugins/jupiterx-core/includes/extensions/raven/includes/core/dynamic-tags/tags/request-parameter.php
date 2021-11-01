<?php
namespace JupiterX_Core\Raven\Core\Dynamic_Tags\Tags;

use Elementor\Core\DynamicTags\Tag;
use Elementor\Modules\DynamicTags\Module;

defined( 'ABSPATH' ) || die();

class Request_Parameter extends Tag {
	public function get_name() {
		return 'request-arg';
	}

	public function get_title() {
		return __( 'Request Parameter', 'jupiterx-core' );
	}

	public function get_group() {
		return 'site';
	}

	public function get_categories() {
		return [
			Module::TEXT_CATEGORY,
			Module::POST_META_CATEGORY,
		];
	}

	protected function _register_controls() {
		$this->add_control(
			'request_type',
			[
				'label' => __( 'Type', 'jupiterx-core' ),
				'type'  => 'select',
				'default' => 'get',
				'options' => [
					'get' => __( 'Get', 'jupiterx-core' ),
					'post' => __( 'Post', 'jupiterx-core' ),
					'query_var' => __( 'Query Var', 'jupiterx-core' ),
				],
			]
		);

		$this->add_control(
			'param_name',
			[
				'label' => __( 'Parameter Name', 'jupiterx-core' ),
				'type'  => 'text',
			]
		);
	}

	public function render() {
		$settings     = $this->get_settings();
		$request_type = $settings['request_type'];
		$param_name   = $settings['param_name'];
		$value        = '';

		if ( empty( $request_type ) || empty( $param_name ) ) {
			return;
		}

		switch ( $request_type ) {
			case 'get':
				$value = filter_input( INPUT_GET, $param_name );
				break;
			case 'post':
				$value = filter_input( INPUT_POST, $param_name );
				break;
			case 'query_var':
				$value = get_query_var( $param_name );
				break;
		}

		echo htmlentities( wp_kses_post( $value ) );
	}
}
