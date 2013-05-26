<?php
/**
 * Based upon DokuWiki Default Template 2012
 * @license  GPL 2 (http://www.gnu.org/licenses/gpl.html)
 */
if (!defined('DOKU_INC')) die(); /* must be run from within DokuWiki */
require_once(dirname(__FILE__).'/tpl_functions.php');
$hasSidebar = page_findnearest($conf['sidebar']);
$showSidebar = $hasSidebar && ($ACT=='show');
?>
<!DOCTYPE html>
<html lang="<?php echo $conf['lang'] ?>" dir="<?php echo $lang['direction'] ?>" class="no-js">
<head>
<meta charset="utf-8" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width,initial-scale=1" />
<!--[if IE]><meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" /><![endif]-->
<?php echo tpl_favicon(array('favicon', 'mobile', 'generic')) ?>
<?php tpl_metaheaders() ?>
<title><?php tpl_WikiName() ?> - <?php tpl_pagetitle() ?></title>
<script>(function(H){H.className=H.className.replace(/\bno-js\b/,'js')})(document.documentElement)</script>
</head>
<body>
 <!--[if lte IE 7 ]><div id="IE7"><![endif]-->
 <!--[if IE 8 ]><div id="IE8"><![endif]-->
 <?php global $MSG; if(isset($MSG)): ?>
 <div class="message container smooth_border desktop-only">
  <?php html_msgarea(); ?>
 </div>
 <?php endif; ?>
 <div id="dokuwiki__top" class="page container dokuwiki">
  <div class="header container">
   <ul class="a11y skip">
    <li><a href="#dokuwiki__content"><?php echo $lang['skip_to_content']; ?> </a></li>
   </ul>
   <div class="logo">
    <?php
    // get logo either out of the template images folder or data/media folder
    $logoSize = array();
    $logo = tpl_getMediaFile(array(':wiki:logo.png', ':logo.png', 'res/logo.png'), false, $logoSize);
    // display logo and wiki title in a link to the home page
    tpl_link(wl(), '<img src="'.$logo.'" '.$logoSize[3].' alt="'.tpl_WikiName(false).'" />', 'accesskey="h" title="[H]"');
    if ($conf['tagline']) echo "<p id=\"headline\">".$conf['tagline']."</p>";
    ?>
   </div>
   <div class="navigation smooth_border">
    <?php tpl_WikiMenu(); ?>
   </div>
   <div class="search smooth_border">
    <div class="docId">
     <span>
      <?php global $ID; echo hsc($ID) ?>
     </span>
    </div>
    <?php tpl_searchform(); ?>
   </div>
   <hr class="a11y" />
  </div>
  <div class="content container">
   <div id="dokuwiki__content" class="data">
    <a id="dokuwiki__top"></a>
    <div class="docData">
     <?php tpl_flush() ?>
     <?php tpl_toc() ?>
     <?php tpl_content(false) ?>
    </div>
    <div class="docInfo hidden">
     <?php tpl_pageinfo() ?>
    </div>
    <?php tpl_flush() ?>
    <hr class="a11y" />
   </div>
   <div class="sidebar smooth_border">
     <?php tpl_include_page($conf['sidebar'], 1, 1); ?>
   </div>
  </div>
 </div>
 <div class="footer container">
  <div id="footerInfo group">
   <?php if($conf['youarehere']): ?>
   <div class="youarehere">
    <?php tpl_youarehere() ?>
   </div>
   <?php endif ?>
   <?php if($conf['breadcrumbs']): ?>
   <div class="breadcrumbs">
    <?php tpl_breadcrumbs() ?>
   </div>
   <?php endif ?>
  </div>
  <div class="tools group">
   <h3 class="a11y">
    <?php echo $lang['site_tools']; ?>
   </h3>
   <?php
   if ($_SERVER['REMOTE_USER']) {
     echo '<div class="user">';
     tpl_userinfo();
     echo '</div>';
   }
   ?>
   <div class="ActionTop">
    <?php tpl_action('top', 1, '', 0, '', ''. ''); ?>
   </div>
   <div class="Tools">
    <?php tpl_actiondropdown($lang['tools']); ?>
   </div>
   <hr class="a11y" />
  </div>
  <div class="licence"> <?php global $__lang; tpl_pagelink($__lang."copyright", "Copyright (c) eIrOcA 2001-2013") ?></div>
 </div>
 <!--[if ( lte IE 7 | IE 8 ) ]></div><![endif]-->
 <div class="no">
  <?php tpl_indexerWebBug() ?>
 </div>
 <div id="screen__mode" class="no"></div>
</body>
</html>
