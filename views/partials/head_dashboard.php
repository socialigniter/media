<style type="text/css">
/* Media Dashboard */
div.photo_album { float: left; margin: 0 45px 15px 0; }
div.photo_album ul li { margin: 5px 0; }

#photo_album 									{ display:block; padding:0 0 7px 5px; }
#photo_album.images li.media_item 				{ float:left; display:block; text-align:center; width:125px; min-height:125px; margin:14px 12px 0 12px; }
#photo_album.images ul img 						{ width:125px; height:125px; display:block; margin:0 0 5px 0; }

#photo_album ul.media_actions 					{ margin: 0; padding: 0px; position: relative; bottom: 5px; right: 5px; list-style: none; visibility: hidden ; }
#photo_album li.media_item:hover ul.media_actions { visibility: visible; }
#photo_album ul.media_actions li				{ float: left; margin: 6px 0px 0px 0px; padding:0 0 0 8px; }
#photo_album ul.media_actions li:first-child 	{ float:right; padding:0 8px 0 0;}
#photo_album ul.media_actions li a 				{ color: #999999; font-size: 12px; }
#photo_album ul.media_actions li a:visited 		{ color: #999999; font-size: 12px; }
#photo_album ul.media_actions li a:hover 		{ color: #2078ce; font-size: 12px; }
#photo_album li p 								{ margin:0;color:#666;text-shadow:#fff 1px 1px 1px; }
#photo_album span.actions:first-child 			{ }
#photo_album span.actions 						{ top:-2px}
#photo_album .cancel 							{ display:inline}
#photo_album .being_sorted						{ padding: 1px 0; border-radius: 15px; background:#f2e3af;}
#photo_album .inline_tip						{ position:absolute; background:#000; color:#fff; padding:5px; font-size:10px; opacity:0.8; text-shadow:none; display:none; border-radius:5px }

#photo_album p.album_description				{ margin: 0 0 5px 0; }
#photo_album p.album_details					{ color: #999999; margin: 0 0; text-shadow: 1px 1px 1px #ffffff; }


#gallery_title { width: 450px; }

#gallery_descriptions {float:left;width:430px;position:absolute;}
	#gallery_descriptions h3{ margin:0; }
	#gallery_descriptions p{ margin:5px 0 0 0; color:#666; text-shadow:#fff 1px 1px 1px; }
	
#fancybox-outer .editify {position:absolute;bottom:0;}

</style>
<script src="<?= $modules_assets ?>media.js"></script>