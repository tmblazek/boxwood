	<%
	meta title: @setlist.konzert.start_t.to_date.to_s + " " + @setlist.konzert.title unless @setlist.konzert.nil?
	%>
	<div class="page-header">
	    <h1 class="title-page text-center konzert_listing">Setlist<br> <small class="mysmall"><%=@setlist.konzert.start_t.to_date.to_s + " " + @setlist.konzert.title unless @setlist.konzert.nil?%></small></h1>
	  </div>
	<p id="notice"><%= notice %></p>

		<div class="row-fluid clearfix text-right">
		<div class="btn-group" role="group">
						<button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-expanded="true">
							Drucken	<span class="caret"></span>
						</button>
	        <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
						<li role="presentation"><%= link_to 'Standard'.html_safe, druckvorschau_setlist_path(@setlist, format: :pdf) , role: "menuitem", tabindex: "-1" %>    </li>
						<li role="presentation"><%= link_to 'Hochformat'.html_safe, hochformat_setlist_path(@setlist, format: :pdf), role: "menuitem", tabindex: "-1"  %>    </li>
							<li role="presentation"><%= link_to 'Bodhrán Info'.html_safe, michi_setlist_path(@setlist, format: :pdf), role: "menuitem", tabindex: "-1"  %>    </li>
			</ul>
				</div>
			<div class="btn-group" role="group">
				<%=link_to '<span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span> Zurück'.html_safe,:back, class: "btn btn-primary hidden-print"%>


					<%= link_to '<b>Kopieren</b>'.html_safe, new_setlist_path(:new_id=>@setlist.id), 
					class: "btn btn-primary" %>    
					<%= link_to '<b>Bearbeiten</b>'.html_safe, edit_setlist_path(@setlist), 
					class: "btn btn-primary"  %>    
					<%= link_to '<b style="font-color:red">Löschen</b>'.html_safe, setlist_path(@setlist),method: :delete,data: { confirm: 'Are you sure?' }, class: "btn btn-primary"  %>

			</div>
		</div>
		<h2>
	  <%=link_to @setlist.konzert.title, konzert_path(@setlist.konzert) %>
	</h2>
	<h2>
	  <%= @setlist.title %>
	</h2>
	<h2>Tunes </h2>
	<%= render 'tunes/template_quer' %>

	<% @tunes.each_with_index do |tune, index| %>

	<%= render 'tunes/tune_quer', tune: tune, index: index %>
	<%end %>  
