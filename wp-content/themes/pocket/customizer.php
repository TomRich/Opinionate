<?php

/**
 * Theme Customizer
 *
 * @package Pocket
 * @since Pocket 1.0
 */


add_action( 'customize_register', 'okay_theme_customizer_register' );

if ( class_exists('WP_Customize_Control') && ! class_exists( 'Okay_Customize_Textarea_Control' ) ) {
	class Okay_Customize_Textarea_Control extends WP_Customize_Control {
		public $type = 'textarea';

		public function render_content() {
			?>
			<label>
				<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
				<textarea rows="5" style="width:100%;" <?php $this->link(); ?>><?php echo esc_textarea( $this->value() ); ?></textarea>
			</label>
		<?php
		}
	}
}

if ( ! function_exists( 'okay_customizer_preview' ) ) {

	function okay_customizer_preview() {
		?>
		<script type="text/javascript">
			(function ( $ ) {

				wp.customize( 'blogname', function ( value ) {
					value.bind( function ( to ) {
						$( '.logo-text a' ).html( to );
					} );
				} );

				wp.customize( 'blogdescription', function ( value ) {
					value.bind( function ( to ) {
						$( 'h2.logo-subtitle' ).html( to );
					} );
				} );

				wp.customize( 'okay_theme_customizer[sub_title]', function ( value ) {
					value.bind( function ( to ) {
						$( '#intro-text h3' ).html( to );
					} );
				} );

			})( jQuery )
		</script>
	<?php
	}


}


/**
 * @param WP_Customize_Manager $wp_customize
 */
function okay_theme_customizer_register( $wp_customize ) {

	//Pocket Style Options

	$wp_customize->add_section( 'okay_theme_customizer_basic', array(
		'title'    => __( 'Pocket Styling', 'okay' ),
		'priority' => 100
	) );

	//Logo Image
	$wp_customize->add_setting( 'okay_theme_customizer_logo', array() );

	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'okay_theme_customizer_logo', array(
		'label'    => __( 'Logo Upload', 'okay' ),
		'section'  => 'okay_theme_customizer_basic',
		'settings' => 'okay_theme_customizer_logo'
	) ) );

	//Accent Color
	$wp_customize->add_setting( 'okay_theme_customizer_accent', array(
		'default' => '#DD574C'
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'okay_theme_customizer_accent', array(
		'label'    => __( 'Accent Color', 'okay' ),
		'section'  => 'okay_theme_customizer_basic',
		'settings' => 'okay_theme_customizer_accent'
	) ) );

	//Disable BW Effect
	$wp_customize->add_setting('okay_theme_customizer_bw_disable', array(
        'default'        => 'enable',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
    ));
    
    $wp_customize->add_control( 'okay_theme_bw_select_box', array(
        'settings' => 'okay_theme_customizer_bw_disable',
        'label'   => __( 'BW Image Effect', 'okay' ),
        'section' => 'okay_theme_customizer_basic',
        'type'    => 'select',
        'choices'    => array(
            'enable' => 'Enable',
            'disable' => 'Disable',
        ),
    ));

    //Toggle Comments
	$wp_customize->add_setting('okay_theme_customizer_comment_toggle', array(
        'default'        => 'toggle',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
    ));
    
    $wp_customize->add_control( 'okay_theme_comment_select_box', array(
        'settings' => 'okay_theme_customizer_comment_toggle',
        'label'   => __( 'Comment Toggle', 'okay' ),
        'section' => 'okay_theme_customizer_basic',
        'type'    => 'select',
        'choices'    => array(
            'toggle' => 'Click To Comment',
            'show' => 'Always Show',
        ),
    ));

	//Custom CSS
	$wp_customize->add_setting( 'okay_theme_customizer_css', array(
		'default' => '',
	) );

	$wp_customize->add_control( new Okay_Customize_Textarea_Control( $wp_customize, 'okay_theme_customizer_css', array(
		'label'    => 'Custom CSS',
		'section'  => 'okay_theme_customizer_basic',
		'settings' => 'okay_theme_customizer_css',
	) ) );


	//Real Time Settings Preview

	$wp_customize->get_setting( 'blogname' )->transport = 'postMessage';

	if ( $wp_customize->is_preview() && ! is_admin() )
		add_action( 'wp_footer', 'okay_customizer_preview', 21 );

}