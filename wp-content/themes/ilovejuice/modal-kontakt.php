
<div class="modal fade" id="ilj-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Recommander un smoothie</h4>
      </div>
	    <div id="form-sent-info" style="display: none;">
		     <div class="modal-body">
		     	<div class="alert alert-success"><strong>Message envoyé</strong>, Merci.</div>
		     </div>
		     <div class="modal-footer">
		       <button type="button" class="btn btn-default btn-lg" data-dismiss="modal">Fermer</button>
		     </div>
	    </div>
	      
		<form id="modal-contact-form" role="form" data-parsley-validate>
	      <div class="modal-body">
			  <div class="form-group">
			    <label for="email">Email d'un ami</label>
			    <input type="email" class="form-control" id="contact-email" placeholder="E-mail" required="required">
			  </div>
			  <div class="form-group">
			    <label for="text">Text</label>
			    <textarea class="form-control" id="contact-text" placeholder="Text" rows="3" required="required">Viens découvrir ce produit que je consomme, c’est délicieux.</textarea>
			  </div>
			  <div class="form-group">
			    <label for="text">Link: </label>
			    <?php echo get_permalink(); ?>
			  </div>
			  <div class="form-group">
			    <label for="text">Captcha</label>
			    <br />
			    <div style="line-height: 60px;">
				    <img src='/captcha.php' class="pull-left" id="modal-captcha-image"/>
				    <a style="margin-left: 12px;" id="modal-captcha-refresh">
					    <i class="fa fa-refresh fa-2x"></i>
				    </a>
				    
				    <input type="text" id="contact-captcha" placeholder="Copiez le code de cette image" required="required" data-parsley-remote="/checkcaptcha.php" data-parsley-remote-options='{ "type": "POST"}'>
			    </div>
			  </div>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
	        <button type="submit" class="btn btn-primary btn-lg" id="popup-contact-form"><i class="fa fa-envelope-o"></i> Envoyer</button>
	      </div>
		    <input type="hidden" id="juice-link" name="juice-link" value="<?php echo get_permalink(); ?>" />
		</form>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

