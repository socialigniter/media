<form name="settings_update" id="settings_update" method="post" action="<?= base_url() ?>api/settings/modify" enctype="multipart/form-data">

<div class="content_wrap_inner">
		
	<div class="content_inner_top_right">
		<h3>Module</h3>
		<p><?= form_dropdown('enabled', config_item('enable_disable'), $settings['media']['enabled']) ?></p>
	</div>	
	
	<h3>Permissions</h3>

	<p>Create
	<?= form_dropdown('create_permission', config_item('users_levels'), $settings['media']['create_permission']) ?>
	</p>

	<p>Publish
	<?= form_dropdown('publish_permission', config_item('users_levels'), $settings['media']['publish_permission']) ?>	
	</p>

	<p>Manage All
	<?= form_dropdown('manage_permission', config_item('users_levels'), $settings['media']['manage_permission']) ?>	
	</p>
		
</div>

<span class="item_separator"></span>

<div class="content_wrap_inner">		
		
	<h3>Images</h3>

	<p>Allowed
	<?= form_dropdown('images_allow', config_item('yes_or_no'), $settings['media']['images_allow']) ?>
	</p>	
	
	<table border="0" cellpadding="0" cellspacing="0">
	<tr>
		<td>Full</td>
		<td><input class="nullify" type="checkbox" name="images_sizes_full" value="<?= $settings['media']['images_sizes_full'] ?>"></td>
		<td><input type="text" name="images_full_width" value="<?= $settings['media']['images_full_width'] ?>" size="3"> x <input type="text" name="images_full_height" value="<?= $settings['media']['images_full_height'] ?>" size="3"> px</td>
	</tr>	
	<tr>
		<td>Large</td>
		<td><input class="nullify" type="checkbox" name="images_sizes_large" value="<?= $settings['media']['images_sizes_large'] ?>"></td>
		<td><input type="text" name="images_large_width" value="<?= $settings['media']['images_large_width'] ?>" size="3"> x <input type="text" name="images_large_height" value="<?= $settings['media']['images_large_height'] ?>" size="3"> px</td>
	</tr>
	<tr>
		<td>Medium</td>
		<td><input class="nullify" type="checkbox" name="images_sizes_medium" value="<?= $settings['media']['images_sizes_medium'] ?>"></td>
		<td><input type="text" name="images_medium_width" value="<?= $settings['media']['images_medium_width'] ?>" size="3"> x <input type="text" name="images_medium_height" value="<?= $settings['media']['images_medium_height'] ?>" size="3"> px</td>
	</tr>
	<tr>
		<td>Small</td>
		<td><input class="nullify" type="checkbox" name="images_sizes_small" value="<?= $settings['media']['images_sizes_small'] ?>"></td>
		<td><input type="text" name="images_small_width" value="<?= $settings['media']['images_small_width'] ?>" size="3"> x <input type="text" name="images_small_height" value="<?= $settings['media']['images_small_height'] ?>" size="3"> px</td>
	</tr>
	<tr>
		<td>Original</td>
		<td><input class="nullify" type="checkbox" name="images_sizes_original" value="<?= $settings['media']['images_sizes_original'] ?>"></td>
		<td>Keep original uploaded image</td>		
	</tr>	
	</table>

	<p>Formats</p>
	<p><input type="text" name="images_formats" value="<?= $settings['media']['images_formats'] ?>" ></p>	
	
	<p><input type="text" name="images_max_size" value="<?= $settings['media']['images_max_size'] ?>" size="5"> max file size</p>

	<p><input type="text" name="images_max_dimensions" value="<?= $settings['media']['images_max_dimensions'] ?>" size="5"> max image dimensions (px)</p>

	<p><?= base_url() ?><input type="text" name="images_folder" value="<?= $settings['media']['images_folder'] ?>" size="32"> images path</p>
	
</div>

<span class="item_separator"></span>

<div class="content_wrap_inner">
	
	<h3>Audio</h3>

	<p>Allowed
	<?= form_dropdown('audio_allow', config_item('yes_or_no'), $settings['media']['audio_allow']) ?>
	</p>

	<p>Formats</p>
	<p><input type="text" name="audio_formats" value="<?= $settings['media']['audio_formats'] ?>" ></p>

	<p><input type="text" name="audio_max_size" value="<?= $settings['media']['audio_max_size'] ?>" size="5"> max file size</p>

</div>

<span class="item_separator"></span>

<div class="content_wrap_inner">

	<h3>Files</h3>

	<p>Allowed
	<?= form_dropdown('files_allow', config_item('yes_or_no'), $settings['media']['files_allow']) ?>
	</p>
	
	<p>Formats</p>
	<p><input type="text" name="files_formats" value="<?= $settings['media']['files_formats'] ?>" ></p>

	<p><input type="text" name="files_max_size" value="<?= $settings['media']['files_max_size'] ?>" size="5"> max file size</p>		
			
</div>

<span class="item_separator"></span>

<div class="content_wrap_inner">		
		
	<h3>Comments</h3>	

	<p>Allow
	<?= form_dropdown('comments_allow', config_item('yes_or_no'), $settings['media']['comments_allow']) ?>
	</p>

	<p>Comments Per-Page
	<?= form_dropdown('comments_per_page', config_item('amount_increments_five'), $settings['media']['comments_per_page']) ?>
	</p>

	<input type="hidden" name="module" value="media">

	<p><input type="submit" name="save" value="Save" /></p>

</div>

</form>

<?= $shared_ajax ?>