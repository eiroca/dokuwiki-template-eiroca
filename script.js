/**
 * We handle several device classes based on browser width. - desktop: >
 * __tablet_width__ (as set in style.ini) - mobile: - tablet <= __tablet_width__ -
 * phone <= __phone_width__
 */
var device_class = ''; // not yet known
var device_classes = 'desktop mobile tablet phone';

function tpl_dokuwiki_mobile() {
  
}

function tpl_dokuwiki_mobile() {
  // the z-index in mobile.css is (mis-)used purely for detecting the screen
  // mode here
  var screen_mode = jQuery('#screen__mode').css('z-index') + '';
  switch (screen_mode) {
    case '1':
      if (device_class.match(/tablet/)) return;
      device_class = 'mobile tablet';
      break;
    case '2':
      if (device_class.match(/phone/)) return;
      device_class = 'mobile phone';
      break;
    default:
      if (device_class == 'desktop') return;
      device_class = 'desktop';
  }
  jQuery('html').removeClass(device_classes).addClass(device_class);
  // handle some layout changes based on change in device
  var $toc = jQuery('#dw__toc > h3.toggle');
  if (device_class == 'desktop') {
    // reset for desktop mode
    if ($toc.length) {
      $toc[0].setState(1);
    }
  }
  if (device_class.match(/mobile/)) {
    if ($toc.length) {
      $toc[0].setState(-1);
    }
    $divRef = jQuery('div.data');
    $div = jQuery('div.navigator');
    $div.css('width', $divRef.width());
    $div = jQuery('div.search');
    $div.css('width', $divRef.width());
  }
}

jQuery(function() {
  tpl_dokuwiki_mobile();
  $(window).resize(function() {
    tpl_dokuwiki_mobile();
  });
  // increase content length to match sidebar (desktop mode only)
  var $sidebar = jQuery('.desktop .sidebar');
  if ($sidebar.length) {
    var $content = jQuery('#dokuwiki__content div.docData');
    $content.css('min-height', $sidebar.height());
  }
});
