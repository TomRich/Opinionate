<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width" />
	<title><?php wp_title( '|', true, 'right' ); ?><?php echo bloginfo( 'name' ); ?></title>
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	
	<!-- load scripts and header -->
	<?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	
	<header class="header">
		<!-- grab the logo and site title -->
		<?php
		$logo = get_theme_mod('okay_theme_customizer_logo');
		if ( ! empty( $logo ) ) { ?>
			<h1 class="logo-image">
				<a href="<?php echo home_url( '/' ); ?>"><img class="logo" src="<?php echo esc_url( $logo ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>" /></a>
			</h1>
		<?php } else { ?>
		    <hgroup>
		    	<h1 class="logo-text"><a href="<?php echo home_url( '/' ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>"><?php echo esc_attr( get_bloginfo( 'name' ) ); ?></a></h1>
		    	<h2 class="logo-subtitle"><?php bloginfo('description') ?></h2>
		    </hgroup>
	    <?php } ?>
	    
	    <nav role="navigation" class="header-nav">
	    	<!-- search toggle -->
	    	<a class="search-toggle" href="#" title=""><i class="icon-search"></i><i class="icon-remove"></i></a>

	    	<!-- search form -->
	    	<div class="header-search-form">
	    		<form action="<?php echo home_url( '/' ); ?>" class="header-search-form clearfix">
					<fieldset>
						<input type="text" class="header-search-input" name="s" onfocus="if (this.value == '<?php _e('To search, type and press enter.','okay'); ?>') {this.value = '';}" onblur="if (this.value == '') {this.value = '<?php _e('To search, type and press enter.','okay'); ?>';}" value="<?php _e('To search, type and press enter.','okay'); ?>" placeholder="<?php _e( 'To search, type and press enter.', 'publisher' ) ?>"/>
					</fieldset>
				</form>
	    	</div>
	    	
	    	<!-- nav menu -->
		    <div class="nav-toggle">
		    	<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_class' => 'nav', 'container_class' => 'nav-toggle' ) ); ?>
		    </div>
	    </nav>	
	</header>
	
	<!-- next and previous page links -->
	<?php if ( is_single() ) { ?>
		<div class="next-prev">
			<div class="prev-post">
				<?php previous_post_link( '%link', __( 'Previous Post', 'okay' ) ); ?>
			</div>

			<div class="next-post">
				<?php next_post_link( '%link', __( 'Next Post', 'okay' ) ); ?>
			</div>
		</div>
	<?php } ?>
	
	<div id="wrapper">
		<div id="main">