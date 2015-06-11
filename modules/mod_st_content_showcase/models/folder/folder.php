<?php
/**
 * @copyright	submit-templates.com
 * @license		GNU General Public License version 2 or later;
 */

// no direct access
defined('_JEXEC') or die;

class stContentShowcaseModelFolder extends stContentShowcaseModel {
	
	public function  getCategories () 
	{
		return $folders = $this->_params->get('folder_category', array());	
	}	
	public function _items() 
	{
		parent::_items();
		$items = array();
		$params = $this->_params;
			
		if ($params->get('folder_sync', 0)) 
		{
			$folders = $params->get('folder_category', array());
			
			foreach ($folders as $key => $value) 
			{
				$files = JFolder::files(JPATH_ROOT.'/'.$value, '(.jpg|.png|.jpeg|.gif)$');
				
				foreach ($files as $k => $file) 
				{
					if (count($items) > $params->get('count', 10)) {
						break;
					}
					$filePart = pathinfo($file);
					$item = new stdClass;
					$item->title = $filePart['filename'];
					$item->image = JURI::root().$value."/".$file;
					$item->image_intro = $item->image;
					$item->image_intro_caption = $file;
					$item->image_intro_alt = $file;
					$item->image_large = $item->image;
					$item->link = "";
					$item->introtext = $file;
					$item->category = $value;
					$items[] = $item;
				}
			}
		} 
		else 
		{
			$images = $params->get('folder_image');
			$titles = $params->get('folder_ititle');
			$intros  = $params->get('folder_iintrotext');
			
			foreach ($images as $key => $value) 
			{
				if ($value) 
				{
					if (count($items) > $params->get('count', 10)) {
						break;
					}
					$item  = new stdClass;
					$item->title = $titles[$key];
					$item->image = JURI::root().$value;
					$item->image_intro = $item->image;
					$item->image_intro_caption = $titles[$key];
					$item->image_intro_alt = $titles[$key];
					$item->image_large = $item->image;
					$item->link = "";
					$item->introtext = $intros[$key];
					$item->category = dirname($value);
					$items[] = $item;
				}
		    }
		}
		
		return $items;
	}
}
