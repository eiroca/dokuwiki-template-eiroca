<?php
/**
 * Default configuration for the arctic template
 * 
 * @license:    GPL 2 (http://www.gnu.org/licenses/gpl.html)
 * @author:     Michael Klier <chi@chimeric.de>
 */

$conf['pagename']                   = 'sidebar';                    // the pagename for sidebars inside namespaces
$conf['user_sidebar_namespace']     = 'user';                       // namespace to look for namespace of logged in users
$conf['group_sidebar_namespace']    = 'group';                      // namespace to look for groups-namespaces
$conf['main_sidebar_always']	    = 1;			    // show main sidebar on all namespaces

$conf['wiki_actionlinks']           = 'links';                      // use buttons instead of links
$conf['left_sidebar_content']       = 'main,user,group,namespace';  // defines the content of the left sidebar
$conf['left_sidebar_order']         = 'main,namespace,user,group';  // defines the order of the left sidebar content

//Setup vim: ts=2 sw=2:
?>
