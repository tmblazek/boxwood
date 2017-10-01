
<%
meta title: @setlist.konzert.start_t.to_date.to_s + " " + @setlist.konzert.title unless @setlist.konzert.nil?
%>
<table style="width:100%">
<%= render 'tunes/template_pdf_quer' %>

<% @tunes.each_with_index do |tune, index| %>

<%= render 'tunes/pdf_quer', tune: tune, index: index %>


<%end %>  
</table>
