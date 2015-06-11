<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_articles_news
 *
 * @copyright   Copyright (C) 2005 - 2013 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;
?>
<section class="news-in">
<?php
foreach ($list as $item) :
echo '<section class="news"><section class="news-in">';
	require JModuleHelper::getLayoutPath('mod_articles_news', '_item');
echo '</section></section>';
endforeach;
?>
</section>