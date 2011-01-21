<h3>Quick Upload</h3>

<div id="swfupload-control">

	<p>Upload up to 5 images (jpg, png, gif), each having maximum size of 1MB</p>
	<input type="button" id="button" />
	<p id="queuestatus" ></p>

	<ol id="log">
	</ol>

</div>


<?php /*
<form name="upload_media" method="post" id="upload_media" action="<?= base_url() ?>upload/index" enctype="multipart/form-data">

	<?= form_dropdown('type', config_item('media_types'), $type) ?>	
	<?= form_error('type', '<div class="error">*', '</div>'); ?>
	
	<label for="Filedata">Choose files</label><br/>

	<?php echo form_upload(array('name'=>'Filedata','id'=>'uploadifyit')); ?>

	<div class="clear"></div>

	<a href="javascript:$('#uploadifyit').uploadifyUpload();">Upload File(s)</a>

</form>

<div id="fileinfotarget"></div>
*/ ?>

<?= $view_media ?>
