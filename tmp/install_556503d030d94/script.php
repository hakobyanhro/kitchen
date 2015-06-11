<?php
// ==============================================================================================
// Licensed under the GNU GPLv2 (LICENSE.txt)
// ==============================================================================================
// @author     WEBO Software (http://www.webogroup.com/)
// @version    0.1
// @copyright  Copyright &copy; 2013 Openstat, All Rights Reserved
// ==============================================================================================
// no direct access
defined('_JEXEC') or die('Restricted access');
include(dirname(__FILE__) . '/openstat.counter.api.php');
$openstatcounter_user =& JFactory::getUser();
openstat_counter_api_add($openstatcounter_user->get('email'), '', 'WEBO@Joomla! ' . JVERSION);

?>