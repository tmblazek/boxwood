<div class="col-sm-8">
    <h2>Aktuelle Setlist</h2>
    <div id="current_setlist" style="overflow-y:scroll; height:700px;">

    </div>


</div>
<div class="col-sm-4">


   <div class="btn-group" role="group">

  </div>

  <%= f.association :konzert %>
  <%= f.input :setlist,  wrapper_html: {id: "formsetlist"}%>
  <%= f.input :title, collection: ['Test', 'Vorläufig', 'Endgültig'], selected: @setlist.title.nil? ? 'Test' : @setlist.title %>
    <% end %>
  <strong>Tuneablage: </strong>
  <div id="active_tune" class="panel panel-default highlight">
  </div>

  <input type="text" onkeypress="setlist_filter()" id="filter"></input>
  <div id="tune_list"></div>

</div>
<%= javascript_include_tag "setlists" %>
<script type="text/javascript">
 window.tunes = <%=@tunes.html_safe%>;
 window.paste_ready = false;
 window.tunes_in_setlist = [];
 window.active_tune = ""
 window.id_list = []
 window.execl = false
 window.last_added = -1
</script>


