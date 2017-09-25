# Place all the behaviors and hooks related to the matching controller here.
# All this logic will automatically be available in application.js.
# You can use CoffeeScript in this file: http://coffeescript.org/
root = exports ? this

root.execload = ->
	if window.execl == true
		return
	window.execl =true
	for tune in window.tunes.sort()
		document.getElementById('tune_list').innerHTML+=wrap_in_controls tune
		matching = tune.match(/tune[0-9]+/g)
		for matches in matching
			window.id_list.push matches
	initial_list = document.getElementById('setlist_setlist').innerHTML
	matches = initial_list.match(/tune[0-9]+/g)
	for match in matches
		for tune in window.tunes
			if tune.indexOf(match) > 0
				toggletune tune
				break

root.toggletune = (html_code) ->
	window.tunes_in_setlist.push html_code
	redraw_setlist()

root.redraw_setlist = ->
	content = ""
	sl_string = "|"
	for settune, i in window.tunes_in_setlist


			
		content += '<div class=\"panel panel-default row-fluid clearfix\"style=\"margin-bottom:0px\">'

		if i==window.last_added 
			content+='<div class="row-fluid clearfix highlight">'
		content += '<div class="col-xs-2"> '+String(i+1)+
			"<button type=\"button\" onclick=\"my_moveup("+String(i)+")\" class=\"btn btn-default btn-xs col-xs-4\">"+
					"<span class=\"glyphicon glyphicon-chevron-up\"></span></button>"

		content += "<button type=\"button\" onclick=\"my_movedown("+String(i)+")\" class=\"btn btn-default btn-xs col-xs-4\">"+					"<span class=\"glyphicon glyphicon-chevron-down\"></span></button>"+
			"</div>"
		content += "<div id=\"setlisttune"+String(i)+"\" class=\"col-xs-8\">"
		content += settune.replace(/<br>.+/gi, '</div>') + "</div>"
		content += "<div class=\"col-xs-2\"><div class=\"row-fluid clearfix\">"+
			'<button type=\"button\" class=\"btn btn-default btn-xs \" onclick="grab_and_cut(\''+window.tunes_in_setlist[i].match(/tune[0-9]+/g)+'\',\''+String(i)+'\')"><b>Cut</b></button>'
			
			

		content += 	"<button type=\"button\" onclick=\"my_clearfromlist("+String(i)+")\" class=\"btn btn-default btn-xs\">"+
					"<span class=\"glyphicon glyphicon-remove\"></span></button>"
		content += ""

		content += "</div></div>"
		if i==window.last_added 
			content+='</div>'
		content += "</div>"
		if window.paste_ready == true
			content += '<div class="row-fluid text-right"><button type="button" onclick="insert_below('+String(i)+')" class="btn btn-default btn-xs row-fluid clearfix" >Hier Einfügen<span class="glyphicon glyphicon-chevron-left"></span><span class="glyphicon glyphicon-chevron-left"></span></button></div>	'
		sl_string += settune.match(/tune[0-9]+/g) + "|"
	
	document.getElementById('current_setlist').innerHTML = content
	document.getElementById('setlist_setlist').innerHTML = sl_string

root.setlist_filter = ->
	execload()
	document.getElementById('tune_list').innerHTML = ""
	for tune in window.tunes
		match = document.getElementById('filter').value.toUpperCase()
		if tune.toUpperCase().indexOf(match) > -1 or match is ""
			document.getElementById('tune_list').innerHTML += wrap_in_controls tune

root.my_clearfromlist = (ind) ->
	window.tunes_in_setlist.splice ind, 1
	window.last_added = -1
	redraw_setlist()

root.my_moveup = (ind) ->
 	h = window.tunes_in_setlist[ind]
 	if (ind > 0)
   		window.tunes_in_setlist[ind] =window.tunes_in_setlist[ind-1]
   		window.tunes_in_setlist[ind-1] = h
   		window.last_added = ind-1
   		redraw_setlist()
 
root.my_movedown = (ind) ->
	h = window.tunes_in_setlist[ind]
	if (ind < tunes_in_setlist.length-1)
   		window.tunes_in_setlist[ind] =window.tunes_in_setlist[ind+1]
   		window.tunes_in_setlist[ind+1] = h
   		window.last_added = ind+1
   		redraw_setlist()
root.insert_below = (ind) ->
	current = window.id_list.indexOf(window.active_tune)
	window.tunes_in_setlist.splice(ind+1, 0, window.tunes[current])
	window.last_added = ind+1
	window.paste_ready = false
	set_active_tune("")
	redraw_setlist()
root.grab_and_cut = (tune, i) ->
	grab(tune)
	my_clearfromlist(i)
	#my_clearfromlist(ind)
wrap_in_controls = (tune) ->
	ret = '<div class="panel panel-default"><div class="row-fluid clearfix">' + 
			'<button type=\"button\" class=\"btn btn-default btn-xs \" onclick="append_tune(\''+tune.match(/tune[0-9]+/g)+'\')"><b>Anhängen</b></button>' +
			'<button type=\"button\" class=\"btn btn-default btn-xs \" onclick="grab(\''+tune.match(/tune[0-9]+/g)+'\')"><b>Ablage</b></button>'+
			'<div>' + tune
	ret += '</div>'
root.grab = (tune) ->
	document.getElementById("active_tune").innerHTML = get_active(tune)
	window.paste_ready = true
	redraw_setlist()
root.set_active_tune = (tune) ->
	window.active_tune = tune
	document.getElementById("active_tune").innerHTML = get_active(tune)

root.get_active = (tune=window.active_tune) ->
	if tune == ""
		return ""
	else
		current = window.id_list.indexOf(tune)
		window.active_tune = tune
		window.tunes[current]
root.append_tune = (tune) ->
	window.tunes_in_setlist.push(get_active(tune))
	window.last_added = window.tunes_in_setlist.length-1
	redraw_setlist()