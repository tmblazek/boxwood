<%
if params[:jahr].nil?
	meta title: "Konzerte"
elsif params[:monat].nil?
	meta title: "Konzerte "+params[:jahr]
else
	meta title: "Konzerte "+params[:monat]+" "+params[:jahr]
end
meta description: "Die Konzerte der Wiener Irish Folk Band Paddy's Return"
%>
    <main class="main-content">
        <div class="fullwidth-block" >
            <div class="container" >
	<div itemscope itemtype="http://schema.org/MusicGroup">
		<meta itemprop="name" content="Paddy's Return">
		<meta itemprop="sameAs" content="http://www.paddysreturn.com/band">
		<div class="page-title">
			<h1 class="text-center">Alle Konzerte</h1>
		</div>
		<div class="text-center">Mit dem Filter kann die Liste der angezeigten Konzerte eingeschränkt werden. <br>Für Details Konzert anklicken 
		</div>
		<div class="">
			<div class="btn-group" role="group">
				<% if can? :inspect, Konzert %>
					<%if can? :manage, Konzert %>
						<%= link_to '<span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Neues Konzert'.html_safe, new_konzert_path, :class=> "btn btn-primary"%>
					<% end %>
					<button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-expanded="true">
						<%= @button_label%>	<span class="caret"></span>
					</button>
					<ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu2">
						<li role="presentation"><%= link_to 'Ausblenden', konzerte_path(:no_hidden=>"true"), role: "menuitem", tabindex: "-1" %></li>
						<li role="presentation"><%= link_to 'Alle zeigen', konzerte_path(:show_past=>"true"), role: "menuitem", tabindex: "-1" %></li>
						<li role="presentation"><%= link_to 'Zukünftige zeigen', konzerte_path,  role: "menuitem", tabindex: "-1" %></li>
					</ul>
				<% end %>

			</div>
			<div class="btn-group" role="group">
				<button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-expanded="true">
					<%= params[:jahr].nil? ? "Nach Jahr filtern" : params[:jahr] %>
					<span class="caret"></span>
				</button>
				<ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
					<li role="presentation"><a role="menuitem" tabindex="-1" href="<%=konzerte_path%>">Alle Konzerte anzeigen</a></li>
					<li role="presentation" class="divider"></li>
					<% @jahre.each do |j| %>
						<li role="presentation"><%= link_to j.to_s+ " ("+@vielfachheit_jahr[j].to_s+")", :jahr=>j.to_s, role: "menuitem", tabindex: "-1" %></li>
					<% end %>
				</ul>

				<% unless params[:jahr].nil? %>
					<div class="btn-group" role="group">
						<div class="dropdown">
							<button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-expanded="true">
								<%= params[:monat].nil? ? "Nach Monat filtern" : params[:monat] %>
								<span class="caret"></span>
							</button>
							<ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu2">
								<li role="presentation"><a role="menuitem" tabindex="-1" href="<%=konzerte_path%>">Alle Konzerte Anzeigen</a></li>
								<li role="presentation"><%= link_to "Alle Konzerte im Jahr "+params[:jahr]+" anzeigen", :jahr=>params[:jahr]%></li>
								<li role="presentation" class="divider"></li>
								<% @monate.each do |j| %>
									<li role="presentation"><%= link_to j.to_s+ " ("+@vielfachheit_monat[j].to_s+")", :jahr=>params[:jahr], :monat=>j.to_s%></li>
								<% end %>
							</ul>
						</div>
					</div>
				<%end%>

			</div>
		</div>
  </div>
            </div>
    <div class="fullwidth gallery" data-bg-color="#191919">
        <div class="container">
		<% if params[:no_hidden] != 'true' and can? :inspect, Konzert %>
			<h2> <%= @unpub_header%> </h2>
			<%= render partial: "konzert_list", locals: {konzert: @unpublished} unless @unpublished.empty?%>
			<h2> Veröffentlichte Konzerte </h2>
		<% end %>
    <h3>Zukünftige Konzerte</h3>
		<%= render partial: "konzert_list", locals: {konzert: @konzerte.select{|k| k.end_t.future?}} %>
    <h3>Vergangene Konzerte</h3>
		<%= render partial: "konzert_list", locals: {konzert: @konzerte.select{|k| !k.end_t.future?}} %>
        </div>
  </div>
   </main>
