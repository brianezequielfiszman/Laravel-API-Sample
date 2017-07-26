<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>
    </head>
    <body>
        <form id="form" action="{{route("posts.store")}}" method="post">
            {{csrf_field()}}
            <input id="textfield" type="text" name="post" placeholder="Insert Text">
            <input  type="submit" value="Send">
        </form>
        <div class="data"></div>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script>
            function getData() {
                $.ajax({
                    statusCode: {
                        200: function() {
                            console.log( "Success" );
                        }
                    },
                    url: "http://127.0.0.1:8000/api/posts/",
                    context: document.body
                }).done(function(post) {
                    post.forEach(function(currentValue){
                        $('.data').append(currentValue.text + '\n');
                    });
                });
            }

            $( "#form" ).submit(function(event) {
                $.ajax({
                    method: "POST",
                    url: "http://127.0.0.1:8000/api/posts/",
                    data: { post: $('#textfield').val() }
                })
                    .done(function( msg ) {
                        $('.data').append('\n' + $('#textfield').val());
                    });
                event.preventDefault();
            });
            getData();
        </script>
    </body>
</html>
