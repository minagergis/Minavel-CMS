@extends('admin::layouts.master')

@section('styles')

    <link href="{{ asset('public/assets/admin/global/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css') }}"
          rel="stylesheet" type="text/css"/>

    <link rel="stylesheet" type="text/css"
          href="{{ asset('public/assets/admin/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css') }}"/>
    <link rel="stylesheet" type="text/css"
          href="{{ asset('public/assets/admin/global/plugins/bootstrap-formhelpers/dist/css/bootstrap-formhelpers.min.css') }}"/>
    <link rel="stylesheet" type="text/css"
          href="{{ asset('public/assets/admin/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css') }}"/>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption font-dark">
                        <i class="icon-settings font-dark"></i>
                        <span class="caption-subject bold uppercase">@if(isset($webinfo))
                                Edit {{$webinfo->title}} @else Add New Category @endif</span>
                    </div>
                </div>
                <!-- BEGIN PAGE BASE CONTENT -->
                <?php
                $id = e(\Request::get('id'));
                if (isset($action)) {
                    $get_parameters = ($action == 'add') ? "lang=" . $current_lang : "lang=" . $current_lang . "&id=" . $id;
                }
                ?>
                <form class="form-horizontal" method="post" enctype="multipart/form-data"
                      action="@if(isset($action) && $action == 'edit'){{ route('admin.webinfo.edit.post', $webinfo->id) }} @endif">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
                    <input type="hidden" name="current_lang" value="{{ $current_lang }}">
                    <div class="row">
                        <div class="col-md-12">

                            <div class="form-group {{ $errors->has('title') ? ' has-error' : '' }}">
                                <div class="col-md-12">
                                    <label for="title">Web Title</label> <span class="required" aria-required="true">*</span>
                                    <input type="text" name="title" id="title" class="form-control" maxlength="255"
                                           placeholder="Web Title"
                                           value="{{ isset($webinfo) ? $webinfo->title : old('title') }}">
                                    The name is how it appears on your site.
                                    @if ($errors->has('title'))
                                        <span class="help-block">{{ $errors->first('title') }}</span>
                                    @endif
                                </div>
                            </div>


                            <div class="form-group {{ $errors->has('desc') ? ' has-error' : '' }}">
                                <div class="col-md-12">
                                    <label for="desc">Description</label>
                                    <textarea name="desc" id="desc"
                                              class="form-control">{{ isset($webinfo) ? $webinfo->desc : old('desc') }}</textarea>
                                    The description is not prominent by default; however, some themes may show it.
                                    @if ($errors->has('desc'))
                                        <span class="help-block">{{ $errors->first('desc') }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group {{ $errors->has('tags') ? ' has-error' : '' }}">
                                <div class="col-md-12">
                                    <label>Tags</label>
                                    <input type="text" name="tags"
                                           value="{{ isset($webinfo) ? $webinfo->tags : old('tags') }}" data-role="tagsinput">
                                    <div class="col-md-12">
                                        Separate tags with commas
                                    </div>

                                </div>
                            </div>

                            <?php
                            $extras = isset($webinfo) ? json_decode($webinfo->extras, true) : [];
                            $socials = isset($webinfo) ? json_decode($webinfo->socials, true) : [];
                            $stats = isset($webinfo) ? json_decode($webinfo->stats, true) : [];
                            ?>


                            <h2>Social Media Department</h2>

                            <div class="form-group">
                                <div class="col-md-12">
                                    <label><i class="fa fa-facebook-square" aria-hidden="true"></i> Facebook</label>
                                    <input type="text" name="socials[facebook]" class="form-control" value="{{ isset($socials['facebook']) ? $socials['facebook']: '' }}">
                                    @if ($errors->has('facebook'))
                                        <span class="help-block">{{ $errors->first('facebook') }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-12">
                                    <label><i class="fa fa-twitter" aria-hidden="true"></i> Twitter</label>
                                    <input type="text" name="socials[twitter]" class="form-control" value="{{ isset($socials['twitter']) ? $socials['twitter']: '' }}">
                                    @if ($errors->has('twitter'))
                                        <span class="help-block">{{ $errors->first('twitter') }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-12">
                                    <label><i class="fa fa-google-plus-square" aria-hidden="true"></i> Google Plus</label>
                                    <input type="text" name="socials[googleplus]" class="form-control" value="{{ isset($socials['googleplus']) ? $socials['googleplus']: '' }}">
                                    @if ($errors->has('googleplus'))
                                        <span class="help-block">{{ $errors->first('googleplus') }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-12">
                                    <label><i class="fa fa-linkedin-square" aria-hidden="true"></i> Linkedin</label>
                                    <input type="text" name="socials[linkedin]" class="form-control" value="{{ isset($socials['linkedin']) ? $socials['linkedin']: '' }}">
                                    @if ($errors->has('linkedin'))
                                        <span class="help-block">{{ $errors->first('linkedin') }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-12">
                                    <label><i class="fa fa-youtube-square" aria-hidden="true"></i> Youtube</label>
                                    <input type="text" name="socials[youtube]" class="form-control" value="{{ isset($socials['youtube']) ? $socials['youtube']: '' }}">
                                    @if ($errors->has('youtube'))
                                        <span class="help-block">{{ $errors->first('youtube') }}</span>
                                    @endif
                                </div>
                            </div>


                            <h2>Statistics</h2>

                            <div class="form-group">
                                <div class="col-md-12">
                                    <label><i class="fa fa-bar-chart" aria-hidden="true"></i> Cases </label>
                                    <input type="text" name="stats[cases]" class="form-control" value="{{ isset($stats['cases']) ? $stats['cases']: '' }}">
                                    @if ($errors->has('cases'))
                                        <span class="help-block">{{ $errors->first('cases') }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-12">
                                    <label><i class="fa fa-bar-chart" aria-hidden="true"></i> Legal Consultation </label>
                                    <input type="text" name="stats[legalcases]" class="form-control" value="{{ isset($stats['legalcases']) ? $stats['legalcases']: '' }}">
                                    @if ($errors->has('legalcases'))
                                        <span class="help-block">{{ $errors->first('legalcases') }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-12">
                                    <label><i class="fa fa-bar-chart" aria-hidden="true"></i> POA Verifications </label>
                                    <input type="text" name="stats[poaverifications]" class="form-control" value="{{ isset($stats['poaverifications']) ? $stats['poaverifications']: '' }}">
                                    @if ($errors->has('poaverifications'))
                                        <span class="help-block">{{ $errors->first('poaverifications') }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-12">
                                    <label><i class="fa fa-bar-chart" aria-hidden="true"></i> Contracts </label>
                                    <input type="text" name="stats[contracts]" class="form-control" value="{{ isset($stats['contracts']) ? $stats['contracts']: '' }}">
                                    @if ($errors->has('contracts'))
                                        <span class="help-block">{{ $errors->first('contracts') }}</span>
                                    @endif
                                </div>
                            </div>

                            <h2>Extra Data For Website</h2>

                            <div class="form-group">
                                <div class="col-md-12">
                                    <label><i class="fa fa-clock-o" aria-hidden="true"></i> Working Time </label>
                                    <input type="text" name="extras[workingtime]" class="form-control" value="{{ isset($extras['workingtime']) ? $extras['workingtime']: '' }}">
                                    @if ($errors->has('workingtime'))
                                        <span class="help-block">{{ $errors->first('workingtime') }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-12">
                                    <label><i class="fa fa-phone" aria-hidden="true"></i> Phone </label>
                                    <input type="text" name="extras[phone]" class="form-control" value="{{ isset($extras['phone']) ? $extras['phone']: '' }}">
                                    @if ($errors->has('phone'))
                                        <span class="help-block">{{ $errors->first('phone') }}</span>
                                    @endif
                                </div>
                            </div>


                            <!-- end of form "Add named button" -->
                            <div class="form-group">
                                <div class="col-md-12">
                                    <input type="submit" class="btn blue"
                                           value="@if(isset($webinfo)) Edit @else Add New Web Info @endif">
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
            <script src="{{ asset('public/assets/admin/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js') }}"></script>
            <script src="{{ asset('public/assets/admin/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js') }}"
                    type="text/javascript"></script>
            <script src="{{ asset('public/assets/admin/global/plugins/bootstrap-tagsinput/bootstrap-tagsinput.min.js') }}"
                    type="text/javascript"></script>
            <script src="{{ asset('public/assets/admin/global/plugins/ckeditor/ckeditor.js') }}"
                    type="text/javascript"></script>
@stop