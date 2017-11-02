<%
meta title: "Ankündigungen"
%>
<p id="notice"><%= notice %></p>

<p>
  <strong>Message:</strong>
  <%= @announcement.message %>
</p>

<p>
  <strong>Title:</strong>
  <%= @announcement.title %>
</p>

<p>
  <strong>Public:</strong>
  <%= @announcement.public %>
</p>

<p>
  <strong>Pub start:</strong>
  <%= @announcement.pub_start %>
</p>

<p>
  <strong>Pub end:</strong>
  <%= @announcement.pub_end %>
</p>

<%= link_to 'Edit', edit_announcement_path(@announcement) %> |
<%= link_to 'Back', announcements_path %>
