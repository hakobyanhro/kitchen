<?php
/**
 * @copyright	submit-templates.com
 * @license		GNU General Public License version 2 or later;
 */
?>
<div class="st-news-horizonal">
	<div class="row-fluid">
		<?php if ($params->get('news_horizonal_pre_text') != ''): ?>
			<div class="span3">
				<div class="pre-text">
					<?php echo html_entity_decode($params->get('news_horizonal_pre_text')); ?>	
				</div>
			</div>
		<?php endif; ?>
	
		<?php if ($params->get('news_horizonal_pre_text') != ''): ?>
			<div class="span9">
		<?php endif; ?>
			<div class="contents">
				<?php $newrow = true; ?>
				<?php foreach ($list as $k => $item) :?>
					<?php if ($newrow) {
						echo '<div class="row-fluid items">';				
					}?>
					<div class="span<?php echo $params->get('news_horizonal_cols') ?>">
						<div class="inner">
							<?php if ($params->get('news_horizonal_image')): ?>
								<div class="image">
									<a href="<?php echo $item->link;?>">
										<img src="<?php echo htmlspecialchars($item->image_intro); ?>"  alt="<?php echo htmlspecialchars($item->title); ?>"/>
									</a>	
								</div>
							<?php endif; ?>
							
							<?php if ($params->get('title')): ?>
								<h3 class="title">
								<?php if ($item->link != '') : ?>
								<a href="<?php echo $item->link;?>">
										<?php echo $item->title;?></a>
								<?php else : ?>
									<?php echo $item->title; ?>
								<?php endif; ?>
								</h3>
							<?php endif ?>
							
							<?php
								if (isset($item->created) && $params->get('news_horizonal_date')) {
									echo '<div class="date">' . JHTML::_('date', $item->created, JText::_('DATE_FORMAT_LC4')) . '</div>';
								}
							?>
							
							<?php if ($params->get('introtext')): ?>
								<div class="news-short"><?php echo ($params->get('introtext_length') > 0) ? substr(strip_tags($item->introtext), 0 , $params->get('introtext_length')) : strip_tags($item->introtext); ?>...
									<?php if ($item->link != '') : ?>
										<?php if ($params->get('news_horizonal_readmore') != ''): ?>
											<a class="readmore" href="<?php echo $item->link;?>"><?php echo $params->get('news_horizonal_readmore'); ?><img src="templates/sambo/images/read-more-img.png" alt="read-more-img" /></a>	
											
										<?php endif; ?>
									<?php endif; ?>
								</div>
								
							<?php endif; ?>	
							
						</div>
					</div>
					<?php  if (($k + 1) % (12/$params->get('news_horizonal_cols')) < 1 || $k+1 == count($list)) {
						echo '</div>';
						$newrow = true;		
					} else {
						$newrow = false;
					}	
					?>
				<?php endforeach; ?>
			</div>
		<?php if ($params->get('news_horizonal_pre_text') != ''): ?>
			</div>
		<?php endif; ?>
	</div>
</div>