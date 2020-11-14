<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <script src="<?php echo asset('js/gauge.min.js'); ?>"></script>
    </head>
    <body class="bg-black text-white">
        <div id="app">
        </div>
        <script src="<?php echo asset('js/app.js'); ?>"></script>
    </body>
</html>
