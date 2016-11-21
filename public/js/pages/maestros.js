/**
 * Created by Jorge Cociña on 14-11-2016.
 */

$(document).on('ready', function() {
    var url = window.location.href;

    url = url.split('/');
    for (i = 0; i < url.length; i++) {
        if (url[i] == 'maestros') {
            var div = document.getElementById(url[i+1]);
            div.className += " aside-item-active";
            var id = div.getAttribute("href");
            id = id.replace('#', '');
            var innerdiv = document.getElementById(id);
            innerdiv.className += " in";
            break;
        }
    }
});