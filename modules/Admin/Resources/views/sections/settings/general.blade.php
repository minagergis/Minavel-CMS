@extends('admin::layouts.master')

@section('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('public/assets/admin/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css') }}"/>
    @stop

    @section('content')


            <!-- BEGIN PAGE BASE CONTENT -->

    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption font-dark">
                        <i class="icon-settings font-dark"></i>
                        <span class="caption-subject bold uppercase"> General Settings</span>
                    </div>
                </div>
                <div class="portlet-body">

                    <form class="form-horizontal" role="form" method="post" action="{{ route('admin.settings.general.post') }}">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="type" value="$-F3{j&z@qfn,{!-">
                        <div class="form-body">
                            @foreach(Config::get('settings.attributes') as $attr)
                                @if($attr['type'] === 'textarea')
                                    <div class="form-group {{{ $errors->has($attr['slug']) ? 'has-error' : '' }}}">
                                        <label class="col-md-3" for="username">{{ $attr['name'] }}</label>
                                        <div class="col-md-5">
                                            <textarea rows="6"  name="{{ $attr['slug'] }}" id="{{ $attr['slug'] }}" class="form-control">{{ \Request::old($attr['slug'], settings($attr['slug'])) }}</textarea>
                                            {!!$errors->first($attr['slug'], '<span class="help-block">:message </span>')!!}
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                @else
                                    <div class="form-group {{{ $errors->has($attr['slug']) ? 'has-error' : '' }}}">
                                        <label class="col-md-3" for="username">{{ $attr['name'] }}</label>
                                        <div class="col-md-5">
                                            <input type="{{ $attr['type'] }}" name="{{ $attr['slug'] }}" id="{{ $attr['slug'] }}" class="form-control" placeholder="" value="{{{ \Request::old($attr['slug'], settings($attr['slug'])) }}}" required>
                                            {!!$errors->first($attr['slug'], '<span class="help-block">:message </span>')!!}
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                @endif

                            @endforeach
                        </div>
                        <button type="submit" class="btn green">Save Changes</button>

                    </form>

                </div>
            </div>
            <!-- END EXAMPLE TABLE PORTLET-->
        </div>
    </div>
    <!-- END PAGE BASE CONTENT -->

@stop
@section('scripts')


@stop