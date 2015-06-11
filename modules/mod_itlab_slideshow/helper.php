<?php

/**
 * @copyright	Copyright (C) 2012 JoomSpirit. All rights reserved.
 * Slideshow based on the JQuery script Flexslider
 * @license		GNU General Public License version 2 or later
 */

defined('_JEXEC') or die;

$target	= $params->get('target');

class mod_itlab_slideshowHelper{

    public function getImages(&$params){

        $imgsAndCaps = array();

        $i = 1;

        while($i < 22) :

            $listitem = array();

            if ($params->get('image'.$i)) {
                $listitem['image'] = $params->get('image'.$i);
                $listitem['target'] = $params->get('target');
                $listitem['customlink'] = $params->get('image'.$i.'customlink');
                $listitem['alt'] = $params->get('image'.$i.'alt');
                $listitem['cap'] = $params->get('image'.$i.'cap');
                $listitem['desc'] = $params->get('image'.$i.'desc');

                array_push($imgsAndCaps, $listitem);
            }


            $i++;

        endwhile;

        return $imgsAndCaps;

    }

    public function load_js(&$params, $module_id){
        $doc = &JFactory::getDocument();




    }

}