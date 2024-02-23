<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <link rel="stylesheet" href="{{asset('/css/plugins/swiper-bundle.min.css') }}">
    <link rel="stylesheet" href="{{asset('/css/plugins/glightbox.min.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Frank+Ruhl+Libre:wght@300;400;500;700;900&family=Karma:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Plugin css -->
    <link rel="stylesheet" href="{{asset('/css/vendor/bootstrap.min.css') }}">
  
    <!-- Custom Style CSS -->
    <link rel="stylesheet" href="{{asset('/css/style.css') }}">

    <script src="https://code.jquery.com/jquery-3.6.4.js" integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E=" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/b3dd281431.js" crossorigin="anonymous"></script>
</head>
<body>
    <div id="app">
    <!-- Start preloader -->
        <div id="preloader">
            <div id="ctn-preloader" class="ctn-preloader">
                <div class="animation-preloader">
                    <div class="spinner"></div>
                    <div class="txt-loading">
                        <span data-text-preloader="L" class="letters-loading">
                            L
                        </span>
                        
                        <span data-text-preloader="O" class="letters-loading">
                            O
                        </span>
                        
                        <span data-text-preloader="A" class="letters-loading">
                            A
                        </span>
                        
                        <span data-text-preloader="D" class="letters-loading">
                            D
                        </span>
                        
                        <span data-text-preloader="I" class="letters-loading">
                            I
                        </span>
                        
                        <span data-text-preloader="N" class="letters-loading">
                            N
                        </span>
                        
                        <span data-text-preloader="G" class="letters-loading">
                            G
                        </span>
                    </div>
                </div>	

                <div class="loader-section section-left"></div>
                <div class="loader-section section-right"></div>
            </div>
        </div>
        <!-- End preloader -->
        <x-dynamic-component :component="'customers.header'" />

        <main class="main__content_wrapper">
            @yield('content')
        </main>

        <x-customers.footer></x-customers.footer>

    </div>
           <!-- All Script JS Plugins here  -->
   <script src="{{asset('/js/vendor/popper.js') }}" defer="defer"></script>
   <script src="{{asset('/js/vendor/bootstrap.min.js') }}" defer="defer"></script>
   <script src="{{asset('js/plugins/swiper-bundle.min.js') }}"></script>
   <script src="{{asset('/js/plugins/glightbox.min.js') }}"></script>

  <!-- Customscript js -->
  <script src="{{asset('/js/script.js') }}"></script>
  @stack('customize-js')
</body>
</html>