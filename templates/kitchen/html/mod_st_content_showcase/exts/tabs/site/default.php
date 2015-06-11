<?php
/**
 * @copyright	submit-templates.com
 * @license		GNU General Public License version 2 or later;
 */

// no direct access
defined('_JEXEC') or die;

if ($params->get('source') == 'article') 
{
	require_once JPATH_SITE.'/components/com_content/helpers/route.php';
	JModelLegacy::addIncludePath(JPATH_SITE.'/components/com_content/models', 'ContentModel');
	
	$app	= JFactory::getApplication();
	$db		= JFactory::getDbo();
	$result = array();
	// Get an instance of the generic articles model
	$model = JModelLegacy::getInstance('Articles', 'ContentModel', array('ignore_request' => true));
	
	// Set application parameters in model
	$appParams = JFactory::getApplication()->getParams();
	$model->setState('params', $appParams);

	// Set the filters based on the module params
	$model->setState('list.start', 0);
	$model->setState('list.limit', (int) $params->get('count', 5));

	$model->setState('filter.published', 1);

	$model->setState('list.select', 'a.fulltext, a.id, a.title, a.alias, a.title_alias, a.introtext, a.state, a.catid, a.created, a.created_by, a.created_by_alias,' .
		' a.modified, a.modified_by, a.publish_up, a.publish_down, a.images, a.urls, a.attribs, a.metadata, a.metakey, a.metadesc, a.access,' .
		' a.hits, a.featured');

	// Access filter
	//$access = !JComponentHelper::getParams('com_content')->get('show_noauth');
	$authorised = JAccess::getAuthorisedViewLevels(JFactory::getUser()->get('id'));
	//$model->setState('filter.access', $access);

	// Category filter
	
	$model->setState('filter.category_id', $params->get('article_catid', array()));

	// Filter by language
	$model->setState('filter.language', $app->getLanguageFilter());

	// Set ordering
	$ordering = $params->get('article_ordering', 'a.publish_up');
	
	$model->setState('list.ordering', 'a.hits');
	
	$model->setState('list.direction', 'DESC');
	
	//	Retrieve Content
	$items = $model->getItems();
	$db = $model->getDbo();
	
	$access = true;
	
	foreach ($items as &$item) 
	{
		$item->readmore = strlen(trim($item->fulltext));
		$item->slug = $item->id.':'.$item->alias;
		$item->catslug = $item->catid.':'.$item->category_alias;
		
		if ($access || in_array($item->access, $authorised))
		{
			// We know that user has the privilege to view the article
			$item->link = JRoute::_(ContentHelperRoute::getArticleRoute($item->slug, $item->catid));
			$item->linkText = JText::_('MOD_ARTICLES_NEWS_READMORE');
		}
		else {
			$item->link = JRoute::_('index.php?option=com_users&view=login');
			$item->linkText = JText::_('MOD_ARTICLES_NEWS_READMORE_REGISTER');
		}

		$item->introtext = JHtml::_('content.prepare', $item->introtext, '', 'mod_articles_news.content');
		
		$images = json_decode($item->images);
		
		
		if (!isset($images->image_intro) || empty($images->image_intro)) {
			if ($params->get('auto_find_image')) {
				preg_match('/<img[^>]*src=["|\']([^"|\']+)[^>]*>/', $item->introtext, $matchs);
				if (count($matchs)) {
					if ($matchs[1]) {
						$images->image_intro = $matchs[1];
					}
				}
			}
		}
		
		$item->introtext = preg_replace('/<img[^>]*>/', '', $item->introtext);
		
		if (isset($images->image_intro) and !empty($images->image_intro)) {
			$item->image_intro = $images->image_intro;
			$item->image_intro_caption = $images->image_intro_caption;
			$item->image_intro_alt = $images->image_intro_alt;
			$item->image_large = $images->image_intro;
		}
	}

	$result['hits'] = $items;
	
	$model->setState('list.ordering', 'a.publish_up');
	
	$model->setState('list.direction', 'DESC');
	
	//	Retrieve Content
	$items = $model->getItems();
	
	$access = true;
	
	foreach ($items as &$item) 
	{
		$item->readmore = strlen(trim($item->fulltext));
		$item->slug = $item->id.':'.$item->alias;
		$item->catslug = $item->catid.':'.$item->category_alias;
		
		if ($access || in_array($item->access, $authorised))
		{
			// We know that user has the privilege to view the article
			$item->link = JRoute::_(ContentHelperRoute::getArticleRoute($item->slug, $item->catid));
			$item->linkText = JText::_('MOD_ARTICLES_NEWS_READMORE');
		}
		else {
			$item->link = JRoute::_('index.php?option=com_users&view=login');
			$item->linkText = JText::_('MOD_ARTICLES_NEWS_READMORE_REGISTER');
		}

		$item->introtext = JHtml::_('content.prepare', $item->introtext, '', 'mod_articles_news.content');
		
		$images = json_decode($item->images);
		
		
		if (!isset($images->image_intro) || empty($images->image_intro)) {
			if ($params->get('auto_find_image')) {
				preg_match('/<img[^>]*src=["|\']([^"|\']+)[^>]*>/', $item->introtext, $matchs);
				if (count($matchs)) {
					if ($matchs[1]) {
						$images->image_intro = $matchs[1];
					}
				}
			}
		}
		
		$item->introtext = preg_replace('/<img[^>]*>/', '', $item->introtext);
		
		if (isset($images->image_intro) and !empty($images->image_intro)) {
			$item->image_intro = $images->image_intro;
			$item->image_intro_caption = $images->image_intro_caption;
			$item->image_intro_alt = $images->image_intro_alt;
			$item->image_large = $images->image_intro;
		}
	}

	$result['latest'] = $items;
	
	$html = '<div class="st-content-tabs"><ul class="nav nav-tabs">';
	$html .= '<li><a href="#popular" data-toggle="tab">Popular</a></li>';
	$html .= '<li><a href="#latest" data-toggle="tab">Latest</a></li>';
	$html .= '</ul>';
	
	$html .= '<div class="tab-content">';
	
		$html .= '<div class="tab-pane active" id="popular">';
		
		foreach ($result['hits'] as $item) 
		{
			$html .= '<div class="outter"><div class="row-fluid">';
			
				$html .= '<div class="span4">';
				$html .= '<a href="'.$item->link.'"><img src="'.$item->image_intro.'"/></a>';
				$html .= '</div>';
				
				$html .= '<div class="span8">';
				$html .= '<a href="'.$item->link.'">'.$item->title.'</a>';
				$html .= '</div>';
				
			$html .= '</div></div>';
		}
			
		$html .= '</div>';
	
		$html .= '<div class="tab-pane active" id="latest">';
		
		foreach ($result['latest'] as $item) 
		{
			$html .= '<div class="outter"><div class="row-fluid">';
			
				$html .= '<div class="span4">';
				$html .= '<a href="'.$item->link.'"><img src="'.$item->image_intro.'"/></a>';
				$html .= '</div>';
				
				$html .= '<div class="span8">';
				$html .= '<a href="'.$item->link.'">'.$item->title.'</a>';
				$html .= '</div>';
				
			$html .= '</div></div>';
		}
		
		$html .= '</div>';
	
	
	$html .= '</div></div>';
	
	echo $html;
	
	$document = JFactory::getDocument();
	$document->addScriptDeclaration("
	
		jQuery.noConflict();
		(function($){
			$(document).ready(function(){
				$('.st-content-tabs ul.nav li a:first').tab('show');	
			});
		})(jQuery);
	");
}
