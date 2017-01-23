@extends('admin::layouts.master')

@section('styles')

@stop

@section('content')

        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN EXAMPLE TABLE PORTLET-->
                <div class="portlet light bordered">
                    <div class="portlet-title">
                        <div class="caption font-dark">
                            <i class="icon-settings font-dark"></i>
                            <span class="caption-subject bold uppercase">@if(isset($role)) {{$role->display_name}} @else Add New Role @endif</span>
                        </div> 
                    </div>
                    <!-- BEGIN PAGE BASE CONTENT -->

                    <form  class="form-horizontal" method="post" enctype="multipart/form-data" action="@if(isset($role)){{ route('admin.roles.edit.post', $role->id) }} @else {{ route('admin.roles.add.post') }} @endif">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
               
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                                    <div class="col-md-3">
                                        Role Name *
                                    </div>
                                    <div class="col-md-5">
                                        <input type="text" name="name" class="form-control" maxlength="255" placeholder="Name (required)" required id="name" value="@if(isset($role)){{trim($role->name)}}@else{{old('name')}}@endif">
                                        @if ($errors->has('name'))
                                            <span class="help-block">{{ $errors->first('name') }}</span>
                                        @endif
                                    </div>
                                </div>
                                
                                <div class="form-group {{ $errors->has('display_name') ? ' has-error' : '' }}">
                                    <div class="col-md-3">
                                        Role Display Name *
                                    </div>
                                    <div class="col-md-5">
                                        <input type="text" name="display_name" class="form-control" maxlength="255" placeholder="Display Name (required)" required value="@if(isset($role)){{trim($role->display_name)}}@else{{old('display_name')}}@endif">
                                        @if ($errors->has('display_name'))
                                            <span class="help-block">{{ $errors->first('display_name') }}</span>
                                        @endif
                                    </div>
                                </div>
  

                                @if(isset($categories))
                                <div class="panel-group accordion roles" id="accordion3">
                                    @foreach($categories as $k => $category)
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                           <h4 class="panel-title">
                                              <a class="accordion-toggle accordion-toggle-styled collapsed" data-toggle="collapse" data-parent="#accordion3" href="#{{ $k }}" aria-expanded="false"> {{ $k }} </a>
                                           </h4>
                                        </div>
                                        <div id="{{ $k }}" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
                                           <div class="panel-body">
                                            @foreach($category as $permission)
                                            <label for="{{ $permission->name }}" class="row">
                                                <div class="col-md-4 col-xs-5 col-sm-4">
                                                   {{ $permission->display_name }}
                                                </div>
                                                <div class="col-md-8">
                                                    <input type="checkbox" name="permissions[]" value="{{ $permission->id }}" id="{{ $permission->name }}" class="form-control" @if(isset($permission_role) && in_array($permission->id, $permission_role)) checked @endif>
                                                </div>
                                            </label>

                                            @endforeach

                                           </div>
                                        </div>
                                    </div>
                                    @endforeach
                                @endif
                                </div>


                                <div class="form-group">
                                    <div class="col-md-3"></div>
                                    <div class="col-md-9">
                                        <input type="submit" class="btn blue" value="@if(isset($role)) Edit @else Add New Role @endif">
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