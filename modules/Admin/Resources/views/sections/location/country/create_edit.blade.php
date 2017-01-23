@extends('admin::layouts.master')

@section('styles')
<link rel="stylesheet" type="text/css" href="{{ asset('public/assets/admin/global/plugins/bootstrap-formhelpers/dist/css/bootstrap-formhelpers.min.css') }}"/>
@stop

@section('content')

        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN EXAMPLE TABLE PORTLET-->
                <div class="portlet light bordered">
                    <div class="portlet-title">
                        <div class="caption font-dark">
                            <i class="icon-settings font-dark"></i>
                            <span class="caption-subject bold uppercase">@if(isset($country)) Edit {{$country->name}} @else Add New Country @endif</span>
                        </div> 
                    </div>
                    <!-- BEGIN PAGE BASE CONTENT -->
                    <?php 
                        $id = e(\Request::get('id')); 
                        if(isset($action)) {
                            $get_parameters = ($action == 'add') ? "lang=" . $current_lang : "lang=" . $current_lang . "&id=" . $id ;
                        }
                    ?>
                    <form  class="form-horizontal" method="post" enctype="multipart/form-data" action="@if(isset($action) && $action == 'edit'){{ route('admin.country.edit.post', $country->id) }} @else  {{ route('admin.country.add.post', $get_parameters) }} @endif">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                        <input type="hidden" name="current_lang" value="{{ $current_lang }}">
                        @if(isset($country))
                        <input type="hidden" name="id" value="{{ $id }}">
                        @endif
                        <div class="row">
                            <div class="col-md-12">
                                
                                <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                                    <div class="col-md-3">
                                        Name
                                        <span class="required" aria-required="true">*</span>
                                    </div>
                                    <div class="col-md-4">
                                        <input type="text" name="name" class="form-control" maxlength="255" placeholder="Name" value="{{ isset($country) && $country->translate($current_lang) !== null ? $country->translate($current_lang)->name : old('name') }}">
                                        @if ($errors->has('name'))
                                            <span class="help-block">{{ $errors->first('name') }}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group {{ $errors->has('code') ? ' has-error' : '' }}">
                                    <div class="col-md-3">
                                        Code
                                        <span class="required" aria-required="true">*</span>
                                    </div>
                                    <div class="col-md-4">
                                        <input type="text" name="code" class="form-control" maxlength="3" placeholder="Code" value="{{ isset($country) ? $country->code : old('code') }}">
                                        @if ($errors->has('code'))
                                            <span class="help-block">{{ $errors->first('code') }}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group {{ $errors->has('code2') ? ' has-error' : '' }}">
                                    <div class="col-md-3">
                                        Code2
                                        <span class="required" aria-required="true">*</span>
                                    </div>
                                    <div class="col-md-4">
                                        <input type="text" name="code2" class="form-control" maxlength="2" placeholder="Code" value="{{ isset($country) ? $country->code2 : old('code2') }}">
                                        @if ($errors->has('code2'))
                                            <span class="help-block">{{ $errors->first('code2') }}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group {{ $errors->has('continent') ? ' has-error' : '' }}">
                                    <div class="col-md-3">
                                        Continent
                                        <span class="required" aria-required="true">*</span>
                                    </div>
                                    <div class="col-md-4">
                                        <?php $continent = isset($country) ? $country->continent : old('continent'); ?>
                                        <select class="form-control" name="continent">
                                            <option value="" hidden>Select...</option>
                                            <option value="1" @if($continent == 1) selected @endif>أفريقيا</option>
                                            <option value="2" @if($continent == 2) selected @endif>آسيا</option>
                                            <option value="3" @if($continent == 3) selected @endif>أمريكا الشمالية</option>
                                            <option value="4" @if($continent == 4) selected @endif>أمريكا الجنوبية</option>
                                            <option value="5" @if($continent == 5) selected @endif>انتاركتيكا</option>
                                            <option value="6" @if($continent == 6) selected @endif>أوروبا</option>
                                            <option value="7" @if($continent == 7) selected @endif>أوقيانوسيا</option>
                                        </select>
                                        @if ($errors->has('continent'))
                                            <span class="help-block">{{ $errors->first('continent') }}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group {{ $errors->has('locale') ? ' has-error' : '' }}">
                                    <div class="col-md-3">
                                        Language
                                        <span class="required" aria-required="true">*</span>
                                    </div>
                                    <div class="col-md-4">
                                        <select class="form-control" name="locale">
                                            <option value="" hidden>Select language...</option>
                                        @if(isset($language))
                                            @foreach($language as $lang)
                                            <option value="{{ $lang->locale }}" @if($current_lang == $lang->locale) selected @endif>{{ $lang->name }}</option>
                                            @endforeach
                                        @endif
                                        </select>

                                         @if ($errors->has('locale'))
                                            <span class="help-block">{{ $errors->first('locale') }}</span>
                                        @endif
                                    </div>
                                </div>


                                <div class="form-group">
                                    <div class="col-md-3"></div>
                                    <div class="col-md-9">
                                        <input type="submit" class="btn blue" value="@if(isset($country)) Edit @else Add New Country @endif">
                                    </div>
                                </div>

                                
                            </div>

                        </div>
                    </form>
                    <!-- END PAGE BASE CONTENT -->
                </div>
            </div>


@stop
@section('scripts')


@stop