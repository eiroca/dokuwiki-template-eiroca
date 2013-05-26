<?php
/**
 * Based upon DokuWiki Default Template 2012
 * @license  GPL 2 (http://www.gnu.org/licenses/gpl.html)
 */
if (!defined('DOKU_INC')) die();
require_once(dirname(__FILE__).'/tpl_functions.php');
?>
<!DOCTYPE html>
<html lang="<?php echo $conf['lang']?>" dir="<?php echo $lang['direction'] ?>" class="popup no-js">
<head>
<?php tpl_includeFile('tpl_head.php') ?>
</head>
<body>
 <!--[if lte IE 7 ]><div id="IE7"><![endif]-->
 <!--[if IE 8 ]><div id="IE8"><![endif]-->
 <div id="media__manager" class="dokuwiki">
  <?php html_msgarea() ?>
  <div id="mediamgr__aside">
   <div class="pad">
    <h1>
     <?php echo hsc($lang['mediaselect'])?>
    </h1>
    <?php /* keep the id! additional elements are inserted via JS here */?>
    <div id="media__opts"></div>
    <?php tpl_mediaTree() ?>
   </div>
  </div>
  <div id="mediamgr__content">
   <div class="pad">
    <?php tpl_mediaContent() ?>
   </div>
  </div>
 </div>
 <!--[if ( lte IE 7 | IE 8 ) ]></div><![endif]-->
</body>
</html>
