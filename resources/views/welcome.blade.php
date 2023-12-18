<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <script src="{{ asset('js/app.js') }}"></script>

   </head>
    <body>
        <div class="container mt-4">
        <h3>Hexlet. РНР: разработка на Laravel</h3>
            <ul>
                <li><a href="/about">About</a></li>
                <li><a href="/articles">Articles</a></li>
            </ul>
        </div>
    </body>
</html>