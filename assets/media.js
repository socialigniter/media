/* Media Module JS for Dashboard */
$(function()
{

	$('#image_list').dragsort({placeHolderTemplate:'<li class="media_item"></li>',dragEnd:function()
	{
		//If there isnt already a save button (i.e. moving more than one item)
		if($('[value=Save Order]').length < 1)
		{
			//Add the dashed lines...
			$('.drag_wrap').addClass('being_sorted');
			//Add the button and bind a click event
			$('#media_gallery').append('<input type="button" value="Save Order">')
			.find('[value=Save Order]').bind('click',function()
			{
				$('#content_message').notify({message:'Order has been saved via AJAX'});
				$('.drag_wrap').removeClass('being_sorted');
				$(this).remove();
			});
		}
	}
	
	//For the anchors around the images...
	}).find('a').click(function(){return false;});
	
	
	$('.action_see').parent().click(function(){
		img_src = $(this).parent().parent().parent().find('img').attr('src');
		$.fancybox({href:img_src,title:'Sample description here',titlePosition:'inside'});
	});
	

	
	$('#gallery_descriptions p').ellipsify({max:40}).hover(
		function(){
			$this = $(this);
			if($this.find('.inline_tip').length < 1){
				if(typeof $this.attr('data-title') == 'undefined')
				{
					$this.attr('data-title',$this.attr('title')).removeAttr('title');
				}
				timer = setTimeout(function()
				{
					$('<div/>',{
						"html":$this.attr('data-title')+'<br><span>Click to edit</span>',
						"class":'inline_tip'
					}).appendTo($this);
					
					$this.find('.inline_tip').fadeIn();
				},1000)
			}
		},
		function()
		{
			clearTimeout(timer);
			if($(this).find('.inline_tip').length > 0)
			{
				$(this).attr('title',$(this).attr('data-title')).removeAttr('data-title').find('.inline_tip').fadeOut(250,function()
				{
					$(this).remove();
				});
			}
		}
	);
});

$(document).ready(function()
{
	$(".images_fancybox").fancybox({
		'transitionIn'		: 'elastic',
		'transitionOut'		: 'elastic',
		'titlePosition' 	: 'over',
		'titleFormat'		: function(title, currentArray, currentIndex, currentOpts) {
			return '<span id="fancybox-title-over">Image ' + (currentIndex + 1) + ' / ' + currentArray.length + (title.length ? ' &nbsp; ' + title : '') + '</span>';
		}
	});

	// Image Uploader GOOD
	$('#media_gallery form').uploadify(
	{
		type		:'json',
		onUpload	:function()
		{
			$.fancybox({
				href	: base_url + 'images/shared/loader.gif',
				type	: 'image',
				showCloseButton: false
			});
		},
		afterUpload:function(json)
		{
			$.fancybox.close();
			$('#media_gallery .drag_wrap > ul').append('\
				<li class="media_item">\
					<a href="#fancybox"><img src="' + base_url + 'media/images/'+json.data.category_id+'/small_'+json.data.content+'"></a>\
					<ul class="media_actions" rel="">\
						<li><a href=""><span class="actions action_see"></span> View</a></li>\
						<li><a href=""><span class="actions action_edit"></span> Edit</a></li>\
					</ul>\
				</li>');				
		}
	});	
	
});