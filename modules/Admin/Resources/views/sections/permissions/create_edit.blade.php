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
                            <span class="caption-subject bold uppercase">@if(isset($permission))  {{$permission->display_name}} @else Add New Permission @endif </span>
                        </div> 
                    </div>
                    <!-- BEGIN PAGE BASE CONTENT -->

                    <form  class="form-horizontal" method="post" enctype="multipart/form-data" action="@if(isset($permission)){{ route('admin.permissions.edit.post', $permission->id) }} @else {{ route('admin.permissions.add.post') }} @endif">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
               
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                                    <div class="col-md-3">
                                        Name *
                                    </div>
                                    <div class="col-md-5">
                                        <input type="text" name="name" class="form-control" maxlength="255" placeholder="Name (required)" required id="name" value="@if(isset($permission)){{trim($permission->name)}}@else{{old('name')}}@endif">
                                        @if ($errors->has('name'))
                                            <span class="help-block">{{ $errors->first('name') }}</span>
                                        @endif
                                    </div>
                                </div>
                                
                                <div class="form-group {{ $errors->has('display_name') ? ' has-error' : '' }}">
                                    <div class="col-md-3">
                                        Display Name *
                                    </div>
                                    <div class="col-md-5">
                                        <input type="text" name="display_name" class="form-control" maxlength="255" placeholder="Display Name (required)" required value="@if(isset($permission)){{trim($permission->display_name)}}@else{{old('display_name')}}@endif">
                                        @if ($errors->has('display_name'))
                                            <span class="help-block">{{ $errors->first('display_name') }}</span>
                                        @endif
                                    </div>
                                </div>
                                
                                <div class="form-group {{ $errors->has('description') ? ' has-error' : '' }}">
                                    <div class="col-md-3">
                                        Description
                                    </div>
                                    <div class="col-md-5">
                                        <textarea name="description" class="form-control"  placeholder="Description">
                                            @if(isset($permission)){{trim($permission->description)}}@else{{old('description')}}@endif
                                        </textarea>
                                        @if ($errors->has('description'))
                                            <span class="help-block">{{ $errors->first('description') }}</span>
                                        @endif
                                    </div>
                                </div>
                                
                                <div class="form-group {{ $errors->has('category') ? ' has-error' : '' }}">
                                    <div class="col-md-3">
                                        Category
                                    </div>
                                    <div class="col-md-5">
                                        <?php $selected_category = isset($permission) ? $permission->category : old('category'); ?>
                                        <select class="form-control" name="category" required>
                                            <option disabled selected hidden>Select category</option>
                                            <option value="dashboard" {{ $selected_category == 'dashboard' ? 'selected' : '' }}>Dashboard</option>
                                            <option value="post" {{ $selected_category == 'post' ? 'selected' : '' }}>Posts</option>
                                            <option value="category" {{ $selected_category == 'category' ? 'selected' : '' }}>Categories</option>
                                            <option value="page" {{ $selected_category == 'page' ? 'selected' : '' }}>Pages</option>
                                            <option value="gallery" {{ $selected_category == 'gallery' ? 'selected' : '' }}>Gallery</option>
                                            <option value="settings" {{ $selected_category == 'settings' ? 'selected' : '' }}>Settings</option>
                                            <option value="comment" {{ $selected_category == 'comment' ? 'selected' : '' }}>Comments</option>
                                            <option value="media" {{ $selected_category == 'media' ? 'selected' : '' }}>Media</option>
                                            <option value="user" {{ $selected_category == 'user' ? 'selected' : '' }}>User</option>
                                        </select>
                                        @if ($errors->has('category'))
                                            <span class="help-block">{{ $errors->first('category') }}</span>
                                        @endif
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <div class="col-md-3"></div>
                                    <div class="col-md-9">
                                        <input type="submit" class="btn blue" value="@if(isset($permission)) Edit @else Add New Permission @endif">
                                    </div>
                                </div>

                                
                            </div>

                        </div>
                    </form>
                    <!-- END PAGE BASE CONTENT -->
                </div>
            </div>
                    <div class="modal fade" id="full" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog modal-full">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                    <h4 class="modal-title">Modal Title</h4>
                                </div>
                                <div class="modal-body"> Modal body goes here </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn dark btn-outline" data-dismiss="modal">Close</button>
                                    <button type="button" class="btn green">Save changes</button>
                                </div>
                            </div>
                            <!-- /.modal-content -->
                        </div>
                        <!-- /.modal-dialog -->
                    </div>
                    <!-- /.modal -->

@stop
@section('scripts')


@stop