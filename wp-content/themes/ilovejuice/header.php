<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html" charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<title>
			<?php bloginfo('name') . wp_title(); ?>
		</title>
		<meta name="description" content="<?php bloginfo('description'); ?>" />
		 <link rel="icon" type="image/png" href="<?php bloginfo('template_directory') ?>/img/ico.png" />
		<?php wp_head(); ?>
	</head>
	<body <?php body_class();?>>
	
		<header>
			<div class="container-fluid search-container">
				<div class="row-fluid">
					<div class="col-sm-12 search">
						<?php 
							dynamic_sidebar( "search" );	
						?>			
					</div>
				</div>
			</div>
			<div class="container-fluid">
				<div class="row-fluid">
					<div class="col-sm-12 logo">
						 <img src="<?php bloginfo('template_directory') ?>/img/logo_sm.jpg" />
					</div>
				</div>
			</div>
		</header>
		
		<section id="main-menu">
			<div class="container-fluid">
				<div class="row-fluid">
					<?php 
						wp_nav_menu( array( 'theme_location' => 'juice-menu', 'menu_class' => 'menu unstyled clearfix' ) );
					?>
				</div>
			</div>
		</section>
		
		<section id="juice-content">