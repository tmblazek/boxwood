<%
   meta title: "Musik"
   meta description: "Aufnahmen von Paddy's Return aus Wien zum anhören"
   %>

  <div class="page-title">
    <h2 class="text-center">Musik</h1>
  </div>

    
    <div class="fullwidth-block">
        <% if can? :manage, :all %>
  <%= link_to 'Neue Aufnahme', new_recording_path %>
  <% end %>
  <% @recordings.each_slice(2) do |s| %>
    <% s.each do |r| %>
    <% if s.length == 2 %>
    <div class="col-sm-6">
      <% else %>
      <div class="col-sm-6 col-sm-offset-3">
	<%end %>
	<%= render partial: "recording", locals: {recording: r} %>
      </div>
      <% end %>
    </div>
    <% end %>
  </div>

