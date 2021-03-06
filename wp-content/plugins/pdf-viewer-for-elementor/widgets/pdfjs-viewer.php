<?php
namespace ElementorPDFViewer\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Elementor Hello World
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class Elementor_PDFjs_Viewer extends Widget_Base {

	/**
	 * Retrieve the widget name.
	 *
	 * @since 1.1.0
	 *
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'pdfjs_viewer';
	}

	/**
	 * Retrieve the widget title.
	 *
	 * @since 1.1.0
	 *
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( 'PDFjs Viewer', 'elementor' );
	}

	/**
	 * Retrieve the widget icon.
	 *
	 * @since 1.1.0
	 *
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'fa fa-file-pdf-o';
	}

	/**
	 * Retrieve the list of categories the widget belongs to.
	 *
	 * Used to determine where to display the widget in the editor.
	 *
	 * Note that currently Elementor supports only one category.
	 * When multiple categories passed, Elementor uses the first one.
	 *
	 * @since 1.1.0
	 *
	 * @access public
	 *
	 * @return array Widget categories.
	 */
	public function get_categories() {
		return [ 'basic' ];
	}
	
	
	/**
	 * Register the widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.1.0
	 *
	 * @access protected
	 */
	protected function _register_controls() {		
		$this->start_controls_section(
			'pdf_viewer_docs',
			[
				'label' => __( 'PDFjs Viewer', 'elementor' ),
			]
		);

		$this->add_control(
			'pdfjs_file',
			[
				'label' => __( 'Choose PDF', 'elementor' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'media_type' => 'application/pdf',
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
				'dynamic' => [
					'active' => true,
				],
			]
		);


		$this->add_control(
			'width',
			[
				'label' => __( 'Width', 'elementor' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ '%', 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1500,
						'step' => 5,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 640,
				],
			]
		);

		$this->add_control(
			'height',
			[
				'label' => __( 'Height', 'elementor' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ '%', 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1500,
						'step' => 5,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 1020,
				],
			]
		);

		$this->add_control(
			'text_align',
			[
				'label' => __( 'Alignment', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => __( 'Left', 'plugin-domain' ),
						'icon' => 'fa fa-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'plugin-domain' ),
						'icon' => 'fa fa-align-center',
					],
					'right' => [
						'title' => __( 'Right', 'plugin-domain' ),
						'icon' => 'fa fa-align-right',
					],
				],
				'default' => 'center',

				'toggle' => true,
			]
		);
		
		
		$this->end_controls_section();


	}

	/**
	 * Render the widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.1.0
	 *
	 * @access protected
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();

		$align = 'display: block; margin-left: auto; margin-right: auto;';
		
		if ($settings['text_align'] === 'left') {
			$align = 'display: block; float: left;';
		}
		if ($settings['text_align'] === 'right') {
			$align = 'display: block; float: right;';
		}
		if (isset($settings['width'])) {
			$width = ' width: ' . $settings['width']['size'] . $settings['width']['unit'] . ';';
		}
		if (isset($settings['height'])) {
			$height = ' height: ' . $settings['height']['size'] . $settings['height']['unit'] . ';';
		}

		if (isset($settings['pdfjs_file']['url'])) {
			$pdf_url = $settings['pdfjs_file']['url'];
		}
		
		echo '<iframe src="' . plugins_url(). '/pdf-viewer-for-elementor/assets/pdfjs/web/viewer.html?file=' . $pdf_url . '&amp;embedded=true" style="' . $align . $width . $height . '" frameborder="1" marginheight="0px" marginwidth="0px" allowfullscreen></iframe>';

	}

}

