<?php
/**
* Google Fonts Implementation
*
* @package Profile
* @since Profile 1.0
*
*/

function profile_fonts_url() {
    $fonts_url = '';
 
    /* Translators: If there are characters in your language that are not
    * supported by Lora, translate this to 'off'. Do not translate
    * into your own language.
    */
    
    $merriweather = _x( 'on', 'Merriweather font: on or off', 'organic-profile' );
    $oswald = _x( 'on', 'Oswald font: on or off', 'organic-profile' );
    $arimo = _x( 'on', 'Arimo font: on or off', 'organic-profile' );
    $raleway = _x( 'on', 'Raleway font: on or off', 'organic-profile' );
    $roboto = _x( 'on', 'Roboto font: on or off', 'organic-profile' );
    $open_sans = _x( 'on', 'Open Sans font: on or off', 'organic-profile' );
    $montserrat = _x( 'on', 'Montserrat font: on or off', 'organic-profile' );
    $droid_serif = _x( 'on', 'Droid Serif font: on or off', 'organic-profile' );
 
    if ( 'off' !== $arimo || 'off' !== $raleway || 'off' !== $open_sans || 'off' !== $montserrat || 'off' !== $droid_serif ) {
        $font_families = array();
        
        if ( 'off' !== $merriweather ) {
            $font_families[] = 'Merriweather:400,700,300,900';
        }
        
        if ( 'off' !== $oswald ) {
            $font_families[] = 'Oswald:400,700,300';
        }
        
        if ( 'off' !== $arimo ) {
            $font_families[] = 'Arimo:400,400italic,700,700italic';
        }
 		
        if ( 'off' !== $raleway ) {
            $font_families[] = 'Raleway:400,200,300,800,700,500,600,900,100';
        }
        
        if ( 'off' !== $roboto ) {
            $font_families[] = 'Roboto:400,100italic,100,300,300italic,400italic,500,500italic,700,700italic,900,900italic';
        }
 
        if ( 'off' !== $open_sans ) {
            $font_families[] = 'Open Sans:400,300,600,700,800,800italic,700italic,600italic,400italic,300italic';
        }
        
        if ( 'off' !== $montserrat ) {
            $font_families[] = 'Montserrat:400,700';
        }
        
        if ( 'off' !== $droid_serif ) {
            $font_families[] = 'Droid Serif:400,400italic,700,700italic';
        }
 
        $query_args = array(
            'family' => urlencode( implode( '|', $font_families ) ),
            'subset' => urlencode( 'latin,latin-ext' ),
        );
 
        $fonts_url = add_query_arg( $query_args, '//fonts.googleapis.com/css' );
    }
 
    return $fonts_url;
}

/**
* Enqueue Google Fonts on Front End
*
* @since Profile 1.0
*/

function profile_scripts_styles() {
    wp_enqueue_style( 'profile-fonts', profile_fonts_url(), array(), null );
}
add_action( 'wp_enqueue_scripts', 'profile_scripts_styles' );

/**
* Enqueue Google Fonts on Custom Header Page
*
* @since Profile 1.0
*/
function profile_custom_header_fonts() {
    wp_enqueue_style( 'profile-fonts', profile_fonts_url(), array(), null );
}
add_action( 'admin_print_styles-appearance_page_custom-header', 'profile_scripts_styles' );

/**
* Add Google Scripts for use with the editor
*
* @since Profile 1.0
*/
function profile_editor_styles() {
    add_editor_style( array( 'css/style-editor.css', profile_fonts_url() ) );
}
add_action( 'after_setup_theme', 'profile_editor_styles' );