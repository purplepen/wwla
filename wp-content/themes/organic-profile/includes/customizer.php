<?php
/**
* Theme customizer with real-time update
*
* Very helpful: http://ottopress.com/2012/theme-customizer-part-deux-getting-rid-of-options-pages/
*
* @package Profile
* @since Profile 2.0
*/
function profile_theme_customizer( $wp_customize ) {

	// Category Dropdown Control
	class Profile_Category_Dropdown_Control extends WP_Customize_Control {
	public $type = 'dropdown-categories';

	public function render_content() {
		$dropdown = wp_dropdown_categories(
				array(
					'name'              => '_customize-dropdown-categories-' . $this->id,
					'echo'              => 0,
					'show_option_none'  => __( '&mdash; Select &mdash;', 'organic-profile' ),
					'option_none_value' => '0',
					'selected'          => $this->value(),
				)
			);

			// Hackily add in the data link parameter.
			$dropdown = str_replace( '<select', '<select ' . $this->get_link(), $dropdown );

			printf( '<label class="customize-control-select"><span class="customize-control-title">%s</span> %s</label>',
				$this->label,
				$dropdown
			);
		}
	}
	
	// Numerical Control
	class Profile_Customizer_Number_Control extends WP_Customize_Control {
	
		public $type = 'number';
		
		public function render_content() {
			?>
			<label>
			<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
			<input type="number" <?php $this->link(); ?> value="<?php echo intval( $this->value() ); ?>" />
			</label>
			<?php
		}
	
	}
	
	function profile_sanitize_categories( $input ) {
		$categories = get_terms( 'category', array('fields' => 'ids', 'get' => 'all') );
		
		if ( in_array( $input, $categories ) ) {
		    return $input;
		} else {
			return '';
		}
	}
	
	function profile_sanitize_pages( $input ) {
		$pages = get_all_page_ids();
	 
	    if ( in_array( $input, $pages ) ) {
	        return $input;
	    } else {
	    	return '';
	    }
	}
	
	function profile_sanitize_transition_interval( $input ) {
	    $valid = array(
	        '2000' 		=> __( '2 Seconds', 'organic-profile' ),
	        '4000' 		=> __( '4 Seconds', 'organic-profile' ),
	        '6000' 		=> __( '6 Seconds', 'organic-profile' ),
	        '8000' 		=> __( '8 Seconds', 'organic-profile' ),
	        '10000' 	=> __( '10 Seconds', 'organic-profile' ),
	        '12000' 	=> __( '12 Seconds', 'organic-profile' ),
	        '20000' 	=> __( '20 Seconds', 'organic-profile' ),
	        '30000' 	=> __( '30 Seconds', 'organic-profile' ),
	        '60000' 	=> __( '1 Minute', 'organic-profile' ),
	        '999999999'	=> __( 'Hold Frame', 'organic-profile' ),
	    );
	 
	    if ( array_key_exists( $input, $valid ) ) {
	        return $input;
	    } else {
	        return '';
	    }
	}
	
	function profile_sanitize_transition_style( $input ) {
	    $valid = array(
	        'fade' 		=> __( 'Fade', 'organic-profile' ),
	        'slide' 	=> __( 'Slide', 'organic-profile' ),
	    );
	 
	    if ( array_key_exists( $input, $valid ) ) {
	        return $input;
	    } else {
	        return '';
	    }
	}
	
	function profile_sanitize_columns( $input ) {
	    $valid = array(
	        'one' 		=> __( 'One Column', 'organic-profile' ),
	        'two' 		=> __( 'Two Columns', 'organic-profile' ),
	        'three' 	=> __( 'Three Columns', 'organic-profile' ),
	    );
	 
	    if ( array_key_exists( $input, $valid ) ) {
	        return $input;
	    } else {
	        return '';
	    }
	}
	
	function profile_sanitize_align( $input ) {
	    $valid = array(
	        'left' 		=> __( 'Left Align', 'organic-profile' ),
	        'center' 		=> __( 'Center Align', 'organic-profile' ),
	        'right' 	=> __( 'Right Align', 'organic-profile' ),
	    );
	 
	    if ( array_key_exists( $input, $valid ) ) {
	        return $input;
	    } else {
	        return '';
	    }
	}
	
	function profile_sanitize_title_color( $input ) {
	    $valid = array(
	        'black' 	=> __( 'Black', 'organic-profile' ),
	        'white' 	=> __( 'White', 'organic-profile' ),
	    );
	 
	    if ( array_key_exists( $input, $valid ) ) {
	        return $input;
	    } else {
	        return '';
	    }
	}
	
	function profile_sanitize_checkbox( $input ) {
		if ( $input == 1 ) {
			return 1;
		} else {
			return '';
		}
	}
	
	function profile_sanitize_text( $input ) {
	    return wp_kses_post( force_balance_tags( $input ) );
	}

	// Set site name and description text to be previewed in real-time
	$wp_customize->get_setting('blogname')->transport='postMessage';
	$wp_customize->get_setting('blogdescription')->transport='postMessage';

	// Set site title color to be previewed in real-time
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
	
	//-------------------------------------------------------------------------------------------------------------------//
	// Logo Section
	//-------------------------------------------------------------------------------------------------------------------//
	
	$wp_customize->add_section( 'profile_logo_section' , array(
		'title' 	=> __( 'Logo', 'organic-profile' ),
		'description' => __( 'Logo images have a max-height of 160px.', 'organic-profile' ),
		'priority' 	=> 10,
	) );

		// Logo uploader
		$wp_customize->add_setting( 'profile_logo', array(
			'default' 	=> get_template_directory_uri() . '/images/logo.png',
			'sanitize_callback' => 'esc_url_raw',
		) );
		$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'profile_logo', array(
			'label' 	=> __( 'Logo', 'organic-profile' ),
			'section' 	=> 'profile_logo_section',
			'settings'	=> 'profile_logo',
			'priority'	=> 20,
		) ) );
		
	//-------------------------------------------------------------------------------------------------------------------//
	// Site Title Section
	//-------------------------------------------------------------------------------------------------------------------//
		
		// Site Title Align
		$wp_customize->add_setting( 'title_align', array(
		    'default' => 'left',
		    'sanitize_callback' => 'profile_sanitize_align',
		) );
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'title_align', array(
		    'type' => 'radio',
		    'label' => __( 'Site Title & Tagline Alignment', 'organic-profile' ),
		    'section' => 'title_tagline',
		    'choices' => array(
		        'left' 		=> __( 'Left Align', 'organic-profile' ),
		        'center' 	=> __( 'Center Align', 'organic-profile' ),
		        'right' 	=> __( 'Right Align', 'organic-profile' ),
		    ),
		    'priority' => 40,
		) ) );
		
		// Site Title Color
		$wp_customize->add_setting( 'title_color', array(
		    'default' => 'black',
		    'sanitize_callback' => 'profile_sanitize_title_color',
		) );
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'title_color', array(
		    'type' => 'radio',
		    'label' => __( 'Site Title & Tagline Color', 'organic-profile' ),
		    'section' => 'title_tagline',
		    'choices' => array(
		        'black' 	=> __( 'Black', 'organic-profile' ),
		        'white' 	=> __( 'White', 'organic-profile' ),
		    ),
		    'priority' => 60,
		) ) );
	
	//-------------------------------------------------------------------------------------------------------------------//
	// Colors Section
	//-------------------------------------------------------------------------------------------------------------------//
		
		// Link Color
		$wp_customize->add_setting( 'link_color', array(
	        'default' => '#33ccff',
	        'sanitize_callback' => 'sanitize_hex_color',
		) );
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'link_color', array(
	        'label' => 'Link Color',
	        'section' => 'colors',
	        'settings' => 'link_color',
	        'priority'    => 50,
	    ) ) );
	    
	    // Link Hover Color
	    $wp_customize->add_setting( 'link_hover_color', array(
	        'default' => '#3399cc',
	        'sanitize_callback' => 'sanitize_hex_color',
	    ) );
	    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'link_hover_color', array(
	        'label' => 'Link Hover Color',
	        'section' => 'colors',
	        'settings' => 'link_hover_color',
	        'priority'    => 60,
	    ) ) );
	    
	    // Heading Link Color
	    $wp_customize->add_setting( 'heading_link_color', array(
	        'default' => '#333333',
	        'sanitize_callback' => 'sanitize_hex_color',
	    ) );
	    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'heading_link_color', array(
	        'label' => 'Heading Link Color',
	        'section' => 'colors',
	        'settings' => 'heading_link_color',
	        'priority'    => 70,
	    ) ) );
	    
	    // Heading Link Hover Color
	    $wp_customize->add_setting( 'heading_link_hover_color', array(
	        'default' => '#33ccff',
	        'sanitize_callback' => 'sanitize_hex_color',
	    ) );
	    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'heading_link_hover_color', array(
	        'label' => 'Heading Link Hover Color',
	        'section' => 'colors',
	        'settings' => 'heading_link_hover_color',
	        'priority'    => 80,
	    ) ) );
	    
	    // Highlight Color
	    $wp_customize->add_setting( 'highlight_color', array(
	        'default' => '#33ccff',
	        'sanitize_callback' => 'sanitize_hex_color',
	    ) );
	    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'highlight_color', array(
	        'label' => 'Highlight & Button Color',
	        'section' => 'colors',
	        'settings' => 'highlight_color',
	        'priority'    => 90,
	    ) ) );
		
	//-------------------------------------------------------------------------------------------------------------------//
	// Home Page Section
	//-------------------------------------------------------------------------------------------------------------------//
	
	$wp_customize->add_section( 'profile_home_section' , array(
		'title'       => __( 'Home Page', 'organic-profile' ),
		'priority'    => 102,
	) );
	
		// Featured Page Top
		$wp_customize->add_setting( 'page_featured_top', array(
			'default' => '2',
			'sanitize_callback' => 'profile_sanitize_pages',
		) );
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'page_featured_top', array(
			'label'		=> __( 'Featured Page', 'organic-profile' ),
			'section'	=> 'profile_home_section',
			'settings'	=> 'page_featured_top',
			'type'		=> 'dropdown-pages',
			'priority' => 20,
		) ) );
		
		// Featured Slideshow Category
		$wp_customize->add_setting( 'category_slideshow_home' , array(
			'sanitize_callback' => 'profile_sanitize_categories',
		) );
		$wp_customize->add_control( new Profile_Category_Dropdown_Control( $wp_customize, 'category_slideshow_home', array(
			'label'		=> __( 'Featured Slideshow Category', 'organic-profile' ),
			'section'	=> 'profile_home_section',
			'settings'	=> 'category_slideshow_home',
			'type'		=> 'dropdown-categories',
			'priority' => 40,
		) ) );
		
		// Featured Slideshow Posts Displayed
		$wp_customize->add_setting( 'postnumber_slideshow_home', array(
			'default' => '10',
			'sanitize_callback' => 'profile_sanitize_text',
		) );
		$wp_customize->add_control( new Profile_Customizer_Number_Control( $wp_customize, 'postnumber_slideshow_home', array(
			'label'		=> __( 'Featured Slideshow Posts Displayed', 'organic-profile' ),
			'section'	=> 'profile_home_section',
			'settings'	=> 'postnumber_slideshow_home',
			'type'		=> 'number',
			'priority' => 60,
		) ) );
		
		// Slider Transition Interval
		$wp_customize->add_setting( 'transition_interval', array(
		    'default' => '8000',
		    'sanitize_callback' => 'profile_sanitize_transition_interval',
		) );
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'transition_interval', array(
		    'type' => 'select',
		    'label' => __( 'Transition Interval', 'organic-profile' ),
		    'section' => 'profile_home_section',
		    'choices' => array(
		        '2000' 		=> __( '2 Seconds', 'organic-profile' ),
		        '4000' 		=> __( '4 Seconds', 'organic-profile' ),
		        '6000' 		=> __( '6 Seconds', 'organic-profile' ),
		        '8000' 		=> __( '8 Seconds', 'organic-profile' ),
		        '10000' 	=> __( '10 Seconds', 'organic-profile' ),
		        '12000' 	=> __( '12 Seconds', 'organic-profile' ),
		        '20000' 	=> __( '20 Seconds', 'organic-profile' ),
		        '30000' 	=> __( '30 Seconds', 'organic-profile' ),
		        '60000' 	=> __( '1 Minute', 'organic-profile' ),
		        '999999999'	=> __( 'Hold Frame', 'organic-profile' ),
		    ),
		    'priority' => 80,
		) ) );
		
		// Slider Transition Style
		$wp_customize->add_setting( 'transition_style', array(
		    'default' => 'slide',
		    'sanitize_callback' => 'profile_sanitize_transition_style',
		) );
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'transition_style', array(
		    'type' => 'select',
		    'label' => __( 'Transition Style', 'organic-profile' ),
		    'section' => 'profile_home_section',
		    'choices' => array(
		        'fade' 		=> __( 'Fade', 'organic-profile' ),
		        'slide' 	=> __( 'Slide', 'organic-profile' ),
		    ),
		    'priority' => 100,
		) ) );
		
	//-------------------------------------------------------------------------------------------------------------------//
	// Page Templates
	//-------------------------------------------------------------------------------------------------------------------//
	
	$wp_customize->add_section( 'profile_templates_section' , array(
		'title'       => __( 'Page Templates', 'organic-profile' ),
		'priority'    => 103,
	) );
		
		// Blog Template Category
		$wp_customize->add_setting( 'category_blog' , array(
			'default' => '1',
			'sanitize_callback' => 'profile_sanitize_categories',
		) );
		$wp_customize->add_control( new Profile_Category_Dropdown_Control( $wp_customize, 'category_blog', array(
			'label'		=> __( 'Blog Template Category', 'organic-profile' ),
			'section'	=> 'profile_templates_section',
			'settings'	=> 'category_blog',
			'type'		=> 'dropdown-categories',
			'priority' => 40,
		) ) );
		
		// Blog Posts Displayed
		$wp_customize->add_setting( 'postnumber_blog', array(
			'default' => '10',
			'sanitize_callback' => 'profile_sanitize_text',
		) );
		$wp_customize->add_control( new Profile_Customizer_Number_Control( $wp_customize, 'postnumber_blog', array(
			'label'		=> __( 'Blog Posts Displayed', 'organic-profile' ),
			'section'	=> 'profile_templates_section',
			'settings'	=> 'postnumber_blog',
			'type'		=> 'number',
			'priority' => 60,
		) ) );
		
		// Portfolio Template Category
		$wp_customize->add_setting( 'category_portfolio' , array(
			'default' => '1',
			'sanitize_callback' => 'profile_sanitize_categories',
		) );
		$wp_customize->add_control( new Profile_Category_Dropdown_Control( $wp_customize, 'category_portfolio', array(
			'label'		=> __( 'Portfolio Template Category', 'organic-profile' ),
			'section'	=> 'profile_templates_section',
			'settings'	=> 'category_portfolio',
			'type'		=> 'dropdown-categories',
			'priority' => 80,
		) ) );
		
		// Portfolio Column Layout
		$wp_customize->add_setting( 'portfolio_columns', array(
		    'default' => 'three',
		    'sanitize_callback' => 'profile_sanitize_columns',
		) );
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'portfolio_columns', array(
		    'type' => 'radio',
		    'label' => __( 'Portfolio Column Layout', 'organic-profile' ),
		    'section' => 'profile_templates_section',
		    'choices' => array(
		        'one' 		=> __( 'One Column', 'organic-profile' ),
		        'two' 		=> __( 'Two Columns', 'organic-profile' ),
		        'three' 	=> __( 'Three Columns', 'organic-profile' ),
		    ),
		    'priority' => 100,
		) ) );
		
	//-------------------------------------------------------------------------------------------------------------------//
	// Layout
	//-------------------------------------------------------------------------------------------------------------------//
	
	$wp_customize->add_section( 'profile_layout_section' , array(
		'title'       => __( 'Layout', 'organic-profile' ),
		'priority'    => 104,
	) );
		
		// Display Post Featured Image or Video
		$wp_customize->add_setting( 'display_feature_post', array(
			'default'	=> true,
			'sanitize_callback' => 'profile_sanitize_checkbox',
		) );
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'display_feature_post', array(
			'label'		=> __( 'Show Post Featured Images?', 'organic-profile' ),
			'section'	=> 'profile_layout_section',
			'settings'	=> 'display_feature_post',
			'type'		=> 'checkbox',
			'priority' => 80,
		) ) );
		
		// Display Page Featured Image or Video
		$wp_customize->add_setting( 'display_feature_page', array(
			'default'	=> true,
			'sanitize_callback' => 'profile_sanitize_checkbox',
		) );
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'display_feature_page', array(
			'label'		=> __( 'Show Page Featured Images?', 'organic-profile' ),
			'section'	=> 'profile_layout_section',
			'settings'	=> 'display_feature_page',
			'type'		=> 'checkbox',
			'priority' => 100,
		) ) );
		
		// Enable CSS3 Full Width Background
		$wp_customize->add_setting( 'background_stretch', array(
			'default'	=> true,
			'sanitize_callback' => 'profile_sanitize_checkbox',
		) );
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'background_stretch', array(
			'label'		=> __( 'Enable Full Width Background Image?', 'organic-profile' ),
			'section'	=> 'profile_layout_section',
			'settings'	=> 'background_stretch',
			'type'		=> 'checkbox',
			'priority' => 120,
		) ) );
		
	//-------------------------------------------------------------------------------------------------------------------//
	// Social Section
	//-------------------------------------------------------------------------------------------------------------------//
	
	$wp_customize->add_section( 'profile_social_section' , array(
		'title'       => __( 'Social Media', 'organic-profile' ),
		'priority'    => 105,
	) );
		
		// Display Social Share Buttons on Single Posts
		$wp_customize->add_setting( 'display_social_post', array(
			'default'	=> true,
			'sanitize_callback' => 'profile_sanitize_checkbox',
		) );
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'display_social_post', array(
			'label'		=> __( 'Show Share Buttons on Single Posts?', 'organic-profile' ),
			'section'	=> 'profile_social_section',
			'settings'	=> 'display_social_post',
			'type'		=> 'checkbox',
			'priority' => 20,
		) ) );
		
		// Twitter User
		$wp_customize->add_setting( 'profile_user_twitter', array(
			 'default'	=> 'organic-profile', 
			 'sanitize_callback' => 'profile_sanitize_text',
		) );
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'profile_user_twitter', array(
			'label'		=> __( 'Twitter User', 'organic-profile' ),
			'section'	=> 'profile_social_section',
			'settings'	=> 'profile_user_twitter',
			'type'		=> 'text',
			'priority' => 100,
		) ) );
		
		// Twitter Widget ID
		$wp_customize->add_setting( 'profile_twitter_widget_id', array(
			'default'	=> '',
			'sanitize_callback' => 'profile_sanitize_text',
		) );
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'profile_twitter_widget_id', array(
			'label'		=> __( 'Twitter Widget ID', 'organic-profile' ),
			'section'	=> 'profile_social_section',
			'settings'	=> 'profile_twitter_widget_id',
			'type'		=> 'text',
			'priority' => 120,
		) ) );
	
}
add_action('customize_register', 'profile_theme_customizer');

/**
* Binds JavaScript handlers to make Customizer preview reload changes
* asynchronously.
*/
function profile_customize_preview_js() {
	wp_enqueue_script( 'profile-customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ) );
}
add_action( 'customize_preview_init', 'profile_customize_preview_js' );