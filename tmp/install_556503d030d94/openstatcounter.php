<?php
// ==============================================================================================
// Licensed under the GNU GPLv2 (LICENSE.txt)
// ==============================================================================================
// @author     WEBO Software (http://www.webogroup.com/)
// @version    0.1
// @copyright  Copyright &copy; 2013 Openstat, All Rights Reserved
// ==============================================================================================
// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );
jimport('joomla.plugin.plugin');
include(dirname(__FILE__) . '/openstat.counter.api.php');

class plgSystemOpenstatCounter extends JPlugin {
/* insert code */
	function onAfterRender() {
		$app = JFactory::getApplication();
		if (!$this->params->get('openstatcountercode')) {
			$this->params->set('openstatcountercode', $_COOKIE['openstat_counter_id']);
			$db =& JFactory::getDBO();
			$db->setQuery("UPDATE #__extensions SET params='{\"openstatcountercode\":\"" . $_COOKIE['openstat_counter_id'] . "\"}' WHERE name='System - Openstat Counter'");
			$db->execute();
		}
		if (!$app->isAdmin()) {
			JResponse::setBody(preg_replace("!(</body>)!is", openstat_counter_api_code($this->params->get('openstatcountercode')) . "$1", JResponse::getBody()));
		}
	}
}