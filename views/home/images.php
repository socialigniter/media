<h3>Photo Albums</h3>

<div id="photo_albums_browse">
	Order By
	<select name="album_filter" id="album_filter">
		<option value="most">Most Pictures</option>
		<option value="least">Least Pictures</option>
		<option value="updated_at">Recently Updated</option>
		<option value="newest">Newest</option>
		<option value="oldest">Oldest</option>
		<option value="app">App</option>
	</select>
	<button id="add_photo_album">Create Album</button>
</div>

<div id="photo_albums">
<?php
if ($categories):
	foreach ($categories as $category): 
		$image = $this->media_igniter->display_image_album_thumbnail($category, 'small');
?>
	<div class="photo_album" data-album_module="<?= $category->module ?>" data-category_id="<?= $category->category_id ?>" data-contents_count="<?= $category->contents_count ?>" data-created_at="<?= $category->created_at ?>" data-updated_at="<?= $category->updated_at ?>">
		<ul>
			<li><a href="<?= base_url().'home/media/images/'.$category->category_id ?>"><img src="<?= $image ?>"></a></li>
			<li><a href="<?= base_url().'home/media/images/'.$category->category_id ?>"><?= character_limiter($category->category, 13) ?></a></li>
			<li class="small_details"><?= $category->contents_count ?> Photos</li>
		</ul>
	</div>
<?php endforeach; else: ?>
<p>No photo albums exist</p>
<?php endif; ?>
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