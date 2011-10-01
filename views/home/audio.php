<h3>Your Audio</h3>

<form method="post" name="user_details" id="user_details" action="<?= base_url() ?>api/upload/create_expectation" enctype="multipart/form-data">
	<table border="0" cellpadding="0" cellspacing="0">
		<tr>		
			<td><input type="text" name="file_name" size="40" value=""></td>
		</tr>   
		<tr>		
			<td><input type="submit" value="Save" /></td>
		</tr>			
	</table>
</form>

<script type="text/javascript">
$(document).ready(function()
{
	// Write Article
	$("#user_details").bind("submit", function(e)
	{
		var file_hash = md5($('[name=file_name]').val() + user_data.consumer_secret);
	
		e.preventDefault();
		var upload_data = $('#user_details').serializeArray();
		upload_data.push({'name':'file_hash','value': file_hash});	
	
		$.oauthAjax(
		{
			oauth 		: user_data,
			url			: $(this).attr('ACTION'),
			type		: 'POST',
			dataType	: 'json',
			data		: upload_data,
	  		success		: function(result)
	  		{
				$('html, body').animate({scrollTop:0});
				$('#content_message').notify({status:result.status,message:result.message});
		 	}
		});		
	});	
});
</script>