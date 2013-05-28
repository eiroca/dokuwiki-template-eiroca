<?php
/**
 * configuration-manager metadata for the arctic-template
 * 
 * @license:    GPL 2 (http://www.gnu.org/licenses/gpl.html)
 * @author:     Michael Klier <chi@chimeric.de>
 */

$meta['pagename']                 = array('string', '_pattern' => '#[a-z0-9]*#');
$meta['user_sidebar_namespace']   = array('string', '_pattern' => '#^[a-z:]*#');
$meta['group_sidebar_namespace']  = array('string', '_pattern' => '#^[a-z:]*#');
$meta['main_sidebar_always']	    = array('onoff');

$meta['wiki_actionlinks']         = array('multichoice', '_choices' => array('links', 'buttons'));
$meta['left_sidebar_order']       = array('string', '_pattern' => '#[a-z0-9,]*#');
$meta['left_sidebar_content']     = array('multicheckbox', '_choices' => array('main','toc','user','group','namespace','toolbox','index','trace','extra'));

?>
