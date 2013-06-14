<?php
/**
 * eIrOcA Template Functions
 *
 * @license GPL 2 (http://www.gnu.org/licenses/gpl.html)
 * @author  Enrico Croce <enrico@eiroca.net>
 */
if (!defined('DOKU_INC')) die();
if (!defined('NL')) define('NL',"\n");

function startsWith($haystack,$needle,$case=true) {
 if($case) return strpos($haystack, $needle, 0) === 0;
 return stripos($haystack, $needle, 0) === 0;
}

function endsWith($haystack,$needle,$case=true) {
 $expectedPosition = strlen($haystack) - strlen($needle);
 if($case) return strrpos($haystack, $needle, 0) === $expectedPosition;
 return strripos($haystack, $needle, 0) === $expectedPosition;
}

function tpl_homepage($print=true) {
 global $ID;
 $path  = explode(':', $ID);
 if ((count($path)>1) && ($path[0]!=='tag')) {
  $home=wl($path[0].":start");
 }
 else {
  $home=wl("start");
 }
 if ($print) echo $home;
 return $home;
}

function tpl_WikiHeader() {
 global $conf;
 global $lang;
 echo '<!DOCTYPE html>'.NL;
 echo '<html lang="'.$conf['lang'].'" dir="'.$lang['direction'].'" class="no-js">'.NL;
}

function tpl_WikiName($print=true) {
 global $conf;
 $title = strip_tags($conf['title']);
 if ($print) echo $title;
 return $title;
}

function tpl_WikiTitle() {
 global $ID;
 global $conf;
 $nam = tpl_pagetitle($ID, true);
 $pos = strpos($nam, ":");
 if ($pos===false) {
  $__name = $nam;
 }
 else {
  $__name = substr($nam, $pos+1);
 }
 $start = $conf['start'];
 if (endsWith($__name, $start)) {
  $__name = trim(substr($__name, 0, strlen($__name) - strlen($start)));
 }
 if ($__name!='') {
  $__name = ' - '.ucwords(str_replace(":", " ", str_replace("_", " ", $__name)));
 }
 echo tpl_WikiName(false).$__name;
}

function tpl_WikiMessages() {
 global $MSG;
 if(isset($MSG)) {
  echo '<div class="message container smooth_border desktop-only">';
  html_msgarea();
  echo'</div>'.NL;
 }
}

function tpl_WikiLogo() {
 // get logo either out of the template images folder or data/media folder
 $logoSize = array();
 $logo = tpl_getMediaFile(array(':wiki:logo.png', ':logo.png', 'res/logo.png'), false, $logoSize);
 // display logo and wiki title in a link to the home page
 echo '<span class="logo_img">';
 tpl_link(tpl_homepage(false), '<img src="'.$logo.'" '.$logoSize[3].' alt="'.tpl_WikiName(false).'" />', 'accesskey="h" title="[H]"');
 echo '</span>'.NL;
}

function tpl_WikiTagLine() {
 global $conf;
 if ($conf['tagline']) {
  if (tpl_getConf('show_taglinePage')) {
   $tagline = tpl_include_page($conf['tagline'], false, true);
  }
  else {
   $tagline = hsc($conf['tagline']);
  }
  echo '<span class="tagline">'.$tagline.'</span>'.NL;
 }
}

function tpl_WikiDocID() {
 global $ID;
 if (!tpl_getConf('show_docID')) $class=' hidden';
 echo'<span class="docID'.$class.'">'.hsc($ID).'</span>'.NL;
}

function tpl_WikiTOC() {
 echo '<span class="docTOC">';
 tpl_toc();
 echo '</span>'.NL;
}
function tpl_WikiDocInfo() {
 global $ID;
 if (!tpl_getConf('show_docInfo')) $class=' hidden';
 echo'<span class="docInfo'.$class.'">';
 tpl_pageinfo();
 echo '</span>'.NL;
}

function tpl_WikiDocData() {
 echo '<span class="docData">';
 tpl_content(false);
 echo '</span>'.NL;
}

function tpl_WikiMenu() {
 global $ID;
 global $conf;
 $menu_id = tpl_getConf('menu_id');
 if ($menu_id=='') return;
 $menu = tpl_include_page($menu_id, false, true);
 $num = preg_match_all('|<a\shref="(.*)"\s.*title="(.*)".*>(.*)</a>|U', $menu, $links, PREG_SET_ORDER);
 $start = $conf['start'];
 $start_len = strlen($start);
 $me = wl($ID);
 echo '<span class="menu">';
 foreach($links as $item) {
  if (count($item)===4) {
   $url = $item[1];
   $expectedPosition = strlen($url) - $start_len;
   if (strrpos($url, $start, 0) === $expectedPosition) {
    $url = substr($url, 0, $expectedPosition-1);
   }
   if (strpos($me, $url)===0) {
    $class = ' class="current"';
   }
   else {
    $class = '';
   }
   echo '<span class="menu item"'.$class.'><a href="'.$item[1].'"'.$class.' title="'.$item[2].'" rel="nofollow">'.$item[3].'</a></span>';
   $class="";
  }
 }
 echo '</span>'.NL;
}
function tpl_WikiSearch() {
 echo '<span class="search">';
 tpl_searchform();
 echo '</span>'.NL;
}

function tpl_A11Y($section=null) {
 global $lang;
 tpl_flush();
 if ($section!=null){
  echo '<ul class="a11y skip"><li><a href="#dokuwiki__content">'.$lang[$section].'</a></li></ul>'.NL;
 }
 else{
  echo '<hr class="a11y" />'.NL;
 }
}

function tpl_WikiSidebar(){
 global $conf;
 global $ACT;
 $sidebarID = page_findnearest($conf['sidebar']);
 if ($sidebarID) {
  tpl_include_page($sidebarID, true, false);
 }
}

function tpl_WikiYouAreHere() {
 global $conf;
 if($conf['youarehere']) {
  echo '<span class="youarehere">';
  tpl_youarehere();
  echo '</span>'.NL;
 }
}

function tpl_WikiBreadCrumbs() {
 global $conf;
 if($conf['breadcrumbs']) {
  echo '<span class="breadcrumbs">';
  tpl_breadcrumbs();
  echo '</span>'.NL;
 }
}

function tpl_WikiUser() {
 if ($_SERVER['REMOTE_USER']) {
  echo '<span class="user">';
  tpl_userinfo();
  echo '</span>'.NL;
 }
}

function tpl_WikiTools() {
 echo' <span class="tools">';
 tpl_actiondropdown($lang['tools']);
 echo' <span class="actionTop">';
 tpl_action('top', 1, '', 0, '', ''. '');
 echo '</span>';
 echo '</span>'.NL;
}

function tpl_WikiLicence() {
 global $__lang;
 echo' <span class="licence">';
 tpl_pagelink($__lang."copyright", "Copyright (c) eIrOcA 2001-2013");
 echo '</span>'.NL;
}
