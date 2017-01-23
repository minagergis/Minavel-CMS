@extends('admin::layouts.master')


@section('styles')
<link href="{{ asset('public/assets/admin/global/plugins/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('public/assets/admin/global/plugins/select2/css/select2-bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
@stop
@section('content')

        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN EXAMPLE TABLE PORTLET-->
                <div class="portlet light bordered">
                    <div class="portlet-title">
                        <div class="caption font-dark">
                            <i class="icon-settings font-dark"></i>
                            <span class="caption-subject bold uppercase">@if(isset($zone)) Edit {{$zone->name}} @else Add New zone @endif</span>
                        </div> 
                    </div>
                    <!-- BEGIN PAGE BASE CONTENT -->
                    <?php 
                        $id = e(\Request::get('id')); 
                        if(isset($action)) {
                            $get_parameters = ($action == 'add') ? "lang=" . $current_lang : "lang=" . $current_lang . "&id=" . $id ;
                        }
                    ?>
                    <form  class="form-horizontal" method="post" enctype="multipart/form-data" action="@if(isset($action) && $action == 'edit'){{ route('admin.zone.edit.post', $zone->id) }} @else  {{ route('admin.zone.add.post', $get_parameters) }} @endif">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                        <input type="hidden" name="current_lang" value="{{ $current_lang }}">
                        @if(isset($zone))
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
                                        <input type="text" name="name" class="form-control" maxlength="255" placeholder="Name" value="@if(isset($zone)){{$zone->translate($current_lang, true)->name}}@else{{ old('name')}}@endif">
                                        @if ($errors->has('name'))
                                            <span class="help-block">{{ $errors->first('name') }}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group {{ $errors->has('city') ? ' has-error' : '' }}">
                                    <div class="col-md-3">
                                        City
                                        <span class="required" aria-required="true">*</span>
                                    </div>
                                    <div class="col-md-4">
                                        <?php $selected_city = isset($zone) ? $zone->city_id : old('city'); ?>
                                        <select class="form-control select2me" name="city">
                                            <option value="" hidden>Select...</option>
                                        @if(isset($cities))
                                            @foreach($cities as $city)
                                            <option value="{{ $city->id }}" @if($selected_city == $city->id) selected @endif>{{ $city->name }}</option>
                                            @endforeach
                                        @endif
                                        </select>
                                        @if ($errors->has('city'))
                                            <span class="help-block">{{ $errors->first('city') }}</span>
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
                                        <input type="submit" class="btn blue" value="@if(isset($zone)) Edit @else Add New zone @endif">
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
<script src="{{ asset('public/assets/admin/global/plugins/select2/js/select2.full.min.js') }}" type="text/javascript"></script>
@stop