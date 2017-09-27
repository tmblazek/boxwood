<%
meta title: "Special Pages"
meta description: "Empfohlene Links der Wiener Irish Folk Band Paddy's Return"
%>
<div class="page-header">
	<h1 class="title-page text-center">Blog</h1></div>

<% if can? :manage, :all %>
	<%= link_to "Neu anlegen", new_page_path(:page=> {tags: "special"})%>
<% end %>
<main class="main">

    <% page.each_with_index do |p, index| %>
        <div class="fullwidth-block" data-bg-color=<%= index % 2 == 0 ? '#191919' : '#343434'%>>
                <div class="container">
        <% if can? :manage, :all%>


      <div class="row-fluid text-right">


<div class="btn-group">
  <div class="btn btn-primary">     Reihung: <%= p.show_order.to_s %> </div>
<%= link_to '<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Bearbeiten'.html_safe, edit_page_path(p), class: "btn btn-primary" %>
 <%= link_to '<span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Löschen'.html_safe, page_path(p),
              method: :delete,
                    data: { confirm: 'Are you sure?' }, class: "btn btn-primary" %>
                  </div>
                  </div>

                    <% end %>
  <div class="col-xs-12">

      <h2 class="title-page text-center"> <%=p.title %></h2>
<div class="col-xs-12 text-right"><%= link_to 'Zur Detailansicht', page_path(p), class: "btn btn-primary"%></div>

    <div class="col-xs-12 col-sm-12">
      <div class="photo-limit">
        <%= image_tag p.photo.url, class: "photo" unless p.photo_file_name.nil?%>
      </div>
      <% unless p.photo_file_name.nil?%>
      <span style="font-size:80%">Photo: <%=p.photocredit.to_s %></span>
      <% end %>
      <div class="col-xs-12 col-sm-12">
        <%= p.content.to_s.html_safe  %>
      </div>
      <div class="col-xs-12">
        <%= link_to p.datei_file_name, p.datei.url unless p.datei_file_name.nil? %>
      </div>
    </div>

</div>
</div>
<% end %>
<% if page.empty?%>

<div class="row-fluid">
  <div class="col-xs-12">
    <h2 class="title-page text-center">Wir arbeiten daran!</h2><hr>
  </div>
  <div class="col-xs-12">
    Für diese Seite gibt es leider noch keine Inhalte. Wir arbeiten daran, dass sich das ändert!
  </div>
</div>
<% end %>
       </div>
    </div>
