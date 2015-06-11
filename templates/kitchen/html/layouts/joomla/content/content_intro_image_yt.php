<?php
/**
 * @package     Joomla.Site
 * @subpackage  Layout
 *
 * @copyright   Copyright (C) 2005 - 2013 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;
?>
<?php $images = json_decode($displayData->images);
	  $params = $displayData->params;
 ?>
	<?php $imgfloat = (empty($images->float_intro)) ? $params->get('float_intro') : $images->float_intro; ?>
	<div class="pull-<?php echo htmlspecialchars($imgfloat); ?> item-image-yt"> 
	<a href="<?php echo JRoute::_(ContentHelperRoute::getArticleRoute($displayData->slug, $displayData->catid)); ?>">
	<img
	<?php if ($images->image_intro_caption):
		echo 'class="caption"'.' title="' .htmlspecialchars($images->image_intro_caption) .'"';
	endif; ?>
	src="http://img.youtube.com/vi/<?php echo htmlspecialchars($images->video_fulltext); ?>/1.jpg" alt="<?php echo htmlspecialchars($images->image_intro_alt); ?>"/> </a> </div>

