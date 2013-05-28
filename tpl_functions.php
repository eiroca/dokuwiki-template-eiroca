<?php
// $conf['menu_id'];
// $conf['show_docID'];
// $conf['show_taglinePage'];
$conf['menu_id'] = 'menu';
$conf['show_docID'] = false;
$conf['show_taglinePage'] = true;
$conf['show_docInfo'] = true;


/**
 * eIrOcA Template Functions
 *
 * @license GPL 2 (http://www.gnu.org/licenses/gpl.html)
 * @author  Enrico Croce <enrico@eiroca.net>
 */
if (!defined('DOKU_INC')) die(); global $conf;
if (!defined('NL')) define('NL',"\n");

function tpl_WikiName($print=true) {
 global $conf;
 $title = strip_tags($conf['title']);
 if ($print) echo $title;
 return $title;
}

function tpl_WikiTitle() {
 tpl_WikiName();
 echo ' - ';
 tpl_pagetitle();
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
 global $conf;
 // get logo either out of the template images folder or data/media folder
 $logoSize = array();
 $logo = tpl_getMediaFile(array(':wiki:logo.png', ':logo.png', 'res/logo.png'), false, $logoSize);
 // display logo and wiki title in a link to the home page
 echo '<span class="logo_img">';
 tpl_link(wl(), '<img src="'.$logo.'" '.$logoSize[3].' alt="'.tpl_WikiName(false).'" />', 'accesskey="h" title="[H]"');
 echo '</span>'.NL;
}

function tpl_WikiTagLine() {
 global $conf;
 if ($conf['tagline']) {
  if ($conf['show_taglinePage']) {
   $tagline = tpl_include_page($conf['tagline'], false, false);
  }
  else {
   $tagline = hsc($conf['tagline']);
  }
  echo '<span class="tagline">'.$tagline.'</span>'.NL;
 }
}

function tpl_WikiDocID() {
 global $ID;
 global $conf;
 if (!$conf['show_docID']) $class=" hidden";
 echo'<span class="docID'.$class.'">'.hsc($ID).'</span>'.NL;
}

function tpl_WikiTOC() {
 echo '<span class="docTOC">';
 tpl_toc();
 echo '</span>'.NL;
}
function tpl_WikiDocInfo() {
 global $ID;
 global $conf;
 if (!$conf['show_docInfo']) $class=" hidden";
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
 $menu_id = $conf['menu_id'];
 if ($menu_id=="") return;
 $menu = tpl_include_page($menu_id, false, false);
 $num = preg_match_all('|<a\shref="(.*)"\s.*title="(.*)".*>(.*)</a>|U', $menu, $links, PREG_SET_ORDER);
 $me = wl($ID);
 echo '<span class="menu">';
 foreach($links as $item) {
  if (count($item)===4) {
   $url = $item[1];
   if (strpos($url, $me)===0) {
    $class = ' class="current"';
   }
   else {
    $class = '';
   }
   echo '<span class="menu item"><a href="'.$url.'"'.$class.' title="'.$item[2].'" rel="nofollow">'.$item[3].'</a></span>';
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
function tpl_homepage() {
 global $ID;
 $path  = explode(':', $ID);
 if (count($path)>1) {
  $id=$path[0].':start';
 }
 else { $id='start';
 }
 print wl($id);
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
 tpl_include_page($conf['sidebar'], 1, 1);
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
