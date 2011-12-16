<h3>Photo Albums</h3>

<div id="photo_albums">
<?php foreach ($categories as $category):
	$image = $this->media_igniter->display_image_album_thumbnail($category, 'small');
?>
	<div class="photo_album">
		<ul>
			<li><a href="<?= base_url().'home/media/images/'.$category->category_id ?>"><img src="<?= $image ?>"></a></li>
			<li><a href="<?= base_url().'home/media/images/'.$category->category_id ?>"><?= character_limiter($category->category, 15) ?></a></li>
			<li class="small_details"><?= $category->contents_count ?> Photos</li>
		</ul>
	</div>
<?php endforeach; ?>
</div>	

	<div class="clear"></div>	


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