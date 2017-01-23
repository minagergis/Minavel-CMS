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
                            <span class="caption-subject bold uppercase">@if(isset($user)) Edit {{$user->username}} @else Add New User @endif</span>
                        </div> 
                    </div>
                    <!-- BEGIN PAGE BASE CONTENT -->

                    <form  class="form-horizontal" method="post" enctype="multipart/form-data" action="@if(isset($user)){{ route('admin.users.edit.post', $user->id) }} @else {{ route('admin.users.add.post') }} @endif">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
               
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group {{ $errors->has('username') ? ' has-error' : '' }}">
                                    <div class="col-md-3">
                                        Username
                                    </div>
                                    <div class="col-md-9">
                                        <input type="text" name="username" class="form-control" maxlength="255" placeholder="Username (required)" required id="username" value="@if(isset($user)){{trim($user->username)}}@else{{old('username')}}@endif">
                                        @if ($errors->has('username'))
                                            <span class="help-block">{{ $errors->first('username') }}</span>
                                        @endif
                                    </div>
                                </div>
                                
                                <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                                    <div class="col-md-3">
                                        Email
                                    </div>
                                    <div class="col-md-9">
                                        <input type="email" name="email" class="form-control" maxlength="255" placeholder="Email (required)" required value="@if(isset($user)){{trim($user->email)}}@else{{old('email')}}@endif">
                                        @if ($errors->has('email'))
                                            <span class="help-block">{{ $errors->first('email') }}</span>
                                        @endif
                                    </div>
                                </div>
                                
                                <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                                    <div class="col-md-3">
                                        Name
                                    </div>
                                    <div class="col-md-9">
                                        <input type="text" name="name" class="form-control" maxlength="255" placeholder="Name" value="@if(isset($user)){{trim($user->name)}}@else{{old('name')}}@endif">
                                        @if ($errors->has('name'))
                                            <span class="help-block">{{ $errors->first('name') }}</span>
                                        @endif
                                    </div>
                                </div>

                                <?php if(isset($user))
                                    $pass_val = '';
                                else{ 
                                    if(old('password')!==null)
                                        $pass_val = '';
                                    else
                                        $pass_val = trim(bin2hex(openssl_random_pseudo_bytes(16)));
                                } ?>
                                <div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}">
                                    <div class="col-md-3">
                                        Password
                                    </div>
                                    <div class="col-md-3 show-pw-box">
                                       <a href="javascript:;" class="btn default btn-sm show-pw">Show password</a>
                                    </div>

                                    <div class="col-md-8 pw-input" style="display:none; padding: 0;">
                                        <div class="col-md-6">
                                            <input type="text" name="password" id="password" class="form-control" maxlength="255" placeholder="Password" value="{{$pass_val}}">
                                        </div>
                                        <div class="col-md-5">
                                            <a href="javascript:;" class="btn default btn-sm hide-pw">Hide</a>
                                            <a href="javascript:;" class="btn default btn-sm cancel-pw">Cancel</a>
                                        </div>
                                        @if ($errors->has('password'))
                                            <span class="help-block">{{ $errors->first('password') }}</span>
                                        @endif
                                    </div>
                                </div>
                                
                                <div class="form-group {{ $errors->has('notification') ? ' has-error' : '' }}">
                                    <div class="col-md-3">
                                        Send User Notification
                                    </div>
                                    <div class="col-md-9">
                                        <input type="checkbox" name="notification" id="notification" class="form-control">
                                        <label for="notification">Send the new user an email about their account.</label>
                                        @if ($errors->has('notification'))
                                            <span class="help-block">{{ $errors->first('notification') }}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group {{ $errors->has('role') ? ' has-error' : '' }}">
                                    <div class="col-md-3">
                                        Role
                                    </div>
                                    <div class="col-md-3">
                                        <?php $selected_role = isset($user) && count($user) > 0 ? (isset($select_role) ? $select_role->role_id : '') : old('role'); ?>
                                        <select name="role" id="role" class="form-control" required>
                                            <option value="" hidden>Select role...</option>
                                            @foreach($roles as $role)
                                                <option value="{{ $role->id }}" @if($selected_role == $role->id) selected @endif>{{ $role->display_name }}</option>
                                            @endforeach         
                                        </select>

                                        @if ($errors->has('role'))
                                            <span class="help-block">{{ $errors->first('role') }}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group {{ $errors->has('country') ? ' has-error' : '' }}">
                                    <div class="col-md-3">
                                        Country
                                    </div>
                                    <div class="col-md-3">
                                        <?php $selected_country = isset($user) && count($user) > 0 ? $user->country_id : old('country'); ?>
                                        <select class="form-control" name="country" onChange="getCities(this.value);">
                                            <option value="">Select country...</option>
                                            @foreach($countries as $country)
                                                <option value="{{ $country->id }}" @if($selected_country == $country->id) selected @endif>{{ $country->name }}</option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('country'))
                                            <span class="help-block">{{ $errors->first('country') }}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group {{ $errors->has('city') ? ' has-error' : '' }}">
                                    <div class="col-md-3">
                                        City
                                    </div>
                                    <div class="col-md-3">
                                        <?php $selected_city = isset($user) && count($user) > 0 ? $user->city_id : old('city'); ?>
                                        <select class="form-control" name='city' id='city'>
                                            <option value="" hidden>Select city....</option>
                                            @if($selected_country > 0)
                                                @foreach(Modules\Admin\Models\City::where('country_id', $selected_country)->get() as $city)
                                                    <option value="{{ $city->id }}" @if($selected_city == $city->id) selected @endif>{{ $city->name }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                        @if ($errors->has('city'))
                                            <span class="help-block">{{ $errors->first('city') }}</span>
                                        @endif

                                    </div>
                                </div>

                                <div class="form-group {{ $errors->has('url') ? ' has-error' : '' }}">
                                    <div class="col-md-3">
                                        Website
                                    </div>
                                    <div class="col-md-9">
                                        <input type="text" name="url" class="form-control" maxlength="255" placeholder="Website"  value="@if(isset($user)){{trim($user->url)}}@else{{old('url')}}@endif">
                                        @if ($errors->has('url'))
                                            <span class="help-block">{{ $errors->first('url') }}</span>
                                        @endif
                                    </div>
                                </div> 
  
                                <div class="form-group {{ $errors->has('job') ? ' has-error' : '' }}">
                                    <div class="col-md-3">
                                        Job
                                    </div>
                                    <div class="col-md-9">
                                        <input type="text" name="job" class="form-control" maxlength="255" placeholder="Job"  value="@if(isset($user)){{trim($user->job)}}@else{{old('job')}}@endif">
                                        @if ($errors->has('job'))
                                            <span class="help-block">{{ $errors->first('job') }}</span>
                                        @endif
                                    </div>
                                </div> 
 
                                <div class="form-group {{ $errors->has('mobile') ? ' has-error' : '' }}">
                                    <div class="col-md-3">
                                        Mobile
                                    </div>
                                    <div class="col-md-9">
                                        <input type="text" name="mobile" class="form-control" maxlength="255" placeholder="Mobile"  value="@if(isset($user)){{trim($user->mobile)}}@else{{old('mobile')}}@endif">
                                        @if ($errors->has('mobile'))
                                            <span class="help-block">{{ $errors->first('mobile') }}</span>
                                        @endif
                                    </div>
                                </div> 

                                <div class="form-group {{ $errors->has('age') ? ' has-error' : '' }}">
                                    <div class="col-md-3">
                                        Age
                                    </div>
                                    <div class="col-md-9">
                                        <input type="text" name="age" class="form-control" maxlength="255" placeholder="Age"  value="@if(isset($user)){{trim($user->age)}}@else{{old('age')}}@endif">
                                        @if ($errors->has('age'))
                                            <span class="help-block">{{ $errors->first('age') }}</span>
                                        @endif
                                    </div>
                                </div> 

                                <div class="form-group {{ $errors->has('address') ? ' has-error' : '' }}">
                                    <div class="col-md-3">
                                        Address
                                    </div>
                                    <div class="col-md-9">
                                        <input type="text" name="address" class="form-control" maxlength="255" placeholder="Address"  value="@if(isset($user)){{trim($user->address)}}@else{{old('address')}}@endif">
                                        @if ($errors->has('address'))
                                            <span class="help-block">{{ $errors->first('address') }}</span>
                                        @endif
                                    </div>
                                </div> 





                                <div class="form-group {{ $errors->has('about') ? ' has-error' : '' }}">
                                    <div class="col-md-3">
                                        About
                                    </div>
                                    <div class="col-md-9">
                                        <textarea class="form-control" rows="3" placeholder="" name="about">@if(isset($user)){{ $user->about }}@endif</textarea>

                                        @if ($errors->has('about'))
                                            <span class="help-block">{{ $errors->first('about') }}</span>
                                        @endif
                                    </div>
                                </div> 



                                <div class="form-group">
                                    <div class="col-md-3"></div>
                                    <div class="col-md-9">
                                        <input type="submit" class="btn blue" value="@if(isset($user)) Edit @else Add New User @endif">
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
    <script>
        function getCities(val) {
            jQuery.ajax({
                headers: {
                    'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                },
                type: "POST",
                url: "{{ route('admin.city.ajax.get') }}",
                data:'country_id='+val,
                success: function(data){
                    if(data != '') {
                        jQuery("#city").html(data);
                    } else {
                        jQuery("#city").html('<option value="">Select city...</option>');
                    }

                }
            });
        }
    </script>
@stop