<?php
 /**
# plugin 
# ------------------------------------------------------------------------
 # author    Open Source Code Solutions Co
 # copyright Copyright © 20011-2013 joomlaschetchik.ru. All Rights Reserved.
 # @license - http://www.gnu.org/licenses/gpl-3.0.html GNU/GPL or later.
 # Websites: http://joomlaschetchik.ru/
-------------------------------------------------------------------------*/
defined('_JEXEC') or die('Restricted access');

class plgSystemJvcounterInstallerScript {
   function install($parent) {
        $db = JFactory::getDbo();
        $query = "update #__extensions set enabled = 1  where element = 'jvcounter'";
        $db->setquery($query);
        if($db->query()){
            echo 'JV JQuery Libraries is enabled!';
        }
   }
}
?>
