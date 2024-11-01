<!doctype html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  {{-- favicon --}}
  <link rel="shortcut icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">

  {{-- vite css/js --}}
  @vite(['resources/css/app.css','resources/js/app.js'])

  <!--fontawesome css-->
  <link rel="stylesheet" href="{{ asset('assets/libs/fontawesome/all.min.css') }}">

  {{-- title --}}
  <title>@yield('title_base') | {{env('APP_NAME')}}</title>

</head>
    @yield('body')
</html>