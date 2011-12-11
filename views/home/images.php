<div id="media_gallery" class="images">
	<div id="content_message"></div>

	<div id="gallery_title">
		<h3>Your Images</h3>
	</div>

	<form action="<?= base_url() ?>api/media/create" method="post" enctype="multipart/form-data">
		<input type="submit" class="right" value="Upload">
		<input type="file" class="file_upload" name="userfile">
	    <?= form_dropdown('category_id', $categories_dropdown, $category_id) ?>
	</form>

	<br class="clear">

	<ul>
	<?php foreach ($categories as $category): 
		$image = $this->media_igniter->display_image_album_thumbnail($category);
	?>
		<li>
			<ul>
				<li><a href="<?= base_url().'home/media/images/'.$category->category_id ?>"><img src="<?=  ?>"></a></li>
				<li><a href="<?= base_url().'home/media/images/'.$category->category_id ?>"><?= $category->category ?></a></li>
				<li><?= $category->contents_count ?> photos</li>
			</ul>
		</li>
	<?php endforeach; ?>
	</ul>	

	<div class="clear"></div>	
</div>

<script type="text/javascript">
$(document).ready(function()
{
	// Add Category
	$('#category_id').categoryManager(
	{
		action		: 'create',				
		module		: 'media',
		type		: 'photo-album',
		title		: 'Add Photo Album'
	});
});
</script>