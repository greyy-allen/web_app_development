<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Foreach loop example</title>
        <link rel="stylesheet" href="{{asset('css/wp.css')}}" type="text/css">

    </head>
    <body>
            <table class="bordered">
                    <!-- table header -->
                    <tr><th>Name</th><th>Value</th></tr>
                @forelse ($get as $name => $value)
                    @if ($loop->index %2 == 0)
                        <tr class="alt"><td>{{$name}}:</td><td>{{$value}}</td></tr>
                    @else
                        <tr><td>{{$name}}:</td><td>{{$value}}</td></tr>
                    @endif
                @empty
                    <tr><td colspan = 2>No URL variable</td></tr>  
                @endforelse
            </table>
            
            <p><a href="show.php?file=foreach-loop.php">Source</a></p>
    </body>
</html>
