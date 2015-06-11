<?php
defined('_JEXEC') or die;
/*
 * xhtml (divs and font headder tags)
 */
function modChrome_xhtml_link($module, &$params, &$attribs)
{
	if (!empty ($module->content)) : ?>
		<?php if ((bool) $module->showtitle) : ?>
		<?php $categoryid = JRoute::_(ContentHelperRoute::getCategoryRoute($params->get('catid')));?>
		<section class="text-article-in">
			<section class="text-article">
				<h2 class="text-article-h"><img src="images/text-icona.png" alt="text-icona">
				<a href="<?php echo $categoryid ; ?>"><?php echo $module->title; ?></a>
				</h2>
			</section>
		</section>
			
		<?php endif; ?>
			<?php echo $module->content; ?>
		<?php endif;
}

function modChrome_xhtml_unlink($module, &$params, &$attribs)
{
	if (!empty ($module->content)) : ?>
		<?php if ((bool) $module->showtitle) : ?>
		<?php $categoryid = JRoute::_(ContentHelperRoute::getCategoryRoute($params->get('catid')));?>
		<section class="text-article-in">
			<section class="text-article">
				<h2 class="text-article-h"><img src="images/text-icona.png" alt="text-icona">
				<?php echo $module->title; ?>
				</h2>
			</section>
		</section>
			
		<?php endif; ?>
			<?php echo $module->content; ?>
		<?php endif;
}
