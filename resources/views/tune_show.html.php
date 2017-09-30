 <%
meta title: @tune.title
%>
   <script type="text/javascript" src="/assets/abcjs_basic_2.0-min.js"></script>
 <div class="hidden-print page-title">
 <h1 class="text-center"><%=@tune.title%> <br>
  <small class="mysmall"> <% @tune.tag_list.each do |tag| %>
    | <%= tag.to_s %> 
    <%end %> |</small></h1>

 </div>
 <main class="main">
     <div class="fullwidth-block" data-bg-color="#343434">
         <div class="container">
<div class="row-fluid text-right hidden-print">
<div class="btn-group" role="group">
<%= link_to "Druckansicht", abc_tune_path(@tune), class: "btn btn-primary"%>
<% if can? :manage, Tune %>
    <%= link_to '<span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Neuer Tune'.html_safe, new_tune_path, :class=> "btn btn-primary"%>
      <%= link_to '<b>Bearbeiten</b>'.html_safe, edit_tune_path(@tune), 
        class: "btn btn-primary"  %>    
        <%= link_to '<b style="font-color:red">Löschen</b>'.html_safe, tune_path(@tune),method: :delete,data: { confirm: 'Are you sure?' }, class: "btn btn-primary"  %>
          <% end %>
</div>
</div>
<h2 class="text-center">Setlist Infos </h2>
<div class="visible-print title-page"><%=@tune.title%></div>
<%= render 'template_quer' %>
<%= render 'tune_quer', tune: @tune, index: 0 %>
<hr>
<h2>Weitere Informationen </h2>
<p>
  <strong>Michi:</strong><br>
  <%= @tune.michi.html_safe unless @tune.michi.nil? %><br></p>
  <hr>
  <% unless @tune.setlists.empty? %>
<strong> Verwendet in <%= @tune.setlists.length %> Setlists: </strong>
|<% @tune.setlists.each do |set| %>
<%= link_to set.full_title, setlist_path(set)%> |
<% end %>
<% end %>
<% unless @tune.songtext.to_s == ""%>
<p>
    <h2 class="text-center">Songtext</h2>
    <%= @tune.songtext.html_safe %><br>
</p>
<% end %>


         </div></div>
         <div class="fullwidth-block" data-bg-color="#848484">
             <div class="container text-center">
<div id="notation" class="text-center"></div>

<div class="col-xs-12">

</div>
  <strong>Status:</strong><br>
  <%= @tune.status %><br>


<div class="hidden-print">
	<h3> ABC </h3>
	<code><%= @tune.abc.html_safe%></code>

</div>

         </div>
     </div>
 </main>
   <script type="text/javascript">

   var tune = "<%= @abc%>";
   var book = new ABCJS.TuneBook(tune);
   var fileHeader = book.header;
   var numberOfTunes = book.tunes.length;

   function execute_onclick(){ 
    for (var i = 0; i < numberOfTunes; i++) {
    var title = book.tunes[i].title;
    var tuneAndHeader = book.tunes[i].abc;
    var justTheTune = book.tunes[i].pure;
    var id = book.tunes[i].id;

    var div = document.createElement('div');
    div.setAttribute('id', 'not'.concat(i.toString()));
    //div.setAttribute('class', 'photo');
    var parentDiv = document.getElementById('notation');
    parentDiv.insertBefore(div, null);

    ABCJS.renderAbc('not'.concat(i.toString()), tuneAndHeader, {});
  }  
};
window.onload = execute_onclick();
   </script>
