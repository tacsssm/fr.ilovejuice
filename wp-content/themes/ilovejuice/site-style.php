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
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<?php get_footer(); ?>
