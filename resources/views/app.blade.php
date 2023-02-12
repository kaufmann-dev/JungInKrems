<!DOCTYPE html>
<html class="tw-h-full" lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    @vite('resources/js/app.js')
    @vite('resources/css/app.css')
    @inertiaHead
  </head>
  <body class="tw-h-full">
    @inertia
  </body>
</html>
