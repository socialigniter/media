<div id="image_view">
	<img src="<?= $image_large ?>" border="0">
</div>

<div id="image_author">
	
	<p><img src="<?= $this->social_igniter->profile_image($image->user_id, $image->image, $image->gravatar, 'medium'); ?>"></p>

	<ul>
		<li><h3><?= $image->name ?></h3></li>
		<li>Uploaded on <?= $image->created_at ?></li>
	</ul>

</div>

<div class="clear"></div>

<?= $comments_list ?>
<?= $comments_write ?>