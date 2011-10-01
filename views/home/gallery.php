<div id="media_gallery" class="images">
	<h3><?= $category->category ?></h3>
	<p>By <a href=""><?= $category->name ?></a> - <?php if ($category->user_id == $logged_user_id): ?><a href="">Edit Album</a> -<?php endif; ?> <a href="<?= base_url() ?>home/media/images">View Albums</a></p>

	<div id="gallery_descriptions">
		<p><?= $category->description ?></p>
	</div>

	<form action="<?= base_url() ?>api/media/create/format/html" method="post" enctype="multipart/form-data">
		<input type="submit" class="right" value="Upload">
		<input type="file" class="file_upload" name="userfile">
		<input type="hidden" id="category_id" name="category_id" value="<?= $category->category_id ?>">
	</form>	

	<br class="clear">
	<div class="drag_wrap">
		<ul id="image_list">
		<?php foreach($images as $image): ?>
			<li class="media_item">
				<a href="<?= base_url().config_item('media_images_folder').$image->category_id.'/original_'.$image->content ?>" class="images_fancybox"><img src="<?= base_url().config_item('media_images_folder').$image->category_id.'/small_'.$image->content ?>" alt="<?= $image->title ?>"></a>
				<ul class="media_actions">
					<li><a href="<?= base_url().config_item('media_images_folder').$image->category_id.'/original_'.$image->content ?>" class="images_fancybox"><span class="actions action_see"></span> View</a></li>
					<li><a href=""><span class="actions action_edit"></span> Edit</a></li>
				</ul>
			</li>
		<?php endforeach; ?>
		</ul>
		<div class="clear"></div>
	</div>
	<br class="clear">
</div>

<script type="text/javascript">
$(document).ready(function()
{
	// Edit Category
	$('#gallery_descriptions').live('click', function()
	{
		var category_id = jQuery.url.segment(4);

		$.categoryEditor(
		{
			url_api		: base_url + 'api/categories/view/type/images',
			url_pre		: base_url + 'media/images/',
			url_sub		: base_url + 'api/categories/modify/id/' + category_id,
			module		: 'media',
			type		: 'photo-album',
			title		: 'Edit Photo Album',
			slug_value	: '',
			trigger		: $('.content [name=category_id]')
		});		
	});
	
});
</script>