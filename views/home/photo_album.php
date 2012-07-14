<div id="photo_album" class="images">
	<h2><?= $category->category ?></h2>
	<p class="album_description"><?= $category->description ?></p>
	<p class="album_details">Created by <a href=""><?= $category->name ?></a> - <?php if ($category->user_id == $logged_user_id): ?><a href="<?= base_url() ?>">Edit Album</a><?php endif; ?></p>
	<div class="clear"></div>

	<div class="drag_wrap">
		<ul id="image_list">
		<?php foreach($images as $image): ?>
			<li class="media_item">
				<a href="<?= base_url().config_item('media_images_folder').$image->category_id.'/'.$image->content ?>" class="images_fancybox"><img src="<?= base_url().config_item('media_images_folder').$image->category_id.'/small_'.$image->content ?>" alt="<?= $image->title ?>"></a>
				<ul class="media_actions">
					<li><a href="<?= base_url().config_item('media_images_folder').$image->category_id.'/'.$image->content ?>" class="images_fancybox"><span class="actions action_see"></span> View</a></li>
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
	$('#category_id').categoryManager(
	{
		action		: 'edit',
		module		: 'media',
		type		: 'photo-album',
		title		: 'Edit Photo Album',
		category_id	: category_id
	});
});
</script>