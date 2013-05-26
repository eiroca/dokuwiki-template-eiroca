<?php
/**
 * eIrOcA Template Functions
 *
 * @license GPL 2 (http://www.gnu.org/licenses/gpl.html)
 * @author  Enrico Croce <enrico@eiroca.net>
 */
if (!defined('DOKU_INC')) die(); global $conf;
if (!defined('LF')) define('LF',"\n");

function tpl_WikiMenu() {
 global $ID;
 $menu_id = $conf['title'];
 if ($menu_id=="") $menu_id='menu';
 $menu = tpl_include_page($menu_id, false, false);
 $num = preg_match_all('|<a\shref="(.*)"\s.*title="(.*)".*>(.*)</a>|U', $menu, $links, PREG_SET_ORDER);
 $me = wl($ID);
 echo '<ul>'.LF;
 foreach($links as $item) {
  if (count($item)===4) {
   $url = $item[1];
   if (strpos($url, $me)===0) {
    $class = ' class="current"';
   }
   else {
    $class = '';
   }
   echo "<li><a href=\"$url\"$class title=\"$item[2]\" rel=\"nofollow\">$item[3]</a></li>".LF;
   $class="";
  }
 }
 echo '</ul>'.LF;
}

function tpl_WikiName($print=true) {
 global $conf;
 $title = strip_tags($conf['title']);
 if ($print) echo $title;
 return $title;
}


function tpl_homepage() {
 global $ID;
 $path  = explode(':', $ID);
 if (count($path)>1) {   $id=$path[0].':start';  }
 else { $id='start'; }
 print wl($id);
}

?>
