<?php
/**
* News class
* @package News Show Pro GK4
* @Copyright (C) 2009-2011 Gavick.com
* @ All rights reserved
* @ Joomla! is Free Software
* @ Released under GNU/GPL License : http://www.gnu.org/copyleft/gpl.html
* @version $Revision: GK4 1.0 $
**/
// no direct access
defined('_JEXEC') or die('Restricted access');
class NSP_GK4_Joomla_Source {	
	// Method to get sources of articles
	function getSources($config) {
		//
		$db = JFactory::getDBO();
		// if source type is section / sections
		$source = false;
		$where1 = '';
		$where2 = '';
		//
		if($config['data_source'] == 'com_categories'){
			$source = $config['com_categories'];
			$where1 = ' c.id = ';
			$where2 = ' OR c.id = ';
		} else {
			$source = strpos($config['com_articles'],',') !== false ? explode(',', $config['com_articles']) : $config['com_articles'];
			$where1 = ' content.id = ';
			$where2 = ' OR content.id = ';	
		}
		//	
		$where = ''; // initialize WHERE condition
		// generating WHERE condition
		for($i = 0;$i < count($source);$i++){
			if(count($source) == 1) $where .= (is_array($source)) ? $where1.$source[0] : $where1.$source;
			else $where .= ($i == 0) ? $where1.$source[$i] : $where2.$source[$i];		
		}
		//
		$query_name = '
			SELECT DISTINCT 
				c.id AS CID
			FROM 
				#__categories AS c
			LEFT JOIN 
				#__content AS content 
				ON 
				c.id = content.catid 	
			WHERE 
				( '.$where.' ) 
				AND 
				c.extension = '.$db->quote('com_content').'
				AND 
				c.published = 1
            ';	
		// Executing SQL Query
		$db->setQuery($query_name);
		//
		return $db->loadObjectList();
	}
	// Method to get articles in standard mode 
	function getArticles($categories, $config, $amount) {	
		//
		$sql_where = '';
		//
		if($categories) {		
			$j = 0;
			// getting categories ItemIDs
			foreach ($categories as $item) {
				$sql_where .= ($j != 0) ? ' OR content.catid = '.$item->CID : ' content.catid = '.$item->CID;
				$j++;
			}	
		}
		// Overwrite SQL query when user set IDs manually
		if($config['data_source'] == 'com_articles' && $config['com_articles'] != ''){
			// initializing variables
			$sql_where = '';
			$ids = explode(',', $config['com_articles']);
			//
			for($i = 0; $i < count($ids); $i++ ){	
				// linking string with content IDs
				$sql_where .= ($i != 0) ? ' OR content.id = '.$ids[$i] : ' content.id = '.$ids[$i];
			}
		}
		// Arrays for content
		$content_id = array();
		$content_iid = array();
		$content_cid = array();
		$content_title = array();
		$content_text = array();
		$content_date = array();
		$content_date_publish = array();
		$content_author = array();
		$content_catname = array();
		$content_hits = array();
		$content_email = array();
		$content_rating_sum = array();
		$content_rating_count = array();
		$content_images = array();
		$news_amount = 0;
		// Initializing standard Joomla classes and SQL necessary variables
		$db = JFactory::getDBO();
		$user = JFactory::getUser();
		$authorised = $user->getAuthorisedViewLevels();
		$access = JComponentHelper::getParams( 'com_content' )->get('show_noauth');
		if($config['unauthorized']) {
			$access_con = '';
		} else {
			$access_con = ' AND content.access IN ('. implode(',', $user->getAuthorisedViewLevels()) .') ';
		}
		$date = JFactory::getDate($config['time_offset'].' hour '.date('Y-m-d', strtotime('now')));
		$now  = $date->toSql(true);
		$nullDate = $db->getNullDate();
		
		
		
		// if some data are available
		if(count($categories) > 0){
			// when showing only frontpage articles is disabled
			$frontpage_con = ($config['only_frontpage'] == 0) ? (($config['news_frontpage'] == 0) ? ' AND frontpage.content_id IS NULL ' : '' ) : (($config['news_frontpage'] == 0) ? ' AND frontpage.content_id = 10 ' : ' AND frontpage.content_id IS NOT NULL ' );
			$since_con = '';
			if($config['news_since'] !== '') $since_con = ' AND content.created >= ' . $db->Quote($config['news_since']);
			// Ordering string
			$order_options = '';
			// When sort value is random
			if($config['news_sort_value'] == 'random') {
				$order_options = ' RAND() '; 
			}else{ // when sort value is different than random
				if($config['news_sort_value'] != 'fordering') $order_options = ' content.'.$config['news_sort_value'].' '.$config['news_sort_order'].' ';
				else $order_options = ' frontpage.ordering '.$config['news_sort_order'].' ';
			}	
			// language filters
			$lang_filter = '';
			if (JFactory::getApplication()->getLanguageFilter()) {
				$lang_filter = ' AND content.language in ('.$db->quote(JFactory::getLanguage()->getTag()).','.$db->quote('*').') ';
			}
			
			if($config['data_source'] != 'com_all_articles') {
				$sql_where = ' AND ( ' . $sql_where . ' ) ';
			}			// creating SQL query
			$query_news = '
			SELECT
				content.id AS IID,
				'.($config['use_title_alias'] ? 'content.alias' : 'content.title').' AS title,
				content.introtext AS text, 
				content.created AS date, 
				content.publish_up AS date_publish,
				content.hits AS hits,
				content.images AS images	
			FROM 
				#__content AS content 
			WHERE 
				content.state = 1
                    '. $access_con .' 
			 		AND ( content.publish_up = '.$db->Quote($nullDate).' OR content.publish_up <= '.$db->Quote($now).' )
					AND ( content.publish_down = '.$db->Quote($nullDate).' OR content.publish_down >= '.$db->Quote($now).' )
				'.$sql_where.'
				'.$lang_filter.'
				'.$since_con.'
			ORDER BY 
				'.$order_options.'
			LIMIT
				'.($config['startposition']).','.($amount + (int)$config['startposition']).';
			';
			
			
			// run SQL query
			$db->setQuery($query_news);
			// when exist some results
			if($news = $db->loadObjectList()) {
				// generating tables of news data
				foreach($news as $item) {						
				    $id = $item->ID;
					if (!($access || in_array($item->access, $authorised))) { $id = 0; }
					$content_iid[] = $item->IID; // news IDs
					$content_title[] = $item->title; // news titles
					$content_text[] = $item->text; // news text;
					$content_date[] = $item->date; // news dates
					$content_date_publish[] = $item->date_publish; // news dates
					$content_hits[] = $item->hits; // news hits
					$content_images[] = $item->images; // news images
 					$news_amount++;	// news amount
				}
			}
			
			
			// generate SQL WHERE condition
			$second_sql_where = '';
			for($i = 0; $i < count($content_iid); $i++) {
				$second_sql_where .= (($i != 0) ? ' OR ' : '') . ' content.id = '.$content_iid[$i];
			}	
			// second SQL query to get rest of the data and avoid the DISTINCT
			$second_query_news = '
			SELECT
				categories.title AS cat, 
				content.id AS ID,
				content.access AS access,
				categories.title AS cat, 
				users.email AS author_email,
				'.$config['username'].' AS author,
				content_rating.rating_sum AS rating_sum,
				content_rating.rating_count AS rating_count,
				categories.id AS CID	
			FROM 
				#__content AS content 
				LEFT JOIN 
					#__categories AS categories 
					ON categories.id = content.catid 
				LEFT JOIN 
					#__content_frontpage AS frontpage 
					ON content.id = frontpage.content_id  	
				LEFT JOIN 
					#__users AS users 
					ON users.id = content.created_by 			
				LEFT JOIN 
					#__content_rating AS content_rating 
					ON content_rating.content_id = content.id
			WHERE 
				'.$second_sql_where.'
				'.$frontpage_con.'
				 AND categories.published = 1 
			ORDER BY 
				'.$order_options.'
			';
			// run the query
			$db->setQuery($second_query_news);
			// when exist some results
			if($news2 = $db->loadObjectList()) {
				// generating tables of news data
				foreach($news2 as $item) {						
				    $pos = array_search($item->ID, $content_iid);
				    $id = $item->ID;
					if (!($access || in_array($item->access, $authorised))) { $id = 0; }
			        $content_id[$pos] = $id; // news IDs
					$content_cid[$pos] = $item->CID; // news CIDs
					$content_author[$pos] = $item->author; // news author
					$content_catname[] = $item->cat; // news category name
					$content_catname[$pos] = $item->cat; // news category name
					$content_email[$pos] = $item->author_email; // news author emails
					$content_rating_sum[$pos] = $item->rating_sum; // news rating sum
					$content_rating_count[$pos] = $item->rating_count; // news rating count
				}
			}		
			
		}
		// Returning data in hash table
		return array(
			"ID" => $content_id,
			"IID" => $content_iid,
			"CID" => $content_cid,
			"title" => $content_title,
			"text" => $content_text,
			"date" => $content_date,
			"date_publish" => $content_date_publish,
			"author" => $content_author,
			"catname" => $content_catname,
			"hits" => $content_hits,
			"email" => $content_email,
			"news_amount" => $news_amount,
			"rating_sum" => $content_rating_sum,
			"rating_count" => $content_rating_count,
			"images" => $content_images
		);
	}
}
/* EOF */