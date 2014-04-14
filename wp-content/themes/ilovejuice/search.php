<?php get_header(); ?>

<div id="background">
	<div id="header">
	
		<div class="width-define">
			<div id="slogan">
				<div class="row-fluid">
					<div class="span6 text-center offset3">
						<?php bloginfo('description'); ?>
					</div>
					<div class="span3 text-center">
						<?php 
							dynamic_sidebar( "primary" );	
						?>
					</div>
				</div>
			</div>
		</div>
	</div>
	
	<div class="width-define">
		<div class="row-fluid">
			<div class="span12" id="menu">
				<?php 
					wp_nav_menu( array( 'theme_location' => 'main-menu', 'menu_class' => 'menu unstyled clearfix' ) );
				?>
				<div class="clearfix"></div>
			</div>
		</div>

	<div id="primary" class="content-area">
		<div id="content" class="site-content" role="main">

		<?php if ( have_posts() ) : ?>

			<header class="page-header">
				<h1 class="page-title"><?php printf( __( 'Search Results for: %s', 'ilovejuice' ), get_search_query() ); ?></h1>
			</header>

			<?php /* The loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>
			<div class="entry-content border1-bottom">
				<h2 class="page-title"><?php echo "<a href='".get_permalink()."'>".get_the_title()."</a>" ?></h2>
				<?php 
					the_excerpt();
				?>
			</div>
			<?php endwhile; ?>

		<?php else : ?>
			<article id="post-0" class="post no-results not-found">
				<header class="entry-header">
					<h1 class="entry-title"><?php _e( 'Nothing Found', 'ilovejuice' ); ?></h1>
				</header>

				<div class="entry-content">
					<p><?php _e( 'Sorry, but nothing matched your search criteria. Please try again with some different keywords.', 'palmacentrum' ); ?></p>
					<?php get_search_form(); ?>
				</div><!-- .entry-content -->
			</article><!-- #post-0 -->
		<?php endif; ?>

		</div><!-- #content -->
	</div><!-- #primary -->

<?php get_footer(); ?>