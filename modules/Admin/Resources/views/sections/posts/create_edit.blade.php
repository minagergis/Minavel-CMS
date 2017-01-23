@extends('admin::layouts.master')

@section('styles')
    <link href="{{ asset('public/assets/admin/global/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css') }}"
          rel="stylesheet" type="text/css"/>

    <link rel="stylesheet" type="text/css"
          href="{{ asset('public/assets/admin/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css') }}"/>

    <link href="{{ asset('public/assets/admin/global/plugins/dropzone/dropzone.min.css') }}" rel="stylesheet"
          type="text/css"/>
    <link href="{{ asset('public/assets/admin/global/plugins/dropzone/basic.min.css') }}" rel="stylesheet"
          type="text/css"/>
@stop

@section('content')

    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption font-dark">
                        <i class="icon-settings font-dark"></i>
                        <span class="caption-subject bold uppercase">@if(isset($post)) Edit @else Add
                            New {{\Request::get('post_type')}} @endif</span>
                    </div>
                    <div class="actions">
                        <div class="btn-group btn-group-devided" data-toggle="buttons">
                            <label class="btn btn-transparent dark btn-outline btn-circle btn-sm ">
                                <input type="checkbox" name="screen-options" class="toggle" id="screen-options">Screen
                                Options</label>
                            <label class="btn btn-transparent dark btn-outline btn-circle btn-sm">
                                <input type="radio" name="options" class="toggle" id="option2">Help</label>
                        </div>
                    </div>
                </div>

                @include('admin::partials.screen_options')
                        <!-- BEGIN PAGE BASE CONTENT -->
                <?php
                $id = e(\Request::get('id'));
                if (isset($action)) {
                    $get_parameters = ($action == 'add') ? "lang=" . $current_lang : "lang=" . $current_lang . "&id=" . $id;
                }

                ?>
                <form class="form-horizontal" method="post" enctype="multipart/form-data"
                      action="@if(isset($action) && $action == 'edit'){{ route('admin.posts.edit.post', [$post->id, 'post_type='.\Request::get('post_type'), 'lang='. $current_lang]) }} @else  {{ route('admin.posts.add.post', 'post_type='.\Request::get('post_type').'&'.$get_parameters) }} @endif">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
                    <input type="hidden" name="current_lang" value="{{ $current_lang }}">
                    <input type="hidden" name="post_type"
                           value="@if(\Request::get('post_type') != null){{\Request::get('post_type')}}@else'post'@endif">

                    <div class="row">
                        <div class="col-md-8">
                            <div class="form-group {{ $errors->has('post_title') ? ' has-error' : '' }}">
                                <div class="col-md-12">
                                    <input type="text" name="post_title" class="form-control" maxlength="255"
                                           placeholder="Enter Title here" value="{{ isset($post) && $post->translate($current_lang) !== null ? $post->translate($current_lang)->post_title : old('post_title') }}">
                                    @if ($errors->has('post_title'))
                                        <span class="help-block">{{ $errors->first('post_title') }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group {{ $errors->has('slug') ? ' has-error block' : '' }} slug">
                                <div class="col-md-12">
                                    <input type="text" name="slug" class="form-control" maxlength="255"
                                           placeholder="Enter slug here"
                                           value="{{ isset($post) ? trim($post->slug) : old('slug') }}">
                                    @if ($errors->has('slug'))
                                        <span class="help-block">{{ $errors->first('slug') }}</span>
                                    @endif
                                </div>
                            </div>

                            <br>
                            <div class="form-group {{ $errors->has('post_content') ? ' has-error' : '' }}">
                                <div class="col-md-12">
                                    <textarea name="post_content" class="ckeditor form-control"
                                              rows="6">{{ isset($post) && $post->translate($current_lang) !== null ? $post->translate($current_lang)->post_content : old('post_content') }}</textarea>
                                    @if ($errors->has('post_content'))
                                        <span class="help-block">{{ $errors->first('post_content') }}</span>
                                    @endif
                                </div>
                            </div>

                            <br><br>
                            <div class="form-group {{ $errors->has('post_excerpt') ? ' has-error' : '' }} excerpt">
                                <div class="col-md-12">
                                    <textarea name="post_excerpt" class="form-control" rows="6"
                                              placeholder="Enter post excerpt here">{{ isset($post) && $post->translate($current_lang) !== null ? $post->translate($current_lang)->post_excerpt : old('post_excerpt') }}</textarea>
                                    @if ($errors->has('post_excerpt'))
                                        <span class="help-block">{{ $errors->first('post_excerpt') }}</span>
                                    @endif
                                </div>
                            </div>

                            @include('admin::sections.posts.seo')
                            @include('admin::sections.posts.extra')

                            <div class="form-group {{ $errors->has('author') ? ' has-error' : '' }}">
                                <div class="col-md-12">
                                    <label class="label-control">Author </label>
                                    <?php $selected_author = isset($post) ? $post->author : old('author'); ?>
                                    <select name="author" class="form-control input-small">
                                        @foreach($users as $user)
                                            <option value="{{ $user->id }}" {{ $selected_author == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('author'))
                                        <span class="help-block">{{ $errors->first('author') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            @include('admin::partials.sidebar_post')
                        </div>
                    </div>

                <!-- END PAGE BASE CONTENT -->


            </div>
        </div>

    </div>

@stop

@section('scripts')
    <script src="{{ asset('public/assets/admin/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js') }}"
            type="text/javascript"></script>
    <script src="{{ asset('public/assets/admin/global/plugins/ckeditor/ckeditor.js') }}"
            type="text/javascript"></script>
    <script src="{{ asset('public/assets/admin/global/plugins/bootstrap-tagsinput/bootstrap-tagsinput.min.js') }}"
            type="text/javascript"></script>
@stop