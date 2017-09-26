<%
meta title: @konzert.title
meta description: "Paddy's Return Auftritt am "+ @konzert.start_t.strftime('%-d.%-m.%Y') + ", Location: " + @konzert.place + ", Beginn: " + @konzert.start_t.to_s(:time)
og title: @konzert.title
og url: URI.join("http://www.paddysreturn.com", url_for(@konzert))
	unless @konzert.plakat_file_name.nil?
		og image: @konzert.plakat.url.to_s
	end
	og description: "Paddy's Return Auftritt am "+ @konzert.start_t.strftime('%-d.%-m.%Y') + "\n Location: " + @konzert.place + ", Beginn: " + @konzert.start_t.to_s(:time)    
%>
<% k = @konzert %>


<div itemscope itemtype="http://schema.org/MusicEvent">

	<meta itemprop ="url" content="<%=request.original_url%>">

	<div class="page-title">
		  <h1 class="text-center konzert_listing"> 
			    <span itemprop="name"><%= k.title %></span>
			    <br>
			    </span>

			    <small class=" mysmall title-page text-center performer" itemprop="performer" itemscope itemtype="http://schema.org/MusicGroup">
				      <meta itemprop="sameAs" content="www.paddysreturn.com/band">
				      <span itemprop="name"> <%=k.band.html_safe %></span></small></h1>
	</div>

  <main class="main-content">
      <div class="fullwidth-block" data-bg-color="#191919" >
          <div class="container" >
	            <div class="text-right">
				          <% if can? :read, Setlist %>
						          <%if k.setlist.nil? %>
		                      <%=link_to '<span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Setlist hinzufügen'.html_safe,new_setlist_path(:konzert_id=>k.id), class: "btn btn-primary hidden-print"%>
		                  <% else %>
		                      <%=link_to 'Setlist: ' + k.setlist.title, setlist_path(k.setlist), class: "btn btn-primary hidden-print" %>
			                <%end %>
			            <% end %>
		              <div class="btn-group" role="group">

			                <%=link_to '<span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span> Zurück'.html_safe,:back, class: "btn btn-primary hidden-print"%>
                      <% if can? :manage, :all %>
				                  <%= link_to 'Tradivarium_export', trad_export_konzert_path(k), 
				                  class: "btn btn-primary"  %>
				                  <%= link_to '<b>Kopieren</b>'.html_safe, new_konzert_path(:new_id=>k.id), 
				                  class: "btn btn-primary" %>    
				                  <%= link_to '<b>Bearbeiten</b>'.html_safe, edit_konzert_path(k), 
				                  class: "btn btn-primary"  %>    
				                  <%= link_to '<b style="font-color:red">Löschen</b>'.html_safe, konzert_path(k),
				                  method: :delete,
				                  data: { confirm: 'Are you sure?' }, 
				                  class: "btn btn-primary"  %>
			                <% end %>

		              </div>
	            </div>
	            
	            <% cache k do %> 
		              <div class="row-fluid clearfix">

		                  <div class="col-xs-12 col-sm-7">
			                    <div class="row-fluid clearfix">
		                          <div class="event"  itemscope itemtype="http://schema.org/MusicEvent">
                                  <meta itemprop="performer" content="Paddy's Return">
                                  <meta itemprop="sameAs" content="<%= URI.join('http://www.paddysreturn.com', url_for(k))%>">

				                          <div class="entry-date"   itemprop="startDate" content="<%=k.start_t.iso8601%>">
                                      <%=k.start_t.today? ? '<div class="date">HEUTE </b>'.html_safe
                                      : ('<div class="date">' + k.start_t.strftime('%-d').html_safe + '</div>'.html_safe).html_safe%>
                                      <%=k.start_t.today? ? ''
                                      : ('<div class="month">' + k.start_t.strftime('%-b').html_safe + '</div>'.html_safe).html_safe%>
                                      
                                      <%=k.start_t.year == Time.now.year ? ''
                                      : ('<div class="year">' + k.start_t.strftime('%-Y').html_safe + '</div>'.html_safe).html_safe%>
				                          </div>
                                  <h3 class="entry-title"><span itemprop="name"><%= k.place %></span> </h3>
                                  <p>		<i>Beginn</i>: <%=k.start_t.to_s(:time)%> Uhr<br>
					                            <i>Ende</i>: <%=k.end_t.to_s(:time)%> Uhr<% if k.start_t.day != k.end_t.day %>, am <%=k.end_t.strftime('%-d.%-m.%Y')%> <%end %></p>
 
		                          </div> <!-- .event -->


					<span itemprop="location" itemscope itemtype="http://schema.org/EventVenue">


						<span itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">
							<i><span itemprop="streetAddress"><%= k.address%></span>,
								<span itemprop="postalCode"><%=k.postal%></span>
								<span itemprop="addressLocality"><%=k.city%></span></i><br>
								<span itemprop="addressRegion"><%= k.region%></span>,
								<span itemprop="addressCountry"><%=k.country%></span>
						</span>
						<br>
						<% if !(k.placeurl == "") %>

							<%=link_to "Zur Homepage des Veranstalters", k.placeurl, target: '_blank' %><% end %>
						<h3 class="title-page">	  <% if k.price.last(3) == "EUR" || k.price.last == "€" %>
							<span itemprop="offers" itemscope itemtype="http://schema.org/Offer">
								Eintritt: <span itemprop="price"><%=k.price%></span><br>
							</span>
						<% else %>
							Eintritt: <%=k.price%><br>
						<% end %>  
					</span>
						</h3>

			</div>
		</div>
		<div class="col-xs-12 col-sm-5 boxed">
			<% unless k.dismaps?%>
				<iframe
					width="100%"
					height="400"
					frameborder="0" style="border:0"
					src="https://www.google.com/maps/embed/v1/place?key=AIzaSyBP1L0FLWrrlxV4seiXeL8tOG7VyDCopFY&q=<%=(k.address+'+'+k.postal.to_s+'+'+k.city+'+'+k.region+'+'+k.country).gsub(' ', '+')%>">
				</iframe>
			<% end %>
		</div>
		</div>
</div>

<div class="fullwidth-block" data-bg-color="#333333">
    <div class="container">
<h2 class="text-center">Weiterführende Information</h2>

	<% unless k.dest.html_safe=="" && k.plakat_file_name.nil? %>     
		<div class="col-sm-7 boxed">
			<span  itemprop="description">
				<% unless k.dest.html_safe=="" %>
					<h3 class="text-center title-page">Details</h3>	    

					<div class="bordered boxed"></div>
					<%= k.dest.html_safe %><% end %>
			</span>

			<% unless k.plakat_file_name.nil?%>

				<h3 class="title-page text-center"> Plakat </h3>
				<div class="bordered boxed text-center"></div>
				<span class="text-center" itemprop="image">
					<%= image_tag k.plakat.url(:original).to_s, class: "photo", itemprop: 'image' %>
					<span style="font-size:80%"> <%=k.photocredit.to_s %></span>
				</span>
			<% end %>
		</div>

		<div class="col-xs-12 col-sm-5 boxed text-center">
	<% else %>
			<div class="col-xs-12 col-sm-7 boxed text-center">
	<% end %>


	<h3 class="title-page text-center">iCalendar</h3>
	<div class="bordered boxed"></div>

	<h4 class="title-page text-center"><%= link_to "ics-Download", :controller => 'konzerte', :action => :show, :format => :ics %></h4>
	<h4 class="title-page text-center">QR-Code</h4>
	<%= image_tag k.qr_c.url, class: "photo" %>
			</div>
		</div>
</div> <!-- item -->
</div><% end %>
      </div>
      
  </main>
