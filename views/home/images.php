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
	<?php foreach ($categories as $category): ?>
		<li>
			<ul>
				<li><a href="<?= base_url().'home/media/images/'.$category->category_id ?>"><img src="<?= $this->media_igniter->display_image_album_thumbnail($category) ?>"></a></li>
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
	$('[name=category_id]').change(function()
	{	
		if($(this).val() == 'add_category')
		{
			$('[name=category_id]').find('option:first').attr('selected','selected');
			$.uniform.update('[name=category_id]');

			$.categoryEditor(
			{
				url_api		: base_url + 'api/categories/view/type/images',
				url_pre		: base_url + 'media/images/',
				url_sub		: base_url + 'api/categories/create',				
				module		: 'media',
				type		: 'image-album',
				title		: 'Add Photo Album',
				slug_value	: '',
				trigger		: $('.content [name=category_id]')
			});			
		}
	});
});
</script>