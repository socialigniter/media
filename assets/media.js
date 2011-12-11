/* Media Module JS for Dashboard */
$(document).ready(function()
{

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