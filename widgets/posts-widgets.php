<?php
/**
 * Elementor posts Widget.
 *
 * Elementor widget that inserts an embbedable content into the page, from any given URL.
 *
 * @since 1.0.0
 */
class Elementor_Posts_Widget extends \Elementor\Widget_Base {

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
		return 'postsplatonic';
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
		return __( 'Posts Platonic', 'plugin-name' );
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
		return 'fa fa-code';
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
			'posts_title_top',
			[
				'label' => esc_html__( 'Top Heading', 'elementor-platonic' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Default title', 'elementor-platonic' ),
				'placeholder' => esc_html__( 'Type your title here', 'elementor-platonic' ),
			]
		);




		$this->add_control(
			'posts_image_dimension',
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
			'posts_image', [
				'label' => esc_html__( 'Choose Image', 'elementor-platonic' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
		);

		$repeater->add_control(
			'posts_link',
			[
				'label' => esc_html__( 'URL', 'elementor-platonic' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'input_type' => 'url',
				'placeholder' => esc_html__( 'https://your-link.com', 'elementor-platonic' ),
			]
		);

		$repeater->add_control(
			'posts_title', [
				'label' => esc_html__( 'Title', 'elementor-platonic' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'List Title' , 'elementor-platonic' ),
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'posts_content', [
				'label' => esc_html__( 'Content', 'elementor-platonic' ),
				'type' => \Elementor\Controls_Manager::WYSIWYG,
				'default' => esc_html__( 'List Content' , 'elementor-platonic' ),
				'show_label' => false,
			]
		);



		$this->add_control(
			'onepost',
			[
				'label' => esc_html__( 'Posts', 'elementor-platonic' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'title_field' => '{{{ posts_title }}}',
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
		
			<div class="elem_posts_container">

				<header class="woocommerce-products-header">
						<h2 class="woocommerce-products-header__title page-title"><?php echo platonic_wp_kses($settings['posts_title_top']); ?></h2>
						<span class="separator">
							<img  src="<?php echo esc_url($settings['posts_image_dimension']['url']); ?>"  alt="">
						</span>
				</header>

				<div class="blog_content_sidebar grid">
					<div class="page_content_home">
						<div class="sport_list grid">
							<?php $ppposts = $settings['onepost'];
							
								foreach( $ppposts as $pppost ){ ?>

									<div class="item_sport wow fadeInUp">
										<div class="mask_hover">
											<!-- Post Thumbnail -->
											<div class="image_sport">
												<a href="<?php echo esc_url($pppost['posts_link']); ?>">
													<img  src="<?php echo esc_url($pppost['posts_image']['url']); ?>" alt="">
												</a>
											</div>


											
											
											<div class="sport_info">
												
												<!-- Post Header -->
												<div class="post-header">
													<!-- Category -->
													<div class="info_cat"><?php the_category(', '); ?></div> 
													<!-- Title -->
													<h4 class="name">
															<a href="<?php echo esc_url($pppost['posts_link']); ?>">
																<?php echo esc_attr($pppost['posts_title']); ?>
															</a>
													</h4>
													<div class="post_author_date">
												
														<!-- Date -->
														<span class="post_date"><?php echo get_the_date(); ?></span>
													</div>
												</div>

												<!-- Content -->
												<div class="content"><?php echo platonic_wp_kses($pppost['posts_content']); ?></div>

												<!-- More -->
												<div class="read_more">
													<a href="<?php echo esc_url($pppost['posts_link']); ?>"><?php esc_attr_e('Read More', 'elementor-platonic'); ?></a>
												</div>
											</div>
										</div>
									</div>

							<?php } ?>


						</div>
					</div>
				</div>
			</div> 

        <?php
	}
}