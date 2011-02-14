<div id="image_view">
	<img src="<?= $image_large ?>">
</div>

<div id="image_author">
	
	<p><img src="<?= $this->social_igniter->profile_image($image->user_id, $image->image, $image->email); ?>"></p>

	<ul>
		<li><h3><?= $image->name ?></h3></li>
		<li>Uploaded on <?= $image->created_at ?></li>
	</ul>

</div>

<div class="clear"></div>

<?php if ((config_item('comments_enabled') == 'TRUE') && ($comments_allow != 'N')): ?>
<div id="comments">
	<h3><span id="comments_count"><?= $comments_title ?></span> Comments</h3>
	
	<ol id="comments_list">
		<?php if($comments_list) echo $comments_list ?>
	</ol>
	<?= $comments_write ?>
</div>
<?php endif; ?>