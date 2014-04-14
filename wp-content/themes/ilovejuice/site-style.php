<?php
the_post ();
?>

<?php get_header(); ?>

<div class="content-wrapper">
	<div class="container-fluid">
		<div class="row-fluid top">
			<div class="col-sm-12">
					<h1>
						<?php the_title(); ?>
					</h1>
					<div class="text-wrap">
						<?php
							global $more;
// 							the_pre_more_text();
							the_content ();
						?>
						
						<?php
							if (is_page(44)) {
								$args = array(
										'posts_per_page' => 3,
										'cat' => '3',
										'sort_order' => 'DESC',
										'sort_column' => 'post_date',
								);
								query_posts( $args );
								if (have_posts ()) :
									while ( have_posts () ) : the_post ();
										$the_date = apply_filters ( 'the_date', get_the_date ( "d.m.y" ) );
										echo "<h2>";
										echo "<span class='date' style='display: inline-block; width: 90px;'>$the_date</span>";
										the_title();
										echo "</h2>";
										echo "<div style='padding-left: 90px; padding-top: 6px;'>";
										the_content();
										echo "</div>";
									endwhile;
								endif;
								wp_reset_query();
							}
						?>
																
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<?php get_footer(); ?>
