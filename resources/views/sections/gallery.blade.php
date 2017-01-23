@extends('layouts.master')

@section('styles')
    <style>

        .item img{
            min-height: 250px;
        }


    </style>
@endsection

@section('content')

        <!-- Page Title -->
<div class="title-bar">
    <div class="container">
        <h1 class="page-title">{{ trans('main.gallery') }}</h1>
        <div class="">
            <a href="{{ route('frontend.home.get') }}">{{ trans('main.home') }} </a> <span>/</span> <a href="#">{{ trans('main.gallery') }}</a>
        </div>
    </div>
</div>

<br><br>

<div class="content container">
    <br>

    <div id="grid">
        @foreach($gallery as $photo)
        <div class="item no-padding col-md-4 col-sm-3 col-xs-6">
            <a href="#" title="{{ $photo->post_title }}">
                @if($photo->post_have_thumbnail())
                    <img  class="img-responsive" src="{{ asset('public/uploads/full/' . $photo->media->guid) }}">
                @endif
            </a>
        </div>
        @endforeach
    </div>

    <div class="clearfix"></div>

</div>

<br><br>
@endsection

@section('scripts')
    <script src="{{ asset('public/assets/site/js/masonry.pkgd.min.js') }}"></script>
    <script>
        $( function() {

            $('#grid').masonry({
                itemSelector: '.item',
                columnWidth: 0
            });

        });
    </script>
@endsection
