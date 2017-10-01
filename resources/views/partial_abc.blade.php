 <%
meta title: @tune.title
%>  
<html moznomarginboxes mozdisallowselectionprint>
<body>
   <script type="text/javascript" src="/assets/abcjs_basic_2.0-min.js"></script>
<div id="notation"></div>

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

    ABCJS.renderAbc('not'.concat(i.toString()), tuneAndHeader, {}, {});

  }  
};
   window.onload = execute_onclick();
   </script>
<body>
</html>