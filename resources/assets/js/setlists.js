/*
 * decaffeinate suggestions:
 * DS101: Remove unnecessary use of Array.from
 * DS102: Remove unnecessary code created because of implicit returns
 * DS205: Consider reworking code to avoid use of IIFEs
 * DS207: Consider shorter variations of null checks
 * DS208: Avoid top-level this
 * Full docs: https://github.com/decaffeinate/decaffeinate/blob/master/docs/suggestions.md
 */
// Place all the behaviors and hooks related to the matching controller here.
// All this logic will automatically be available in application.js.
// You can use CoffeeScript in this file: http://coffeescript.org/
const root = typeof exports !== 'undefined' && exports !== null ? exports : this;

root.execload = function() {
    let matches;
    if (window.execl === true) {
        return;
    }
    window.execl =true;
    for (var tune of Array.from(window.tunes.sort())) {
        document.getElementById('tune_list').innerHTML+=wrap_in_controls(tune);
        const matching = tune.match(/tune[0-9]+/g);
        for (matches of Array.from(matching)) {
            window.id_list.push(matches);
        }
    }
    const initial_list = document.getElementById('setlist_setlist').innerHTML;
    matches = initial_list.match(/tune[0-9]+/g);
    return (() => {
        const result = [];
    for (var match of Array.from(matches)) {
        result.push((() => {
            const result1 = [];
        for (tune of Array.from(window.tunes)) {
            if (tune.indexOf(match) > 0) {
                toggletune(tune);
                break;
            } else {
                result1.push(undefined);
            }
        }
        return result1;
    })());
    }
    return result;
})();
};

root.toggletune = function(html_code) {
    window.tunes_in_setlist.push(html_code);
    return redraw_setlist();
};

root.redraw_setlist = function() {
    let content = "";
    let sl_string = "|";
    for (let i = 0; i < window.tunes_in_setlist.length; i++) {



        const settune = window.tunes_in_setlist[i];
        content += '<div class=\"panel panel-default row-fluid clearfix\"style=\"margin-bottom:0px\">';

        if (i===window.last_added) {
            content+='<div class="row-fluid clearfix highlight">';
        }
        content += `<div class="col-xs-2"> ${String(i+1)}`+
            "<button type=\"button\" onclick=\"my_moveup("+String(i)+")\" class=\"btn btn-default btn-xs col-xs-4\">"+
            "<span class=\"glyphicon glyphicon-chevron-up\"></span></button>";

        content += `<button type="button" onclick="my_movedown(${String(i)})" class="btn btn-default btn-xs col-xs-4"><span class="glyphicon glyphicon-chevron-down"></span></button>`+
            "</div>";
        content += `<div id="setlisttune${String(i)}" class="col-xs-8">`;
        content += settune.replace(/<br>.+/gi, '</div>') + "</div>";
        content += "<div class=\"col-xs-2\"><div class=\"row-fluid clearfix\">"+
            '<button type=\"button\" class=\"btn btn-default btn-xs \" onclick="grab_and_cut(\''+window.tunes_in_setlist[i].match(/tune[0-9]+/g)+'\',\''+String(i)+'\')"><b>Cut</b></button>';



        content += 	`<button type="button" onclick="my_clearfromlist(${String(i)})" class="btn btn-default btn-xs">`+
            "<span class=\"glyphicon glyphicon-remove\"></span></button>";
        content += "";

        content += "</div></div>";
        if (i===window.last_added) {
            content+='</div>';
        }
        content += "</div>";
        if (window.paste_ready === true) {
            content += `<div class="row-fluid text-right"><button type="button" onclick="insert_below(${String(i)})" class="btn btn-default btn-xs row-fluid clearfix" >Hier Einfügen<span class="glyphicon glyphicon-chevron-left"></span><span class="glyphicon glyphicon-chevron-left"></span></button></div>	`;
        }
        sl_string += settune.match(/tune[0-9]+/g) + "|";
    }

    document.getElementById('current_setlist').innerHTML = content;
    return document.getElementById('setlist_setlist').innerHTML = sl_string;
};

root.setlist_filter = function() {
    execload();
    document.getElementById('tune_list').innerHTML = "";
    return (() => {
        const result = [];
    for (let tune of Array.from(window.tunes)) {
        const match = document.getElementById('filter').value.toUpperCase();
        if ((tune.toUpperCase().indexOf(match) > -1) || (match === "")) {
            result.push(document.getElementById('tune_list').innerHTML += wrap_in_controls(tune));
        } else {
            result.push(undefined);
        }
    }
    return result;
})();
};

root.my_clearfromlist = function(ind) {
    window.tunes_in_setlist.splice(ind, 1);
    window.last_added = -1;
    return redraw_setlist();
};

root.my_moveup = function(ind) {
    const h = window.tunes_in_setlist[ind];
    if (ind > 0) {
        window.tunes_in_setlist[ind] =window.tunes_in_setlist[ind-1];
        window.tunes_in_setlist[ind-1] = h;
        window.last_added = ind-1;
        return redraw_setlist();
    }
};

root.my_movedown = function(ind) {
    const h = window.tunes_in_setlist[ind];
    if (ind < (tunes_in_setlist.length-1)) {
        window.tunes_in_setlist[ind] =window.tunes_in_setlist[ind+1];
        window.tunes_in_setlist[ind+1] = h;
        window.last_added = ind+1;
        return redraw_setlist();
    }
};
root.insert_below = function(ind) {
    const current = window.id_list.indexOf(window.active_tune);
    window.tunes_in_setlist.splice(ind+1, 0, window.tunes[current]);
    window.last_added = ind+1;
    window.paste_ready = false;
    set_active_tune("");
    return redraw_setlist();
};
root.grab_and_cut = function(tune, i) {
    grab(tune);
    return my_clearfromlist(i);
};
//my_clearfromlist(ind)
var wrap_in_controls = function(tune) {
    let ret = '<div class="panel panel-default"><div class="row-fluid clearfix">' +
        '<button type=\"button\" class=\"btn btn-default btn-xs \" onclick="append_tune(\''+tune.match(/tune[0-9]+/g)+'\')"><b>Anhängen</b></button>' +
        '<button type=\"button\" class=\"btn btn-default btn-xs \" onclick="grab(\''+tune.match(/tune[0-9]+/g)+'\')"><b>Ablage</b></button>'+
        '<div>' + tune;
    return ret += '</div>';
};
root.grab = function(tune) {
    document.getElementById("active_tune").innerHTML = get_active(tune);
    window.paste_ready = true;
    return redraw_setlist();
};
root.set_active_tune = function(tune) {
    window.active_tune = tune;
    return document.getElementById("active_tune").innerHTML = get_active(tune);
};

root.get_active = function(tune) {
    if (tune == null) { tune = window.active_tune; }
    if (tune === "") {
        return "";
    } else {
        const current = window.id_list.indexOf(tune);
        window.active_tune = tune;
        return window.tunes[current];
    }
};
root.append_tune = function(tune) {
    window.tunes_in_setlist.push(get_active(tune));
    window.last_added = window.tunes_in_setlist.length-1;
    return redraw_setlist();
};