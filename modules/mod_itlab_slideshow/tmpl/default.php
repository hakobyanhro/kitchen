<?php

/**
 * @copyright	Copyright (C) 2012 JoomSpirit. All rights reserved.
 * Slideshow based on the JQuery script Flexslider
 * @license		GNU General Public License version 2 or later
 */

defined('_JEXEC') or die;

?>

<section id="featured">
	<ul class="ui-tabs-nav">
		<?php $i=0; foreach($listofimages as $item){ ?>
<li class="ui-tabs-nav-item" id="nav-fragment-<?php echo $i; ?>">
         <a href="#fragment-<?php echo $i; ?>">
			<h2><?php echo $item['cap']; ?></h2>
				<span>
					<?php echo mb_substr(strip_tags($item['desc']), 0, 100); ?>
				</span>
             
		<?php echo '</a>'; ?>
</li>		
	
		<?php $i++;} ?>
	</ul>
	<?php $i = 0; foreach($listofimages as $item){ ?>
	<section id="fragment-1" class="ui-tabs-panel" style="">
		<img src="<?php echo $item['image'] ?>" alt="<?php echo $item['alt']; ?>" />
	</section>
	<?php $i++; } ?>
</section>


			