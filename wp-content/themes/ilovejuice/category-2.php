<?php get_header(); ?>
<?php if ( have_posts() ) : ?>


<div class="content-wrapper">
	<div class="container-fluid">
		<div class="row-fluid top">
			<div class="col-sm-12 content">
				<h1>
					<?php echo get_the_category_by_ID(2); ?>
				</h1>
				<div class="text-wrap">
					<?php while ( have_posts() ) : the_post(); ?>
					<div class="row-fluid margin20-bottom">
							<div class="col-sm-2">
									<span class="date">
									<?php
									$the_date = apply_filters ( 'the_date', get_the_date ( "d.m.Y" ) );
									echo $the_date;
									?>
									</span>
									<a class="fb_share_button" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo get_permalink()?>" target="_blank">
										share
									</a>
							</div>
							<div class="col-sm-10">
								<h2>
									<?php the_title(); ?>
								</h2>
								<div class="news-text-wrap">
									<?php
										global $more;
			// 							the_pre_more_text();
										the_content ();
									?>
								</div>
							</div>
							<div class="clearfix">
							</div>
						</div>
					<?php endwhile; ?>
				</div>
			</div>
			<div class="clearfix">
			</div>
		</div>
	</div>
</div>

<?php endif; ?>

<?php get_footer(); ?>
