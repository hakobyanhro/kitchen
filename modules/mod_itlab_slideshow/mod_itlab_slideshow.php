<?php

/**
 * @copyright	Copyright (C) 2013 Itlab. All rights reserved.
 *
 * @license		GNU General Public License version 2 or later
 */

defined('_JEXEC') or die;


//add stylesheet

$doc =& JFactory::getDocument();


//include the class of the syndicate functions only once

$module_id	= $module->id;

require_once(dirname(__FILE__).'/helper.php');

//keeps module class suffix even if templateer tries to stop it

$moduleclass_sfx = htmlspecialchars($params->get('moduleclass_sfx'));

$listofimages = mod_itlab_slideshowHelper::getImages($params);

require(JModuleHelper::getLayoutPath('mod_itlab_slideshow'));