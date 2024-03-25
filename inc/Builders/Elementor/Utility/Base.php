<?php

namespace WPEssential\Plugins\ElementorBlocks\Builders\Elementor\Utility;

if ( ! \defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

use Elementor\Controls_Stack;
use Elementor\Plugin;
use Elementor\Widget_Base;
use WPEssential\Plugins\Builders\Fields\Hidden;
use WPEssential\Plugins\Builders\Fields\Select;
use WPEssential\Plugins\Helper\GetShortcodeBase;
use WPEssential\Plugins\Implement\Shortcodes;

abstract class Base extends Widget_Base
{
	use GetShortcodeBase;

	private $is_first_section = true;

	public function __construct ( $data = [], $args = null )
	{
		if ( ! ( $this instanceof Shortcodes ) ) {
			wp_die( __( 'Elementor element ' . $this->get_name() . ' has not interface.', 'wpessential' ) );
		}

		parent::__construct( $data, $args );

		add_action( 'elementor/widgets/widgets_registered', function () {
			$widget = \get_class( $this );
			Plugin::instance()->widgets_manager->register( new $widget() );
		} );

	}

	/**
	 * Get current skin ID.
	 *
	 * Retrieve the ID of the current skin.
	 *
	 * @return string Current skin.
	 * @since  1.0.0
	 * @access public
	 *
	 */
	public function get_current_skin_id ()
	{
		return $this->get_settings( 'wpe_skin_style' );
	}

	/**
	 * Start widget controls section.
	 *
	 * Used to add a new section of controls to the widget. Regular controls and
	 * skin controls.
	 *
	 * Note that when you add new controls to widgets they must be wrapped by
	 * `start_controls_section()` and `end_controls_section()`.
	 *
	 * @param string $section_id Section ID.
	 * @param array  $args       Section arguments Optional.
	 *
	 * @since  1.0.0
	 * @access public
	 *
	 */
	public function start_controls_section ( $section_id, array $args = [] )
	{
		parent::start_controls_section( $section_id, $args );

		if ( $this->is_first_section ) {
			$this->register_skin_control();

			$this->is_first_section = false;
		}
	}

	/**
	 * Register the Skin Control if the widget has skins.
	 *
	 * An internal method that is used to add a skin control to the widget.
	 * Added at the top of the controls section.
	 *
	 * @since  2.0.0
	 * @access private
	 */
	private function register_skin_control ()
	{
		$skins = $this->get_skins();
		if ( ! empty( $skins ) ) {
			$skin_options = [];

			if ( $this->_has_template_content ) {
				$skin_options[ '' ] = __( 'Default', 'wpessential-elementor-blocks' );
			}

			foreach ( $skins as $skin_id => $skin ) {
				$skin_options[ $skin_id ] = $skin->get_title();
			}

			// Get the first item for default value
			$default_value = array_keys( $skin_options );
			$default_value = array_shift( $default_value );

			if ( ! empty( $skin_options ) && 1 >= \count( $skin_options ) ) {
				$opt = Hidden::make( __( 'Skin', 'wpessential-elementor-blocks' ), 'style' );
				$opt->default( $default_value );
				$this->add_control( $opt->key, $opt->toArray() );
			}
			else {
				$opt = Select::make( __( 'Skin', 'wpessential-elementor-blocks' ), 'style' );
				$opt->default( $default_value );
				$opt->options( $skin_options );
				$this->add_control( $opt->key, $opt->toArray() );
			}
		}
	}

	/**
	 * Add widget render attributes.
	 *
	 * Used to add attributes to the current widget wrapper HTML tag.
	 *
	 * @since  1.0.0
	 * @access protected
	 */
	protected function add_render_attributes ()
	{
		parent::add_render_attributes();

		$settings = $this->get_settings();

		$this->add_render_attribute( '_wrapper', 'data-widget_type', $this->get_name() . '.' . wpe_array_get( $settings, wpe_editor_key( 'style', 'default' ) ) );
	}

}
