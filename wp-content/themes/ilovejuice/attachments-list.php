<?php $attachments = new Attachments( 'attachments' ); /* pass the instance name */ ?>
<?php if( $attachments->exist() ) : ?>
  <h3 class="page-header">Page attachments</h3>
  <div id="page-attachments">
    <?php while( $attachments->get() ) : ?>
      <div class="row-fluid">
		<div class="span1"><?php echo $attachments->image( 'thumbnail' ); ?></div>
		<div class="span11">
			<a target="_blank" href="<?php echo $attachments->url(); ?>" title="Download"><i class="icon-download-alt"></i> <?php echo $attachments->field( 'title' ); ?> / <?php echo $attachments->filesize(); ?> (<?php echo $attachments->subtype(); ?>)</a>
			<?php if($attachments->field( 'caption' ) != ""){ ?>
				<p><?php echo $attachments->field( 'caption' ); ?></p>			
			<?php } ?>
		</div>
      </div>
    <?php endwhile; ?>
  </div>
  <?php endif; ?>
