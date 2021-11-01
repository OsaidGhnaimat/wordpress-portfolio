<?php
namespace JupiterX_Core\Raven\Modules\Post_Content\Widgets;

use JupiterX_Core\Raven\Base\Base_Widget;
use JupiterX_Core\Raven\Modules\Post_Content\Skins;
use Elementor\Plugin;
use Elementor\Core\Base\Document;

defined( 'ABSPATH' ) || die();

class Post_Content extends Base_Widget {

	protected $_has_template_content = false;

	public function get_name() {
		return 'raven-post-content';
	}

	public function get_title() {
		return __( 'Post Content', 'jupiterx-core' );
	}

	public function get_icon() {
		return 'raven-element-icon raven-element-icon-post-content';
	}

	protected function _register_controls() {
		$this->start_controls_section(
			'section_settings',
			[
				'label' => __( 'Settings', 'jupiterx-core' ),
				'description' => __( 'No settings available.', 'jupiterx-core' ),
			]
		);

		$this->add_control(
			'help',
			[
				'type' => 'raw_html',
				'raw' => __( 'No settings available', 'jupiterx-core' ),
			]
		);

		$this->end_controls_section();
	}

	public function show_in_panel() {
		$post = get_post();

		if ( empty( $post ) ) {
			return false;
		}

		$documents_manager = Plugin::instance()->documents;
		$doc_type          = get_post_meta( $post->ID, Document::TYPE_META_KEY, true );
		$doc_types         = $documents_manager->get_document_types();

		if ( empty( $doc_type ) || ! is_array( $doc_types ) || ! isset( $doc_types[ $doc_type ] ) ) {
			return false;
		}

		return 'single' === $doc_type;
	}

	/**
	 * * @SuppressWarnings(PHPMD.CyclomaticComplexity)
	 */
	public function render() {
		static $did_posts = [];

		$post = get_post();

		// Avoid recursion
		if ( isset( $did_posts[ $post->ID ] ) ) {
			return;
		}

		$did_posts[ $post->ID ] = true;

		if ( post_password_required( $post->ID ) ) {
			echo get_the_password_form( $post->ID );

			return;
		}

		if ( Plugin::instance()->preview->is_preview_mode( $post->ID ) ) {
			$content = Plugin::instance()->preview->builder_wrapper( '' );
		} else {
			$documents_manager = Plugin::instance()->documents;
			$document          = $documents_manager->get( $post->ID );

			if ( $document ) {
				$preview_type = $document->get_settings( 'preview_type' );
				$preview_id   = $document->get_settings( 'preview_id' );

				if ( 0 === strpos( $preview_type, 'single' ) && ! empty( $preview_id ) ) {
					$post = get_post( $preview_id );

					if ( ! $post ) {
						return;
					}
				}
			}

			$editor = Plugin::instance()->editor;

			$is_edit_mode = $editor->is_edit_mode();

			if ( $is_edit_mode ) {
				esc_html_e( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'jupiterx-core' );
				return;
			}

			$editor->set_edit_mode( false );

			$content = Plugin::instance()->frontend->get_builder_content( $post->ID, true );

			$editor->set_edit_mode( $is_edit_mode );

			if ( empty( $content ) ) {
				Plugin::instance()->frontend->remove_content_filter();

				setup_postdata( $post );

				$content = apply_filters( 'the_content', get_the_content() );

				Plugin::instance()->frontend->add_content_filter();
			} else {
				$content = apply_filters( 'the_content', $content );
			}
		}

		echo $content;
	}

	public function render_plain_content() {}
}
