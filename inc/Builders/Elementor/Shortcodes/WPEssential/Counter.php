<?php

namespace WPEssential\Plugins\ElementorBlocks\Builders\Elementor\Shortcodes\WPEssential;

if (!\defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

use Elementor\Controls_Manager;
use WPEssential\Plugins\Builders\Fields\Choose;
use WPEssential\Plugins\Builders\Fields\PopoverToggle;
use WPEssential\Plugins\Builders\Fields\Select;
use WPEssential\Plugins\Builders\Fields\Textarea;
use WPEssential\Plugins\Builders\Fields\Typography;
use WPEssential\Plugins\Builders\Fields\Url;
use WPEssential\Plugins\ElementorBlocks\Builders\Elementor\Utility\Base;
use WPEssential\Plugins\Implement\Shortcodes;

use Elementor\Core\Kits\Documents\Tabs\Global_Colors;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;
use WPEssential\Plugins\Builders\Fields\Switcher;
use WPEssential\Plugins\Builders\Fields\Wysiwyg;


class Counter extends Base implements Shortcodes
{
	/**
	 * Set widget skings.
	 *
	 * @return string $skins_list name.
	 * @access public
	 * @public
	 */
	public $skins_list = [];

	/**
	 * Set widget keywords.
	 * Retrieve widget keywords.
	 *
	 * @return array Widget keywords.
	 * @access public
	 * @since  1.0.0
	 * @public
	 */
	public function set_keywords()
	{
		return ['counter', 'title', 'text'];
	}

	public function set_widget_icon()
	{
		return 'eicon-counter-circle';
	}
	/**
	 * Register widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since  1.0.0
	 * @access public
	 */
	public function register_controls()
	{

		$this->start_controls_section(
			'wpe_st_title_style',
			[
				'label' => esc_html__('Title', 'wpessential-elementor-blocks'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->title_style();
		$this->end_controls_section();

		$this->start_controls_section(
			'wpe_st_number_style',
			[
				'label' => esc_html__('Number', 'wpessential-elementor-blocks'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->number_style();
		$this->end_controls_section();


	}

	/**
	 * Render widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since  1.0.0
	 * @access public
	 */
	public function render()
	{

	}


	private function title_style()
	{

		$this->start_controls_tabs('tabs_title_style'); /* this will create a tab in which we can make two tabs 
normal and hover*/
		// for normal controls 
		$this->start_controls_tab(
			'tab_title_normal',
			[
				'label' => esc_html__('Normal', 'wpessential-elementor-blocks'),
			]
		);


		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'wpe_st_title_background_normal',
				'types' => ['classic', 'gradient', 'video'],
				'selector' => '{{WRAPPER}} .wpe-text-editor title',
			]
		);


		$this->add_control(
			'wpe_st_title_color_normal',
			[
				'label' => esc_html__('Color', 'wpessential-elementor-blocks'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elementor-accordion-icon, {{WRAPPER}} .elementor-accordion-title' => 'color: {{VALUE}};',
					'{{WRAPPER}} .elementor-accordion-icon svg' => 'fill: {{VALUE}};',
				],
				'global' => [
					'default' => Global_Colors::COLOR_PRIMARY,
				],
			]
		);
		$this->add_control(
			'wpe_st_title_text_color_normal',
			[
				'label' => esc_html__('Text Color', 'wpessential-elementor-blocks'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .elementor-button' => 'fill: {{VALUE}}; color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'wpe_st_title_active_color_normal',
			[
				'label' => esc_html__('Active Color', 'wpessential-elementor-blocks'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elementor-active .elementor-accordion-icon, {{WRAPPER}} .elementor-active .elementor-accordion-title' => 'color: {{VALUE}};',
					'{{WRAPPER}} .elementor-active .elementor-accordion-icon svg' => 'fill: {{VALUE}};',
				],
				'global' => [
					'default' => Global_Colors::COLOR_ACCENT,
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'wpe_st_title_typograpgy_normal',
				'selector' => '{{WRAPPER}} .wpe-text-editor title',
			]
		);


		$this->add_group_control(
			\Elementor\Group_Control_Text_Stroke::get_type(),
			[
				'name' => 'wpe_st_title_text_stroke_normal',
				'selector' => '{{WRAPPER}} .wpe-text-editor title',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'wpe_st_title_shadow_normal',
				'selector' => '{{WRAPPER}} .wpe-text-editor title',
			]
		);

		$this->add_responsive_control(
			'wpe_st_title_padding_normal',
			[
				'label' => esc_html__('Padding', 'wpessential-elementor-blocks'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em', 'rem', 'vw', 'custom'],
				'selectors' => [
					'{{WRAPPER}} .wpe-text-editor title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'wpe_st_title_margin_normal',
			[
				'label' => esc_html__('Margin', 'wpessential-elementor-blocks'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em', 'rem', 'custom'],
				'range' => [
					'px' => [
						'min' => 10,
						'max' => 50,
						'step' => 5,
					],
					'em' => [
						'min' => 1,
						'max' => 5,
						'step' => 0.5,
					],
				],
				'default' => [
					'top' => 2,
					'right' => 0,
					'bottom' => 2,
					'left' => 0,
					'unit' => 'em',
					'isLinked' => false,
				],
				'selectors' => [
					'{{WRAPPER}} .wpe-text-editor title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'wpe_st_title_border_normal',
				'selector' => '{{WRAPPER}} .wpe-text-editor title',
			]

		);

		$this->add_control(
			'wpe_st_title_text_decoration_noraml',
			[
				'label' => esc_html__('Text Decoration', 'wpessential-elementor-blocks'),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'none' => esc_html__('None', 'wpessential-elementor-blocks'),
					'underline' => esc_html__('Underline', 'wpessential-elementor-blocks'),
					'overline' => esc_html__('Overline', 'wpessential-elementor-blocks'),
					'line-through' => esc_html__('Line Through', 'wpessential-elementor-blocks'),
				],
				'default' => 'none',
			]
		);
		$this->add_responsive_control(
			'wpe_st_title_alignment_normal',
			[
				'label' => esc_html__('Alignment', 'wpessential-elementor-blocks'),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => esc_html__('Left', 'wpessential-elementor-blocks'),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => esc_html__('Center', 'wpessential-elementor-blocks'),
						'icon' => 'eicon-text-align-center',
					],
					'right' => [
						'title' => esc_html__('Right', 'wpessential-elementor-blocks'),
						'icon' => 'eicon-text-align-right',
					],
					'justify' => [
						'title' => esc_html__('Justified', 'wpessential-elementor-blocks'),
						'icon' => 'eicon-text-align-justify',
					],
				],
				'default' => '',
				'selectors' => [
					'{{WRAPPER}}' => 'text-align: {{VALUE}};',
				],
			]
		);


		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'wpe_st_title_box_shadow_normal',
				'selector' => '{{WRAPPER}} .wpe-text-editor ',
			]
		);

		$this->add_control(
			'wpe_st_title_border_width_normal',
			[
				'label' => esc_html__('Border Width', 'wpessential-elementor-blocks'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px', '%', 'em', 'rem', 'vw', 'custom'],
				'range' => [
					'px' => [
						'max' => 20,
					],
					'em' => [
						'max' => 2,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-accordion-item' => 'border-width: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .elementor-accordion-item .elementor-tab-content' => 'border-width: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .elementor-accordion-item .elementor-tab-title.elementor-active' => 'border-width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'wpe_st_title_border_color_normal',
			[
				'label' => esc_html__('Border Color', 'wpessential-elementor-blocks'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elementor-accordion-item' => 'border-color: {{VALUE}};',
					'{{WRAPPER}} .elementor-accordion-item .elementor-tab-content' => 'border-top-color: {{VALUE}};',
					'{{WRAPPER}} .elementor-accordion-item .elementor-tab-title.elementor-active' => 'border-bottom-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab(); // normal tabs end here


		$this->start_controls_tab(   // hover tab starts here
			'wpe_st_tab_title_hover',
			[
				'label' => esc_html__('Hover', 'wpessential-elementor-blocks'),
			]
		);
		$this->add_control(
			'wpe_st_title_hover_animation_hover',
			[
				'label' => esc_html__('Hover Animation', 'wpessential-elementor-blocks'),
				'type' => Controls_Manager::HOVER_ANIMATION,
			]
		);

		$this->add_control(
			'wpe_st_title_text_color_hover',
			[
				'label' => esc_html__('Text Color', 'wpessential-elementor-blocks'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .elementor-button' => 'fill: {{VALUE}}; color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'wpe_st_title_color_hover',
			[
				'label' => esc_html__('Color', 'wpessential-elementor-blocks'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elementor-accordion-icon, {{WRAPPER}} .elementor-accordion-title' => 'color: {{VALUE}};',
					'{{WRAPPER}} .elementor-accordion-icon svg' => 'fill: {{VALUE}};',
				],
				'global' => [
					'default' => Global_Colors::COLOR_PRIMARY,
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Text_Stroke::get_type(),
			[
				'name' => 'wpe_st_title_text_stroke_hover',
				'selector' => '{{WRAPPER}} .wpe-text-editor title',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'wpe_st_title_shadow_hover',
				'selector' => '{{WRAPPER}} .wpe-text-editor title',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'wpe_st_title_background_hover',
				'types' => ['classic', 'gradient', 'video'],
				'selector' => '{{WRAPPER}} .wpe-text-editor title',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'wpe_st_title_border_hover',
				'selector' => '{{WRAPPER}} .wpe-text-editor title',
			]

		);


		$this->add_control(
			'wpe_st_title_text_decoration_hover',
			[
				'label' => esc_html__('Text Decoration', 'wpessential-elementor-blocks'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'none' => esc_html__('None', 'wpessential-elementor-blocks'),
					'underline' => esc_html__('Underline', 'wpessential-elementor-blocks'),
					'overline' => esc_html__('Overline', 'wpessential-elementor-blocks'),
					'line-through' => esc_html__('Line Through', 'wpessential-elementor-blocks'),
				],
				'default' => 'none',
			]
		);
		$this->add_responsive_control(
			'wpe_st_title_border_radius_hover',
			[
				'label' => esc_html__('Border Radius', 'wpessential-elementor-blocks'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em', 'rem', 'custom'],
				'selectors' => [
					'{{WRAPPER}} .wpe-text-editor a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'wpe_st_title_border_width_hover',
			[
				'label' => esc_html__('Border Width', 'wpessential-elementor-blocks'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px', '%', 'em', 'rem', 'vw', 'custom'],
				'range' => [
					'px' => [
						'max' => 20,
					],
					'em' => [
						'max' => 2,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-accordion-item' => 'border-width: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .elementor-accordion-item .elementor-tab-content' => 'border-width: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .elementor-accordion-item .elementor-tab-title.elementor-active' => 'border-width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'wpe_st_title_border_color_hover',
			[
				'label' => esc_html__('Border Color', 'wpessential-elementor-blocks'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elementor-accordion-item' => 'border-color: {{VALUE}};',
					'{{WRAPPER}} .elementor-accordion-item .elementor-tab-content' => 'border-top-color: {{VALUE}};',
					'{{WRAPPER}} .elementor-accordion-item .elementor-tab-title.elementor-active' => 'border-bottom-color: {{VALUE}};',
				],
			]
		);




		$this->end_controls_tab();

		$this->end_controls_tabs();


	}

	private function number_style()
	{

		$this->start_controls_tabs('tabs_number_style'); /* this will create a tab in which we can make two tabs 
normal and hover*/
		// for normal controls 
		$this->start_controls_tab(
			'tab_number_normal',
			[
				'label' => esc_html__('Normal', 'wpessential-elementor-blocks'),
			]
		);


		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'wpe_st_number_background_normal',
				'types' => ['classic', 'gradient', 'video'],
				'selector' => '{{WRAPPER}} .wpe-text-editor title',
			]
		);


		$this->add_control(
			'wpe_st_number_color_normal',
			[
				'label' => esc_html__('Color', 'wpessential-elementor-blocks'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elementor-accordion-icon, {{WRAPPER}} .elementor-accordion-title' => 'color: {{VALUE}};',
					'{{WRAPPER}} .elementor-accordion-icon svg' => 'fill: {{VALUE}};',
				],
				'global' => [
					'default' => Global_Colors::COLOR_PRIMARY,
				],
			]
		);
		$this->add_control(
			'wpe_st_number_text_color_normal',
			[
				'label' => esc_html__('Text Color', 'wpessential-elementor-blocks'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .elementor-button' => 'fill: {{VALUE}}; color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'wpe_st_number_active_color_normal',
			[
				'label' => esc_html__('Active Color', 'wpessential-elementor-blocks'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elementor-active .elementor-accordion-icon, {{WRAPPER}} .elementor-active .elementor-accordion-title' => 'color: {{VALUE}};',
					'{{WRAPPER}} .elementor-active .elementor-accordion-icon svg' => 'fill: {{VALUE}};',
				],
				'global' => [
					'default' => Global_Colors::COLOR_ACCENT,
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'wpe_st_number_typograpgy_normal',
				'selector' => '{{WRAPPER}} .wpe-text-editor title',
			]
		);


		$this->add_group_control(
			\Elementor\Group_Control_Text_Stroke::get_type(),
			[
				'name' => 'wpe_st_number_text_stroke_normal',
				'selector' => '{{WRAPPER}} .wpe-text-editor title',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'wpe_st_number_shadow_normal',
				'selector' => '{{WRAPPER}} .wpe-text-editor title',
			]
		);

		$this->add_responsive_control(
			'wpe_st_number_padding_normal',
			[
				'label' => esc_html__('Padding', 'wpessential-elementor-blocks'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em', 'rem', 'vw', 'custom'],
				'selectors' => [
					'{{WRAPPER}} .wpe-text-editor title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'wpe_st_number_margin_normal',
			[
				'label' => esc_html__('Margin', 'wpessential-elementor-blocks'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em', 'rem', 'custom'],
				'range' => [
					'px' => [
						'min' => 10,
						'max' => 50,
						'step' => 5,
					],
					'em' => [
						'min' => 1,
						'max' => 5,
						'step' => 0.5,
					],
				],
				'default' => [
					'top' => 2,
					'right' => 0,
					'bottom' => 2,
					'left' => 0,
					'unit' => 'em',
					'isLinked' => false,
				],
				'selectors' => [
					'{{WRAPPER}} .wpe-text-editor title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'wpe_st_number_border_normal',
				'selector' => '{{WRAPPER}} .wpe-text-editor title',
			]

		);

		$this->add_control(
			'wpe_st_number_text_decoration_noraml',
			[
				'label' => esc_html__('Text Decoration', 'wpessential-elementor-blocks'),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'none' => esc_html__('None', 'wpessential-elementor-blocks'),
					'underline' => esc_html__('Underline', 'wpessential-elementor-blocks'),
					'overline' => esc_html__('Overline', 'wpessential-elementor-blocks'),
					'line-through' => esc_html__('Line Through', 'wpessential-elementor-blocks'),
				],
				'default' => 'none',
			]
		);

		$this->add_responsive_control(
			'wpe_st_number_alignment_normal',
			[
				'label' => esc_html__('Alignment', 'wpessential-elementor-blocks'),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => esc_html__('Left', 'wpessential-elementor-blocks'),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => esc_html__('Center', 'wpessential-elementor-blocks'),
						'icon' => 'eicon-text-align-center',
					],
					'right' => [
						'title' => esc_html__('Right', 'wpessential-elementor-blocks'),
						'icon' => 'eicon-text-align-right',
					],
					'justify' => [
						'title' => esc_html__('Justified', 'wpessential-elementor-blocks'),
						'icon' => 'eicon-text-align-justify',
					],
				],
				'default' => '',
				'selectors' => [
					'{{WRAPPER}}' => 'text-align: {{VALUE}};',
				],
			]
		);


		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'wpe_st_number_box_shadow_normal',
				'selector' => '{{WRAPPER}} .wpe-text-editor ',
			]
		);

		$this->add_control(
			'wpe_st_number_border_width_normal',
			[
				'label' => esc_html__('Border Width', 'wpessential-elementor-blocks'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px', '%', 'em', 'rem', 'vw', 'custom'],
				'range' => [
					'px' => [
						'max' => 20,
					],
					'em' => [
						'max' => 2,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-accordion-item' => 'border-width: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .elementor-accordion-item .elementor-tab-content' => 'border-width: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .elementor-accordion-item .elementor-tab-title.elementor-active' => 'border-width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'wpe_st_number_border_color_normal',
			[
				'label' => esc_html__('Border Color', 'wpessential-elementor-blocks'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elementor-accordion-item' => 'border-color: {{VALUE}};',
					'{{WRAPPER}} .elementor-accordion-item .elementor-tab-content' => 'border-top-color: {{VALUE}};',
					'{{WRAPPER}} .elementor-accordion-item .elementor-tab-title.elementor-active' => 'border-bottom-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab(); // normal tabs end here


		$this->start_controls_tab(   // hover tab starts here
			'wpe_st_tab_number_hover',
			[
				'label' => esc_html__('Hover', 'wpessential-elementor-blocks'),
			]
		);
		$this->add_control(
			'wpe_st_number_hover_animation_hover',
			[
				'label' => esc_html__('Hover Animation', 'wpessential-elementor-blocks'),
				'type' => Controls_Manager::HOVER_ANIMATION,
			]
		);

		$this->add_control(
			'wpe_st_number_text_color_hover',
			[
				'label' => esc_html__('Text Color', 'wpessential-elementor-blocks'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .elementor-button' => 'fill: {{VALUE}}; color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'wpe_st_number_color_hover',
			[
				'label' => esc_html__('Color', 'wpessential-elementor-blocks'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elementor-accordion-icon, {{WRAPPER}} .elementor-accordion-title' => 'color: {{VALUE}};',
					'{{WRAPPER}} .elementor-accordion-icon svg' => 'fill: {{VALUE}};',
				],
				'global' => [
					'default' => Global_Colors::COLOR_PRIMARY,
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Text_Stroke::get_type(),
			[
				'name' => 'wpe_st_number_text_stroke_hover',
				'selector' => '{{WRAPPER}} .wpe-text-editor title',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'wpe_st_number_shadow_hover',
				'selector' => '{{WRAPPER}} .wpe-text-editor title',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'wpe_st_number_background_hover',
				'types' => ['classic', 'gradient', 'video'],
				'selector' => '{{WRAPPER}} .wpe-text-editor title',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'wpe_st_number_border_hover',
				'selector' => '{{WRAPPER}} .wpe-text-editor title',
			]

		);


		$this->add_control(
			'wpe_st_number_text_decoration_hover',
			[
				'label' => esc_html__('Text Decoration', 'wpessential-elementor-blocks'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'none' => esc_html__('None', 'wpessential-elementor-blocks'),
					'underline' => esc_html__('Underline', 'wpessential-elementor-blocks'),
					'overline' => esc_html__('Overline', 'wpessential-elementor-blocks'),
					'line-through' => esc_html__('Line Through', 'wpessential-elementor-blocks'),
				],
				'default' => 'none',
			]
		);
		$this->add_responsive_control(
			'wpe_st_number_border_radius_hover',
			[
				'label' => esc_html__('Border Radius', 'wpessential-elementor-blocks'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em', 'rem', 'custom'],
				'selectors' => [
					'{{WRAPPER}} .wpe-text-editor a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'wpe_st_number_border_width_hover',
			[
				'label' => esc_html__('Border Width', 'wpessential-elementor-blocks'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px', '%', 'em', 'rem', 'vw', 'custom'],
				'range' => [
					'px' => [
						'max' => 20,
					],
					'em' => [
						'max' => 2,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-accordion-item' => 'border-width: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .elementor-accordion-item .elementor-tab-content' => 'border-width: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .elementor-accordion-item .elementor-tab-title.elementor-active' => 'border-width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'wpe_st_number_border_color_hover',
			[
				'label' => esc_html__('Border Color', 'wpessential-elementor-blocks'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elementor-accordion-item' => 'border-color: {{VALUE}};',
					'{{WRAPPER}} .elementor-accordion-item .elementor-tab-content' => 'border-top-color: {{VALUE}};',
					'{{WRAPPER}} .elementor-accordion-item .elementor-tab-title.elementor-active' => 'border-bottom-color: {{VALUE}};',
				],
			]
		);




		$this->end_controls_tab();

		$this->end_controls_tabs();




	}
}
