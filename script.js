/**
 * We handle several device classes based on browser width. - desktop: >
 * __tablet_width__ (as set in style.ini) - mobile: - tablet <= __tablet_width__ -
 * phone <= __phone_width__
 */
var device_class = ''; // not yet known
var device_classes = 'desktop mobile tablet phone';

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
  var $page = jQuery('.docPage');
  var $foot = jQuery('.footer');
  if (device_class.match(/phone/)) {
    $page.css('margin-bottom', 10);
  }
  else {
    $page.css('margin-bottom', $foot.height() + 20);
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
  var resizeTimer;
  tpl_dokuwiki_mobile();
  // increase content length to match sidebar (desktop mode only)
  var $sidebar = jQuery('.desktop .sidebar');
  if ($sidebar.length) {
    var $content = jQuery('#dokuwiki__content div.docData');
    $content.css('min-height', $sidebar.height());
  }
  jQuery(window).bind('resize', function() {
    if (resizeTimer) clearTimeout(resizeTimer);
    resizeTimer = setTimeout(tpl_dokuwiki_mobile, 200);
  });
});


jQuery(function() {
  var menu = document.getElementById('menuBar');
  var menuLink = document.getElementById('menuLink');

  toggleClass = function(element, className) {
    var classes = element.className.split(/\s+/);
    var length = classes.length;
    var i = 0;
    while (i < length) {
      if (classes[i] === className) {
        classes.splice(i, 1);
        break;
      }
      i++;
    }
    if (length === classes.length) {
      classes.push(className);
    }
    element.className = classes.join(' ');
  };

  menuLink.onclick = function(e) {
    e.preventDefault();
    toggleClass(menu, 'open');
    toggleClass(menuLink, 'open');
  };
});

// Disable right click
var message = "Right click disabled.";
function clickIE() {
  if (document.all) {
    (message);
    return false;
  }
}

function clickNS(e) {
  if (document.layers || (document.getElementById && !document.all)) {
    if (e.which == 2 || e.which == 3) {
      (message);
      return false;
    }
  }
}

function NoClick() {
  if (document.layers) {
    document.captureEvents(Event.MOUSEDOWN);
    document.onmousedown = clickNS;
  }
  else {
    document.onmouseup = clickNS;
    document.oncontextmenu = clickIE;
  }
  document.oncontextmenu = new Function("return false");
}

function Resize(id, w, h) {
  img = document.getElementById(id);
  if (img) {
    maxwidth = screen.width - 100;
    maxheight = screen.heigth - 50;
    ratio = h / w;
    if (w > maxwidth) {
      w = maxwidth;
      h = w * ratio;
    }
    if (h > maxheight) {
      h = maxheight;
      w = h / ratio;
    }
    img.width = w;
    img.height = h;
  }
}
