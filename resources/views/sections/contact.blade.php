@extends('layouts.master')

@section('styles')
   <link href="{{ asset('public/assets/site/css/sweetalert.css') }}" rel="stylesheet">
@endsection

@section('content')

        <!-- Page Title -->
<div class="title-bar">
    <div class="container">
        <h1 class="page-title">{{ trans('main.contact') }}</h1>
        <div class="">
            <a href="{{ route('frontend.home.get') }}">{{ trans('main.home') }} </a> <span>/</span> <a href="#">{{ trans('main.contact') }}</a>
        </div>
    </div>
</div>

<br><br>

<div class="content container contact">
    <div class="map"></div>

    <br><br>
    <div class="row">
        <div class="col-md-4">
            <div class="col-md-5">
                <div class="aio-icon text-center">
                    <span><i class="fa fa-rocket fa-5"></i></span>
                </div>
            </div>
            <div class="col-md-7">
                <div class="aio-ibd-block">
                    <div class="aio-icon-header">
                        <h3 class="aio-icon-title ult-responsive">CONTACT SUPPORT</h3>
                    </div> <!-- header -->
                    <div class="aio-icon-description ult-responsive">
                        <p>Open a Support Ticket to get answers.</p>
                    </div> <!-- description --></div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="col-md-5">
                <div class="aio-icon text-center">
                    <span><i class="fa fa-rocket fa-5"></i></span>
                </div>
            </div>
            <div class="col-md-7">
                <div class="aio-ibd-block">
                    <div class="aio-icon-header">
                        <h3 class="aio-icon-title ult-responsive">CONTACT SUPPORT</h3>
                    </div> <!-- header -->
                    <div class="aio-icon-description ult-responsive">
                        <p>Open a Support Ticket to get answers.</p>
                    </div> <!-- description --></div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="col-md-5">
                <div class="aio-icon text-center">
                    <span><i class="fa fa-rocket fa-5"></i></span>
                </div>
            </div>
            <div class="col-md-7">
                <div class="aio-ibd-block">
                    <div class="aio-icon-header">
                        <h3 class="aio-icon-title ult-responsive">CONTACT SUPPORT</h3>
                    </div> <!-- header -->
                    <div class="aio-icon-description ult-responsive">
                        <p>Open a Support Ticket to get answers.</p>
                    </div> <!-- description --></div>
            </div>
        </div>
    </div>

    <br><br>

    <div>

        <div class="text-center">
            <h2 class="black-color"><b>{{ trans('main.talk_us') }}</b></h2>
            <div class="heading-spacer">
                <span class="headings-line"></span>
            </div>
        </div>

        <br><br>

        <div class="row">
            <div class="col-md-4">
                <h4><b>Before Contact</b></h4>

                <p>Lorem ipsum dolor sit amet, consectetur adipisici elit, sed eiusmod tempor incidunt ut labore et
                    dolore magna aliqua. Non equidem invideo, miror magis posuere velit aliquet.</p>

                <h3><b>Social Media</b></h3>

                <p>Lorem ipsum dolor sit amet, consectetur adipisici elit, sed eiusmod tempor incidunt ut labore et
                    dolore magna aliqua. Non equidem invideo, miror magis posuere velit aliquet.</p>

                <div class="social">
                    <span class="scp-icon scp-icon-background pull-left"
                          style="width:38px;margin:0 3px 0 0;text-align:center;">
                                                <a href="#" target="_blank">
                                                    <i class="fa fa fa-facebook"
                                                       style="color:#fff;font-size:20px;line-height:38px;"
                                                       onmouseover="this.style.color='#ddd'"
                                                       onmouseout="this.style.color='#fff'"></i>
                                                </a>
                                            </span>
                    <span class="scp-icon scp-icon-background pull-left"
                          style="width:38px;margin:0 3px 0 0;text-align:center;">
                                                <a href="#" target="_blank">
                                                    <i class="fa fa fa-twitter"
                                                       style="color:#fff;font-size:20px;line-height:38px;"
                                                       onmouseover="this.style.color='#ddd'"
                                                       onmouseout="this.style.color='#fff'"></i>
                                                </a>
                                            </span>
                    <span class="scp-icon scp-icon-background pull-left"
                          style="width:38px;margin:0 3px 0 0;text-align:center;">
                                                <a href="#" target="_blank">
                                                    <i class="fa fa fa-linkedin"
                                                       style="color:#fff;font-size:20px;line-height:38px;"
                                                       onmouseover="this.style.color='#ddd'"
                                                       onmouseout="this.style.color='#fff'"></i>
                                                </a>
                                            </span>
                </div>
            </div>

            <div class="col-md-8">

                @if (Session::has('faild'))
                    <div class="alert alert-danger">
                        <button class="close" data-close="alert"></button> {{ \Session::get('faild')}}</div>
                @endif

                @if (Session::has('success'))
                    <div class="alert alert-success">
                        <button class="close" data-close="alert"></button> {{ \Session::get('success')}} </div>
                @endif

                <form method="post" action="{{ route('frontend.contact.post') }}">
                    {!! csrf_field() !!}
                    <div class="col-md-6">
                        <div>
                            <label>{{ trans('main.name') }}</label><br>
                            <input type="text" name="name" id="name">
                            <div class="error" id ="name_error"></div>
                        </div>
                        <br>
                        <div>
                            <label>{{ trans('main.email') }}</label><br>
                            <input type="text" name="email" id="email">
                            <div class="error" id ="email_error"></div>
                        </div>
                        <br>
                        <div>
                            <label>{{ trans('main.subject') }}</label><br>
                            <input type="text" name="subject" id="subject">
                            <div class="error" id ="subject_error"></div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label>{{ trans('main.message') }}</label>
                        <textarea style="min-height: 212px" name="msg" id="msg"></textarea>
                        <div class="error" id ="msg_error"></div>
                        <div class="pull-right">
                            <br>
                            <button>
                                <span class="btn-text">{{ trans('main.send_msg') }}</span>
                                <div class="la-ball-fall btn-loader hidden">
                                    <div></div>
                                    <div></div>
                                    <div></div>
                                </div>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

    </div>
</div>

<br><br>
@endsection

@section('scripts')
    <script src="{{ asset('public/assets/site/js/sweetalert.min.js') }}"></script>
    <script>
       // swal("Here's a message!")

       $(function(){

       $( "form" ).submit(function( event ) {
           event.preventDefault();

           var name = $('#name').val();
           var email = $('#email').val();
           var subject = $('#subject').val();
           var msg = $('#msg').val();

           $.ajax({
               headers: {
                   'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
               },
               type: "POST",
               url: "{{ route('frontend.contact.post') }}",
               data: 'name=' + name + '&email=' + email + '&subject=' + subject + '&msg=' + msg,
               datatype: 'json',
               context: this,
               beforeSend: function() {
                   $('.btn-text').addClass('hidden');
                   $('.btn-loader').removeClass('hidden');
               },
               success: function (data) {
                   if (data.success) {
                       swal("Good job!", "You clicked the button!", "success")
                   } else {
                       $.each(data.errors, function( index, value ) {
                           var errorDiv = '#'+index+'_error';
                           $(errorDiv).addClass('required');
                           $(errorDiv).empty().append(value);
                       });
                       $('#successMessage').empty();
                       swal("Oops...", "Something went wrong!", "error");
                   }
                   $('.btn-loader').addClass('hidden');
                   $('.btn-text').removeClass('hidden');

               }
           });

       });

       });
    </script>
@endsection
