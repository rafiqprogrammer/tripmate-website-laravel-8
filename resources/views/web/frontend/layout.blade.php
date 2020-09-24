<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title')</title>
  <!-- Bootstrap CSS -->
  <link href="{{ url('css/app.css') }}" rel="stylesheet" />
  <!-- Custom Styles -->
  @stack('stylesheets')
  <!-- Main Styles -->
  <link href="{{ url('css/style.css') }}" rel="stylesheet" />
  <!-- Font Awesome -->
  <script src="https://kit.fontawesome.com/b769966f19.js" crossorigin="anonymous"></script>
  
</head>
<body>
  <header>
    @include('web.frontend.layouts.header')
  </header>
  <main>
    @yield('content')
  </main>

  <!-- Footer -->
  @include('web.frontend.layouts.footer')

  <!-- Jquery -->
  <script src="{{ url('plugin/jquery/jquery.min.js') }}"></script>
  <!-- Bootstrap JS -->
  <script src="{{ url('plugin/bootstrap/js/bootstrap.bundle.js')}}"></script>
  <!-- Custom JS -->
  @stack('scripts')
  <script src="{{ url('js/main.js') }}"></script>
</body>
</html>