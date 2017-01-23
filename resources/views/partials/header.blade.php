<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Creatova</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- google fonts -->

    <!-- Css link -->
    <link rel="stylesheet" href="http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="{{ asset('public/assets/site') }}/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ asset('public/assets/site') }}/css/owl.carousel.css">
    <link rel="stylesheet" href="{{ asset('public/assets/site') }}/css/owl.transitions.css">
    <link rel="stylesheet" href="{{ asset('public/assets/site') }}/css/animate.min.css">
    <link rel="stylesheet" href="{{ asset('public/assets/site') }}/css/lightbox.css">

    <?php $lang = LaravelLocalization::getCurrentLocale(); ?>
    @if( $lang == 'ar')
        <link rel="stylesheet" href="{{ asset('public/assets/site') }}/css/bootstrap-rtl.css">
    @else
        <link rel="stylesheet" href="{{ asset('public/assets/site') }}/css/bootstrap.min.css">
    @endif

    <link rel="stylesheet" href="{{ asset('public/assets/site') }}/css/preloader.css">
    <link rel="stylesheet" href="{{ asset('public/assets/site') }}/css/image.css">
    <link rel="stylesheet" href="{{ asset('public/assets/site') }}/css/icon.css">
    <link rel="stylesheet" href="{{ asset('public/assets/site') }}/css/style.css">
    <link rel="stylesheet" href="{{ asset('public/assets/site') }}/css/responsive.css">

    @if( $lang == 'ar')
        <link rel="stylesheet" href="{{ asset('public/assets/site') }}/css/rtl.css">
    @endif

    @yield('styles')

</head>
<body id="top">


<header id="navigation" class="navbar-fixed-top animated-header">
    <div class="container">
        <div class="navbar-header">
            <!-- responsive nav button -->
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <!-- /responsive nav button -->

            <!-- logo -->
            <h1 class="navbar-brand">
                <a href="#body"><img src="{{ asset('public/assets/site') }}/img/logo.png"  alt="" style="margin-top: 18px;"></a>
            </h1>
            <!-- /logo -->
        </div>

        <!-- main nav -->
        <nav class="collapse navbar-collapse navbar-right" role="navigation">
            <ul id="nav" class="nav navbar-nav menu">
                <li><a href="{{ route('frontend.home.get') }}">{{ trans('main.home') }}</a></li>
                <li><a href="#features">{{ trans('main.services') }}</a></li>
                <li><a href="#portfolio">{{ trans('main.portfolio') }}</a></li>
                <li><a href="{{ route('frontend.gallery.get') }}">{{ trans('main.gallery') }}</a></li>
                <li><a href="#team">{{ trans('main.team') }}</a></li>
                <li><a href="{{ route('frontend.blog.get') }}">{{ trans('main.blog') }}</a></li>
                <li><a href="#testimonial">{{ trans('main.testimonial') }}</a></li>
                <li><a href="#contact-form">{{ trans('main.contact') }}</a></li>
            </ul>
        </nav>
        <!-- /main nav -->

    </div>
</header>

<div class="wrapper">