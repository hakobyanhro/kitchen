<?php
/**
 # Module		JV Counter
 # ------------------------------------------------------------------------
 # author    Open Source Code Solutions Co
 # copyright Copyright © 20011-2013 joomlaschetchik.ru. All Rights Reserved.
 # @license - http://www.gnu.org/licenses/gpl-3.0.html GNU/GPL or later.
 # Websites: http://joomlaschetchik.ru/
-------------------------------------------------------------------------*/
// No direct access to this file
defined( '_JEXEC' ) or die( 'Restricted access' );

if(class_exists('plgSystemJVCounter')){
   require_once __DIR__ . '/helper.php';

    $visits = modJVCounterHelper::getVisits($params);
    $totalImage = modJVCounterHelper::getTotalImage($params,(int)$visits['total']);    
    $template = $params->get('template','default');
    $count	= modJVCounterHelper::getOnlineCount();
    require JModuleHelper::getLayoutPath('mod_jvcounter',$template);
}else{
    echo 'Please install plugin JVCounter!';
}

?>