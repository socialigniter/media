<h3>Details</h3>

<form name="upload_media" method="post" id="upload_media" action="<?= base_url() ?>home/media/upload" enctype="multipart/form-data">


	<p>DISPLAY MEDIA</p>
	
	
     <h3>Tags</h3>             
     <input name="tags" type="text" id="tags" size="75" placeholder="Blogging, Internet, Web Design" />  
     
     <h3>Comments</h3>             
	 <select name="comments_allow">
	 	<option value="Y">Allow</option>
	    <option value="N">Don't Allow</option>
	    <option value="A">Require Approval</option>
	</select>
	<?= form_error('comments', '<div class="error">*', '</div>'); ?>
              
  	<h3>Location</h3> 
    <input name="location" type="text" id="location" size="20" placeholder="New York, NY" /> 	
                 
    <?php // TO BE TURNED INTO A SYSTEM WIDE 'HOOK' ?>             
    <h3>Publish</h3>             
    <ul>
    	<li><input type="checkbox" name="twitter" value="yes"> Twitter</li>
    	<li><input type="checkbox" name="facebook" value="yes"> Facebook</li>
    </ul> 
    <div class="clear"></div>
                 
    <p><input type="submit" name="publish" value="Publish" /> <input type="submit" name="save_draft" value="Save Draft" /></p>

	<input type="hidden" name="geo_lat" id="geo_lat" />
	<input type="hidden" name="geo_long" id="geo_long" />
	<input type="hidden" name="geo_accuracy" id="geo_accuracy" />

</form>
