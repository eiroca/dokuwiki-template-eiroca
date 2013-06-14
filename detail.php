<?php
/**
 * Based upon DokuWiki Default Template 2012
 * @license  GPL 2 (http://www.gnu.org/licenses/gpl.html)
 */
if (!defined('DOKU_INC')) die(); /* must be run from within DokuWiki */
require_once(dirname(__FILE__).'/tpl_functions.php');
?>
<?php tpl_WikiHeader() ?>
<head>
<meta charset="utf-8" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width,initial-scale=1" />
<!--[if IE]><meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" /><![endif]-->
<?php echo tpl_favicon(array('favicon', 'mobile', 'generic')) ?>
<?php tpl_metaheaders() ?>
<title><?php tpl_WikiTitle() ?></title>
<script>(function(H){H.className=H.className.replace(/\bno-js\b/,'js')})(document.documentElement)</script>
</head>
<body>
 <!--[if lte IE 7 ]><div id="IE7"><![endif]-->
 <!--[if IE 8 ]><div id="IE8"><![endif]-->
 <?php tpl_WikiMessages() ?>
 <div id="dokuwiki__top" class="page container dokuwiki">
  <div class="header container">
   <?php tpl_A11Y('skip_to_content') ?>
   <div class="logo">
    <?php tpl_WikiLogo() ?>
    <?php tpl_WikiTagLine() ?>
    <?php tpl_WikiDocID() ?>
   </div>
   <div class="navigation smooth_border">
    <?php tpl_WikiMenu() ?>
    <?php tpl_WikiSearch() ?>
   </div>
   <?php tpl_A11Y() ?>
  </div>
  <div class="content dokuwiki fullwidth">
   <?php tpl_A11Y('content') ?>
   <div id="dokuwiki__content" class="WikiDetail">
    <?php if($ERROR){ 
     print $ERROR;
    }
    else{ ?>
    <div class="image">
     <a href="#" onclick="history.go(-1)"><?php tpl_img(0,0,false,array(id=>"img_id")) ?> </a>
    </div>
    <?php } ?>
    <div class="img_detail">
     <p>
      &larr;
      <?php echo $lang['img_backto']?>
      <?php tpl_pagelink($ID)?>
     </p>
    </div>
   </div>
   <?php tpl_A11Y() ?>
  </div>
 </div>
 <div class="footer container">
  <?php tpl_A11Y('site_tools') ?>
  <?php tpl_WikiLicence() ?>
  <?php tpl_A11Y() ?>
 </div>
 <!--[if ( lte IE 7 | IE 8 ) ]></div><![endif]-->
 <div class="no">
  <?php tpl_indexerWebBug() ?>
 </div>
 <div id="screen__mode" class="no"></div>
 <script type="text/javascript"><!--//--><![CDATA[//><!--
//NoClick();
<?php 
	$w = tpl_img_getTag('File.Width');
	$h = tpl_img_getTag('File.Height');
  echo 'Resize("img_id",'.$w.','.$h.');'; ?>
//--><!]]>
 </script>
</body>
</html>
