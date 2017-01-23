@extends('layouts.master')

@section('styles')
    <link href="{{ asset('public/assets/site') }}/css/sweetalert.css" rel="stylesheet">

@endsection

@section('content')

    @include('partials.slider')

    <section id="features">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="title">
                        <h2>{{ trans('main.services') }}</h2>
                        <p>{!! trans('main.fake_content') !!}</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 col-xs-6 col-sm-6">
                    <div class="feature-block text-center">
                        <div class="icon-box">
                            <i class="ion-easel"></i>
                        </div>
                        <h4 class="wow fadeInUp" data-wow-delay=".3s">{{ trans('main.title') }}</h4>
                        <p class="wow fadeInUp" data-wow-delay=".5s">{!! trans('main.fake_content') !!}</p>
                    </div>
                </div>
                <div class="col-md-4 col-xs-6 col-sm-6">
                    <div class="feature-block text-center">
                        <div class="icon-box">
                            <i class="ion-paintbucket"></i>
                        </div>
                        <h4 class="wow fadeInUp" data-wow-delay=".3s">{{ trans('main.title') }}</h4>
                        <p class="wow fadeInUp" data-wow-delay=".5s">{!! trans('main.fake_content') !!}</p>
                    </div>
                </div>
                <div class="col-md-4 col-xs-6 col-sm-6">
                    <div class="feature-block text-center">
                        <div class="icon-box">
                            <i class="ion-paintbrush"></i>
                        </div>
                        <h4 class="wow fadeInUp" data-wow-delay=".3s">{{ trans('main.title') }}</h4>
                        <p class="wow fadeInUp" data-wow-delay=".5s">{!! trans('main.fake_content') !!}</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="counter">
        <div class="container">
            <div class="row">
                <div class="title">
                    <h2>{{ trans('main.fun_facts') }}</h2>
                    <p>{!! trans('main.fake_content') !!} </p>
                </div>
                <div class="col-md-3 col-sm-6 col-xs-6">
                    <div class="block wow fadeInRight" data-wow-delay=".3s">
                        <i class="ion-code"></i>
                        <p class="count-text">
                            <span class="counter-digit">136800 </span> k
                        </p>
                        <p>{{ trans('main.line_code') }}</p>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 col-xs-6">
                    <div class="block wow fadeInRight" data-wow-delay=".5s">
                        <i class="ion-compass"></i>
                        <p class="count-text">
                            <span class="counter-digit">7800 </span> +
                        </p>
                        <p>{{ trans('main.line_code') }}</p>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 col-xs-6">
                    <div class="block wow fadeInRight" data-wow-delay=".7s">
                        <i class="ion-compose"></i>
                        <p class="count-text">
                            <span class="counter-digit">399</span>
                        </p>
                        <p>{{ trans('main.line_code') }}</p>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 col-xs-6">
                    <div class="block wow fadeInRight" data-wow-delay=".9s">
                        <i class="ion-image"></i>
                        <p class="count-text">
                            <span class="counter-digit">9995</span>
                        </p>
                        <p>{{ trans('main.line_code') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @if(isset($portfolio))
    <section id="portfolio">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="title">
                        <h2>{{ trans('main.latest_work') }}</h2>
                        <p>{!! trans('main.fake_content') !!}</p>
                    </div>
                    <div class="block">
                        <div class="recent-work-pic">
                            <ul id="mixed-items">
                                @foreach($portfolio as $p)
                                <li class="mix category-1 col-md-4 col-xs-6" data-my-order="1">
                                    @if($p->post_have_thumbnail())


                                    <a class="example-image-link" href="{{ asset('public/uploads/full/' . $p->media->guid) }}" data-lightbox="example-set">
                                        <img class="img-responsive" alt="{{ $p->post_title }}"
                                             src="{{ asset('public/uploads/full/' . $p->media->guid) }}">
                                        <div class="overlay">
                                            <h3>{{ $p->post_title }}</h3>
                                            <i class="ion-ios-plus-empty"></i>
                                        </div>
                                    </a>
                                    @endif
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endif

    <section id="play-video">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="block">
                        <h2 class="wow fadeInUp" data-wow-delay=".3s">{{ trans('main.watch_video') }}</h2>
                        <p class="wow fadeInUp" data-wow-delay=".5s">{!! trans('main.fake_content') !!}</p>
                        <a href="https://vimeo.com/channels/staffpicks/145743834" class="html5lightbox" data-width=800 data-height=400>
                            <div class="button ion-ios-play-outline wow zoomIn" data-wow-delay=".3s"></div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @if(isset($team))
    <section id="team">
        <div class="container">
            <div class="row">
                <div class="title">
                    <h2>{{ trans('main.team') }}</h2>
                    <p>{!! trans('main.fake_content') !!}</p>
                </div>

                @foreach($team as $item)
                    <?php $extra = !empty($item->extra) ? json_decode($item->extra, true) : []; ?>
                <div class="col-md-4 col-sm-4 col-xs-6">
                    <div class="block wow fadeInLeft" data-wow-delay=".3s">
                        @if($item->post_have_thumbnail())
                            <img class="img-responsive" alt="{{ $item->post_title }}"
                                 src="{{ asset('public/uploads/full/' . $item->media->guid) }}">
                        @endif
                        <div class="team-overlay">
                            <h3>{{ $item->post_title }}<span>{{ isset($extra['job']) ? $extra['job']: '' }}</span></h3>
                            <span class="icon"><i class="ion-quote"></i></span>
                            <p>{{ $item->post_excerpt }}</p>
                        </div>
                    </div>
                </div>
                @endforeach

            </div>
        </div>
    </section>
    @endif

    <section id="pricing-table">
        <div class="container">
            <div class="row">
                <div class="title">
                    <h2>{{ trans('main.pricing_table') }}</h2>
                    <p>{!! trans('main.fake_content') !!}</p>
                </div>
                <div class="col-md-4 col">
                    <div class="block text-center wow fadeInLeft" data-wow-delay=".3s">
                        <ul>
                            <li>
                                <h4>STARTER PACK</h4>
                                <p>&#36; 40 <span>/Month</span></p>
                            </li>
                            <li><p>Unlimited Downloads</p></li>
                            <li><p>Unlimited Uploads</p></li>
                            <li><p>Unlimited Email Accounts</p></li>
                            <li><p> Email Forwards </p></li>
                            <li><p>Cloud Storage</p></li>
                            <li><p>Screen Share</p></li>
                            <li>
                                <a href="#" class="btn btn-buy">BUY NOW</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-4 col">
                    <div class="block text-center wow zoomIn" data-wow-delay=".3s">
                        <ul>
                            <li>
                                <h4>STARTER PACK</h4>
                                <p>&#36; 40 <span>/Month</span></p>
                            </li>
                            <li><p>Unlimited Downloads</p></li>
                            <li><p>Unlimited Uploads</p></li>
                            <li><p>Unlimited Email Accounts</p></li>
                            <li><p> Email Forwards </p></li>
                            <li><p>Cloud Storage</p></li>
                            <li><p>Screen Share</p></li>
                            <li>
                                <a href="#" class="btn btn-buy">BUY NOW</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-4 col">
                    <div class="block text-center wow fadeInRight" data-wow-delay=".3s">
                        <ul>
                            <li>
                                <h4>STARTER PACK</h4>
                                <p>&#36; 40 <span>/Month</span></p>
                            </li>
                            <li><p>Unlimited Downloads</p></li>
                            <li><p>Unlimited Uploads</p></li>
                            <li><p>Unlimited Email Accounts</p></li>
                            <li><p> Email Forwards </p></li>
                            <li><p>Cloud Storage</p></li>
                            <li><p>Screen Share</p></li>
                            <li>
                                <a href="#" class="btn btn-buy">BUY NOW</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @if(isset($recent_posts))
    <section id="blog">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="title">
                        <h2>{{ trans('main.blog') }}</h2>
                        <p>{!! trans('main.fake_content') !!}</p>
                    </div>
                    <div id="blog-post" class="owl-carousel">
                        @foreach($recent_posts as $recent_post)
                        <div>
                            <div class="block">
                                <a href="{{ route('frontend.blog.single.get', $recent_post->id) }}" title="{{ $recent_post->post_title }}">
                                    @if($recent_post->post_have_thumbnail())
                                        <img class="img-responsive" alt="{{ $recent_post->post_title }}"
                                             src="{{ asset('public/uploads/large/' . $recent_post->media->guid) }}">
                                    @endif
                                </a>
                                <div class="content">
                                    <h4><a href="{{ route('frontend.blog.single.get', $recent_post->id) }}">{{ $recent_post->post_title }}</a></h4>
                                    <small>By {{ $recent_post->author->name }} / {{ Date::parse($recent_post->created_at)->format('F j, Y') }}</small>
                                    <p>{{ str_limit($recent_post->post_excerpt, $limit = 80, $end = '...') }}</p>
                                    <a href="{{ route('frontend.blog.single.get', $recent_post->id) }}" class="btn btn-read">{{ trans('main.read_more') }}</a>

                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endif

    @if(isset($testimonials))
    <section id="testimonial">
        <div class="container">
            <div class="row">
                <div class="title">
                    <h2>{{ trans('main.testimonial') }}</h2>
                    <p>{!! trans('main.fake_content') !!}</p>
                </div>

                @foreach($testimonials as $testimonial)
                <div class="col col-md-6">
                    <div class="media wow fadeInLeft" data-wow-delay=".3s">
                        <div class="media-left">
                            <a href="#">
                                @if($testimonial->post_have_thumbnail())
                                    <img alt="{{ $testimonial->post_title }}"
                                         src="{{ asset('public/uploads/full/' . $testimonial->media->guid) }}">
                                @endif
                            </a>
                        </div>
                        <div class="media-body">
                            <a href="#"><h4 class="media-heading">{{ $testimonial->post_title }}</h4></a>
                            <p>{{ $testimonial->post_excerpt }}</p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    @if(isset($clients))
    <section id="client-logo">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="block">
                        <div id="Client_Logo" class="owl-carousel">
                            @foreach($clients as $client)
                                <?php $extra = !empty($client->extra) ? json_decode($client->extra, true) : []; ?>
                            <div>
                                <a href="{{ isset($extra['url']) ? $extra['url']: '$' }}">
                                    @if($client->post_have_thumbnail())
                                        <img class="img-responsive" alt="{{ $client->post_title }}"
                                             src="{{ asset('public/uploads/full/' . $client->media->guid) }}">
                                    @endif
                                </a>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endif

    <section id="contact-form">
        <div class="container">
            <div class="row">
                <div class="title">
                    <h2>{{ trans('main.contact_us') }}</h2>
                    <p>{!! trans('main.fake_content') !!}</p>
                </div>
                <div class="col-md-6 col">
                    <!-- map -->
                    <div class="map">
                        <div id="googleMap"></div>
                    </div><!--/map-->

                </div>
                <div class="col-md-6">
                    <form method="post" action="">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="text" class="form-control" id="name" name="name" placeholder="Name">
                        <div class="error" id ="name_error"></div>
                        <input type="text" class="form-control" id="email" name="email" placeholder="Email">
                        <div class="error" id ="email_error"></div>
                        <textarea class="form-control" rows="3" id="msg" name="msg" placeholder="Message"></textarea>
                        <div class="error" id ="msg_error"></div>
                        <button class="btn btn-primary" type="submit">
                            <span class="btn-text">{{ trans('main.send_msg') }}</span>
                            <div class="la-ball-fall btn-loader hidden">
                                <div></div>
                                <div></div>
                                <div></div>
                            </div>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>
    
@endsection

@section('scripts')
<script src="{{ asset('public/assets/site') }}/js/sweetalert.min.js"></script>
<script>
    // swal("Here's a message!")

    function validateForm(name, email, subject, msg) {

        var required = "{{ trans('validation.required') }}";
        var email_validation = "{{ trans('validation.email') }}";

        var error = false;
        $('.error').html('');

        if (name == null || name == "") {
            $('#name_error').html(required);
            error = true;
        }


        if (msg == null || msg == "") {
            $('#msg_error').html(required);
            error = true;
        }

        var atpos = email.indexOf("@");
        var dotpos = email.lastIndexOf(".");

        if (email == null || email == "") {
            $('#email_error').html(required);
            error = true;
        } else if (atpos<1 || dotpos<atpos+2 || dotpos+2>=email.length) {
            $('#email_error').html(email_validation);
            error = true;
        }

        return error;
    }

    $(function(){

        $( "form" ).submit(function( event ) {
            event.preventDefault();

            var name = $('#name').val();
            var email = $('#email').val();
            var subject = $('#subject').val();
            var msg = $('#msg').val();

            if(!validateForm(name, email, subject, msg)) {

                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: "POST",
                    url: "{{ route('frontend.contact.post') }}",
                    data: 'name=' + name + '&email=' + email + '&msg=' + msg,
                    datatype: 'json',
                    context: this,
                    beforeSend: function () {
                        $('.btn-text').addClass('hidden');
                        $('.btn-loader').removeClass('hidden');
                    },
                    success: function (data) {
                        if (data.success) {
                            swal("{{ trans('main.thanks') }}", "{{ trans('main.ur_msg_success') }}", "success");
                            $('input').val('');
                            $('textarea').val('');
                        } else {
                            $.each(data.errors, function (index, value) {
                                var errorDiv = '#' + index + '_error';
                                $(errorDiv).addClass('required');
                                $(errorDiv).empty().append(value);
                            });
                            $('#successMessage').empty();
                            swal("{{ trans('main.oops') }}", "{{ trans('main.ur_msg_faild') }}", "error");
                        }
                        $('.btn-loader').addClass('hidden');
                        $('.btn-text').removeClass('hidden');

                    }
                });
            }

        });

    });
</script>
@endsection