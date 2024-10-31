<?php

class Elementor_Sale_Widget extends \Elementor\Widget_Base {

	/**
	 * Get widget name.
	 *
	 * Retrieve oEmbed widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'saleplatonic';
	}

	/**
	 * Get widget title.
	 *
	 * Retrieve oEmbed widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return esc_html__( 'Sale Platonic', 'plugin-name' );
	}

	/**
	 * Get widget icon.
	 *
	 * Retrieve oEmbed widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'fa fa-product-hunt';
	}

	/**
	 * Get widget categories.
	 *
	 * Retrieve the list of categories the oEmbed widget belongs to.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return array Widget categories.
	 */
	public function get_categories() {
		return [ 'general' ];
	}

	/**
	 * Register oEmbed widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function _register_controls() {

		$this->start_controls_section(
			'content_section',
			[
				'label' => esc_html__( 'Content', 'plugin-name' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

        $this->add_control(
			'sale_image',
			[
				'label' => esc_html__( 'Select the image below the title', 'elementor-platonic' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
		);

        $this->add_control(
			'sale_link',
			[
				'label' => esc_html__( 'URL', 'elementor-platonic' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'input_type' => 'url',
				'placeholder' => esc_html__( 'https://your-link.com', 'elementor-platonic' ),
			]
		);

		$this->add_control(
			'sale_title',
			[
				'label' => esc_html__( 'Title', 'elementor-platonic' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Default title', 'elementor-platonic' ),
				'label_block' => true,
			]
		);

        $this->add_control(
			'sale_title_sub', [
				'label' => esc_html__( 'Title', 'elementor-platonic' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Default title' , 'elementor-platonic' ),
				'label_block' => true,
			]
		);


		$this->end_controls_section();

	}

	/**
	 * Render oEmbed widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {

		$settings = $this->get_settings_for_display();



        ?>  
            <div class="elem_sale_container">
                <div class="animate_img">
					<img  src="<?php echo esc_url($settings['sale_image']['url']); ?>"  alt="">
				</div>

				<div class="sale_content">
			
					<div class="sale_column">
						<a href="<?php echo esc_url($settings['sale_link']); ?>" class="sale_title_link">
							<div class="column-inner">
								<div class="column_wrapper">
									<div class="text_column">
										<h2 class="sale_header_title"><?php echo platonic_wp_kses($settings['sale_title']); ?></h2>
										<span class="sale_title_two"><?php echo platonic_wp_kses($settings['sale_title_sub']); ?></span>
									</div>
								</div>
							</div>
						</a>
					</div>

				</div>
                
			</div>
											
        <?php
	}
}