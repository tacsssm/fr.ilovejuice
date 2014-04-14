<div class="my_meta_control">
 
 	<table width="100%">
 		<tr>
 			<td>
 				<label for="header_menu_background">
					Header and menu background color	
				</label>
 			</td>
 			<td>
 				<label for="header_menu_text">
					Header and menu text color	
				</label>
 			</td>
 			<td>
 				<label for="menu_active_text">
					Active submenu text color	
				</label>
 			</td>
 		</tr>
 		<tr>
 			<td>
				<?php $metabox->the_field(CUSTOM_HEADER_AND_MENU_BACKGROUND_COLOR_META_KEY); ?>
				<input type="text" name="<?php $metabox->the_name(); ?>" value="<?php $metabox->the_value(CUSTOM_HEADER_AND_MENU_BACKGROUND_COLOR_META_KEY);?>"/>
 			</td>
 			<td>
				<?php $metabox->the_field(CUSTOM_HEADER_AND_MENU_TEXT_COLOR_META_KEY); ?>
				<input type="text" name="<?php $metabox->the_name(); ?>" value="<?php $metabox->the_value(CUSTOM_HEADER_AND_MENU_TEXT_COLOR_META_KEY); ?>"/>
 			</td>
 			<td>
				<?php $metabox->the_field(CUSTOM_ACTIVE_MENU_TEXT_COLOR_META_KEY); ?>
				<input type="text" name="<?php $metabox->the_name(); ?>" value="<?php $metabox->the_value(CUSTOM_ACTIVE_MENU_TEXT_COLOR_META_KEY); ?>"/>
 			</td>
 		</tr>
 	</table>
	<p>
	</p>

</div>