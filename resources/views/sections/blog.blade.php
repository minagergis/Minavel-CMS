@extends('layouts.master')


@section('content')


        <section id="global-header">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="block text-center">
                            <h1>BIG HEADLINE FOR BLOG</h1>
                            <p>13 MARCH 2015 / BY SARA SMITH</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="blog-left">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 col-md-offset-0 col-sm-10 col-sm-offset-1">

                        @foreach($posts as $post)
                        <div class="post">
                            <div class="blog-img row">
                                <div class="col-md-12">
                                    <a href="{{ route('frontend.blog.single.get', $post->id) }}" title="{{ $post->post_title }}">
                                        @if($post->post_have_thumbnail())
                                            <img class="img-responsive" alt="{{ $post->post_title }}"
                                                 src="{{ asset('public/uploads/large/' . $post->media->guid) }}">
                                        @endif
                                    </a>
                                </div>
                            </div>
                            <div class="block">
                                <span class="first-child-span">{{ $post->post_title }}</span>
                                <p class="first-child">{{ $post->post_excerpt }}</p>
                            </div>
                        </div>
                        <hr>
                            @endforeach

                    </div>
                    <div class="col-md-3 col-md-offset-1 col-sm-4">
                        @include('partials.sidebar')
                    </div>
                </div>
            </div>
        </section>


@endsection
