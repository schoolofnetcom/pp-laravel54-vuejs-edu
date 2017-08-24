
try {
    window.$ = window.jQuery = require('jquery');

    require('bootstrap-sass');
    window.PNotify = require('pnotify');
    require('pnotify/src/pnotify.buttons');
} catch (e) {}