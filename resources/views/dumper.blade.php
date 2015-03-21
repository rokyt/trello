<html>
<head>
    <title>Trello Board/List Debugger</title>
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
    <link href='/css/app.css' rel='stylesheet' type='text/css'>
</head>
<body>
<div class="container">
    <div id="content">
        <img src="/image/loading.gif" alt="Loading..."><br><br>
    </div>

    <div class="spacer"><br></div>

    @if (session('token'))
        <div class="disconnect">
            <a href="/disconnect">Disconnect from Trello</a>
        </div>
    @endif

    @include("footer")
</div>
<script src="http://code.jquery.com/jquery-1.11.2.min.js"></script>
<script>
$(document).ready(function() {
    $.getJSON( "/api/boards", function( data ) {
        $("#content").empty();
        $("<h2>Your Trello Boards &amp; Lists</h2>").appendTo('#content');
        $.each(data, function(board_idx, board_val){
            $('<div class="board" id="board_' + board_idx + '">' + board_val.name + '<br><span class="identifier">' + board_idx + '</span><br><ul class="list"></ul>').appendTo('#content');
            $.each(board_val.lists, function (list_idx, list_val) {
                $('#board_' + board_idx + ' > ul').append('<li>' + list_val + '<br><span class="identifier">' + list_idx + '</span></li>');
            });
        })
    });
});
</script>
</body>
</html>
