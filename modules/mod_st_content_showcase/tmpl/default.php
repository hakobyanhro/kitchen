<?php
/**
 * @copyright	submit-templates.com
 * @license		GNU General Public License version 2 or later;
 */

// no direct access
defined('_JEXEC') or die;
jimport( 'joomla.filesystem.folder' );
$exts = JFolder::folders(ST_DIR_EXTS);

foreach ($exts as $ext) 
{
	if ($params->get('extension') == $ext) 
	{
		$viewFile = ST_DIR_EXTS.DIRECTORY_SEPARATOR.$ext.DIRECTORY_SEPARATOR.'site'.DIRECTORY_SEPARATOR.'default.php';
		if(is_file($viewFile)) {
			require $viewFile;
		}	
	} 
}
?>

