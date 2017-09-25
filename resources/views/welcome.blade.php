@extends('layouts/app')

@section('content')
    <%
    meta title: "Willkommen"
    meta description: "Paddy's Return - Irish Folk Musik aus Wien. Die Band besteht aus Günther Hackl, Xandi Tichy, Gregor Lötsch, Michael Strasser und Thomas Blazek"
    og title: "Paddy's Return"
    og url: "http://www.paddysreturn.com"
    og description: @band_bio.short_desc.html_safe
    unless @band_bio.nil? || @band_bio.photo_file_name.nil?
    og image: @band_bio.photo.url
    end
    %>
    <!-- TITLE -->

    <div class="hero">
        <div class="slider">
            <ul class="slides">
    <%=render "announcements/title_page"%>
        </ul>
</div>
</div>
<main class="main-content">
<div class="fullwidth-block gallery">
    <div class="container">
          <!-- BODY -->
          <% if can? :manage, :all %>
              <div class="fullwidth-block">
                    <%= render "adminpanel"%>
              </div>
          <% end %>

          <div class="fullwidth-block">
                <%= User.last.lastlogin if can? :read, Setlist %>
                <div>
                      <!-- BAND -->
                      <div class="col-md-8">
                            <h2> Willkommen!</h2>



                                  <%= @band_bio.short_desc.html_safe unless @band_bio.nil?%>



                <div class="fullwidth-block">

                    <h2>Kommende Konzerte </h2>

                        <% cache @konzerte do %>
                                    <%= render partial: "konzerte/konzert_list", locals: {konzert: @konzerte} %>
                                <% end %>

                            </div>
            </div>
                          <div class="col-md-4">

                                <!-- SOUND EXAMPLES -
                          <!-- ANNOUNCEMENTS -->


                <h2> Musik</h2>
                            <div class="fullwidth-block" itemprop="track" itemscope itemtype="http://schema.org/MusicRecording">
                                  <meta itemprop="name" content="Paddy's Return - Up in the Air - Mug of Brown Ale">

                                  <% @recordings.each do |r| %>

                                          <%= render partial: "recordings/recording", locals: {recording: r} %>

                                  <% end %>
                            </div>
                          </div>

                        </div>
                </div>
          </div>
    </div>
</div>

</main>

@endsection