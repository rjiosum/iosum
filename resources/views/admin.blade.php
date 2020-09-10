<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="apple-touch-icon" sizes="180x180"
          href="{{ asset(config('settings.backend.theme').'/images/favicon/apple-touch-icon.png')}}">
    <link rel="icon" type="image/png" sizes="32x32"
          href="{{ asset(config('settings.backend.theme').'/images/favicon/favicon-32x32.png')}}">
    <link rel="icon" type="image/png" sizes="16x16"
          href="{{ asset(config('settings.backend.theme').'/images/favicon/favicon-16x16.png')}}">
    <link rel="manifest" href="{{ asset(config('settings.backend.theme').'/images/favicon/site.webmanifest')}}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900">
    <link href="{{ mix(config('settings.backend.theme').'/css/app.css') }}" rel="stylesheet">
    <script src="{{ mix( config('settings.backend.theme') .'/js/app.js') }}" defer></script>
</head>
<body>
<div id="app">
    <App></App>
</div>
</body>
</html>