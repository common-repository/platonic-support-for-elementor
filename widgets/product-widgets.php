<?php

class Elementor_Products_Widget extends \Elementor\Widget_Base {

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
		return 'productplatonic';
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
		return __( 'Products Platonic', 'plugin-name' );
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
				'label' => __( 'Content', 'plugin-name' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'products_title_top',
			[
				'label' => esc_html__( 'Top Heading', 'elementor-platonic' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Default title', 'elementor-platonic' ),
				'placeholder' => esc_html__( 'Type your title here', 'elementor-platonic' ),
			]
		);




		$this->add_control(
			'products_image_dimension',
			[
				'label' => esc_html__( 'Select the image below the title', 'elementor-platonic' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
		);


		$repeater = new \Elementor\Repeater();


		$repeater->add_control(
			'products_image', [
				'label' => esc_html__( 'Choose Image', 'elementor-platonic' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
		);

		$repeater->add_control(
			'products_link',
			[
				'label' => esc_html__( 'URL', 'elementor-platonic' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'input_type' => 'url',
				'placeholder' => esc_html__( 'https://your-link.com', 'elementor-platonic' ),
			]
		);

		$repeater->add_control(
			'products_title', [
				'label' => esc_html__( 'Title', 'elementor-platonic' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'List Title' , 'elementor-platonic' ),
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'products_price', [
				'label' => esc_html__( 'Price', 'elementor-platonic' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Default title', 'elementor-platonic' ),
				'placeholder' => esc_html__( 'Type your title here', 'elementor-platonic' ),
			]
		);


		$this->add_control(
			'oneproducts',
			[
				'label' => esc_html__( 'Products', 'elementor-platonic' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'title_field' => '{{{ products_title }}}',
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
            <div class="elem_shop_posts_woo">
                
                <header class="woocommerce-products-header">
                        <h2 class="woocommerce-products-header__title page-title"><?php echo esc_attr($settings['products_title_top']); ?></h2>
						<span class="separator">
							<img  src="<?php echo $settings['products_image_dimension']['url']; ?>"  alt="">
						</span>
                </header>
                    
                <div class="story_blog_archive grid">
                    <div class="position_part_content">
                        <div class="block_container grid">
                            <div class="content_holder">
                                <div class="woocom_shop_single">
									<ul class="products columns-3">

										<?php $pproducts = $settings['oneproducts'];
									
											foreach( $pproducts as $product ){ ?>
	

												<li class="product type-product">
													<a href="<?php echo esc_url($product['products_link']); ?>" class="woocommerce-LoopProduct-link woocommerce-loop-product__link">
														<img class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail" src="<?php echo esc_url($product['products_image']['url']); ?>"  alt="">
														<h4 class="woocommerce-loop-product__title"><?php echo esc_attr($product['products_title']); ?></h4>
														<span class="price">
															<span class="woocommerce-Price-amount amount">
																<bdi>
																	<span class="woocommerce-Price-currencySymbol">$</span>
																	<?php echo esc_attr($product['products_price']); ?>
																</bdi>
															</span>
														</span>
													</a>
													<a href="<?php echo esc_url($product['products_link']); ?>" class="button product_type_simple add_to_cart_button ajax_add_to_cart"><?php esc_attr_e('Add to cart', 'elementor-platonic'); ?></a> 
												</li>

										<?php } ?>

									</ul>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
											

        <?php
	}
}