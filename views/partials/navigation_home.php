<h2 class="content_title"><img src="<?= $modules_assets ?>media_32.png"> Media</h2>
<ul class="content_navigation">
	<?= navigation_list_btn('home/media', 'Recent') ?>
	<?= navigation_list_btn('home/media/images', 'Images', $this->uri->segment(4)) ?>
	<?= navigation_list_btn('home/media/audio', 'Audio') ?>
	<?= navigation_list_btn('home/media/files', 'Files') ?>
	<?= navigation_list_btn('home/media/videos', 'Videos') ?>
	<?php if ($logged_user_level_id == 1) echo navigation_list_btn('home/media/manage', 'Manage', $this->uri->segment(4)) ?>	
</ul>