<?php
/*
# ------------------------------------------------------------------------
# Extensions for Joomla 2.5.x - Joomla 3.x
# ------------------------------------------------------------------------
# Copyright (C) 2011-2015 Ext-Joom.com. All Rights Reserved.
# @license - PHP files are GNU/GPL V2.
# Author: Ext-Joom.com
# Websites:  http://www.ext-joom.com 
# Date modified: 27/11/2014 - 13:00
# ------------------------------------------------------------------------
*/

// no direct access
defined('_JEXEC') or die;

$html  = '<div class="ext-mod-social-buttons">';	

// Facebook    !!! HTML 5 !!!
if ($ext_fb > 0) {
			
$html .= <<<EXT
<div style="float: left; margin-right:5px; ">
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/$ext_fb_lang/all.js#xfbml=1";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
EXT;

$html .= '<div class="fb-like" data-width="'.$ext_fb_data_width.'" data-height="'.$ext_fb_data_height.'" data-colorscheme="'.$ext_fb_color_scheme.'" data-layout="'.$ext_fb_layout.'" data-action="'.$ext_fb_data_action.'" data-show-faces="'.$ext_fb_show_faces.'" data-send="'.$ext_fb_data_send.'"></div></div>';
}

// Twitter Tweet 			
if ($ext_twitter > 0) {
	if ($ext_twitter_via != '') {
		$ext_twitter_via = 'data-via="'.$ext_twitter_via.'"';
	} else {
			$ext_twitter_via = '';
		}
	if ($ext_twitter_related != '') {				
		$ext_twitter_related= 'data-related="'.$ext_twitter_related.'"';
	} else {
			$ext_twitter_related = '';
		}
	if($ext_twitter_hashtags != '') {	
		$ext_twitter_hashtags = 'data-hashtags="'.$ext_twitter_hashtags.'"';
	} else {
			$ext_twitter_hashtags = '';
		}				
	$html .= '<div style="float: left; margin-right:5px; "><a rel="nofollow" href="https://twitter.com/share" class="twitter-share-button" data-count="'.$ext_twitter_data_count.'" '.$ext_twitter_via.' data-lang="'.$ext_twitter_lang.'" '.$ext_twitter_related.' '.$ext_twitter_hashtags.'>Tweet</a>';
}

// Twitter Follow 
if ($ext_twitter_follow > 0) {			
	$html .= '<div style="float: left; margin-right:5px; "><a rel="nofollow" href="https://twitter.com/'.$ext_twitter_name.'" class="twitter-follow-button" data-show-count="'.$ext_twitter_show_count.'" data-lang="'.$ext_twitter_lang.'" data-show-screen-name="'.$ext_twitter_screen_name.'" data-width="'.$ext_twitter_data_width.'px">Follow</a></div>';
}
	
if ( $ext_twitter > 0 OR $ext_twitter_follow > 0 ) {
	$html .= "<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script></div>";
}

// Google +1
if ($ext_google > 0) {			
	if ($ext_google_annotation == 'inline') {
		$google_annotation_width='data-width="'.$ext_google_width.'"';
	} else {
			$google_annotation_width='';
		}
	$html.='<div style="float: left; margin-right:5px; ">
				<div class="g-plusone" data-size="'.$ext_google_type.'" data-annotation="'.$ext_google_annotation.'" '.$google_annotation_width.'></div>
				<script type="text/javascript">
				  window.___gcfg = {lang: "'.$ext_google_lang.'"};
					(function() {
						var po = document.createElement("script"); po.type = "text/javascript"; po.async = true;
						po.src = "https://apis.google.com/js/plusone.js";
						var s = document.getElementsByTagName("script")[0]; s.parentNode.insertBefore(po, s);
					})();
				</script>
			</div>'; 
}				

// linkedin
if($ext_linkedin > 0){				
	if ($ext_link_data_counter != 'none') {			
		$ext_link_data_counter = 'data-counter="'.$ext_link_data_counter.'"';
	}				
	$html .='<div style="float: left; margin-right:5px; ">
				<script src="//platform.linkedin.com/in.js" type="text/javascript">
				lang: '.$ext_in_language.'
				</script>
				<script type="IN/Share" '.$ext_link_data_counter.'></script>
			</div>'; 
}

// Vk	
if($ext_vk > 0 ){ 			
$html .='<div style="float: left; margin-right:5px; ">
			<script type="text/javascript" src="//vk.com/js/api/openapi.js"></script><script type="text/javascript">VK.init({apiId: '.$ext_vk_api_id.', onlyWidgets: true});</script>				
			<div id="vk_like"></div>
			<script type="text/javascript">VK.Widgets.Like("vk_like", {type: "'.$ext_vk_type.'", verb: '.$ext_vk_verb.', height: '.$ext_vk_height.'});</script>
		</div>';	
} 		

$html  .= '</div>';
?>

<div class="mod-social-buttons <?php echo $moduleclass_sfx; ?>">	
	<?php echo $html; ?>
	<div style="clear:both;"></div>
</div>