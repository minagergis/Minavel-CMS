<div class="portlet box green-meadow languages">
    <div class="portlet-title">
        <div class="caption">
            <i class="fa fa-globe"></i>Languages
        </div>
        <div class="tools">
            <a href="javascript:;" class="collapse" data-original-title="" title=""> </a>
            <a href="javascript:;" class="reload" data-original-title="" title=""> </a>
        </div>
    </div>
    <div class="portlet-body lang {{ $errors->has('locale') ? 'has-error' : '' }}">
        <div class="row">
            <div class="col-md-2">
                @if(isset($language))
                    @foreach($language as $lang)
                        @if($current_lang == $lang->locale)  <i class="glyphicon bfh-flag-{{$lang->icon}}"></i> @endif
                    @endforeach
                @endif
            </div>
            <div class="col-md-10">
                <select name="locale" id="language" class="form-control">
                    <option value="" hidden>Select language...</option>
                    @if(isset($language))
                        @foreach($language as $lang)
                            <option value="{{ $lang->locale }}" data-flag="{{ $lang->icon }}"
                                    @if($current_lang == $lang->locale) selected @endif>{{ $lang->name }}</option>
                        @endforeach
                    @endif
                </select>
                @if ($errors->has('locale'))
                    <span class="help-block">{{ $errors->first('locale') }}</span>
                @endif
            </div>
        </div>
    </div>
</div>


<div class="portlet box green-meadow">
    <div class="portlet-title">
        <div class="caption">
            <i class="fa fa-paper-plane-o"></i>Publish
        </div>
        <div class="tools">
            <a href="javascript:;" class="collapse" data-original-title="" title=""> </a>
            <a href="javascript:;" class="reload" data-original-title="" title=""> </a>
        </div>
    </div>
    <div class="portlet-body pub">
        <div class="row">
            <div class="col-md-6">
                <button type="submit" name="draft" class="btn default btn-sm">Save draft</button>
            </div>
            <div class="col-md-6 right"><a href="javascript:;" class="btn default btn-sm"> Preview </a></div>


        </div>
        <div class="row">
            <div class="col-md-12">
                <i class="fa fa-key"></i> Status: <b>{{ isset($post) ? ucfirst($post->post_status) : 'Publish' }}</b>
                <a>Edit</a>
            </div>
            <div class="col-md-12">
                <i class="fa fa-eye"></i> Visibility: <b>Public</b> <a>Edit</a>
            </div>
            <div class="col-md-12">
                <i class="fa fa-calendar"></i> Publish <b>immediately</b> <a>Edit</a>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <button type="submit" name="trash" class="trash">Move to trash</button>
            </div>
            <div class="col-md-6 right">
                <button type="submit" name="publish"
                        class="btn blue btn-sm">{{ isset($action) && $action == 'edit' ?  'Update' : 'Publish' }}</button>
                <br>
            </div>
        </div>
    </div>
</div>

@if(\Request::get('post_type') == 'page_test')
    <div class="portlet box green-meadow attributes">
        <div class="portlet-title">
            <div class="caption">
                <i class="fa fa-cogs"></i>Page Attributes
            </div>
            <div class="tools">
                <a href="javascript:;" class="collapse" data-original-title="" title=""> </a>
                <a href="javascript:;" class="reload" data-original-title="" title=""> </a>
            </div>
        </div>
        <div class="portlet-body lang">
            <div class="row">
                <div class="col-md-12">Parent</div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <select name="" id="" class="form-control">
                        <option value selected="selected">(no parent)</option>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">Template</div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <select name="" id="" class="form-control">
                        <option value selected="selected">Page Template</option>
                    </select>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">Order</div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <input type="text" class="form-control" id="" value="0" autocomplete="off">
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    Need help? Use the Help tab in the upper right of your screen.
                </div>
            </div>
        </div>
    </div>
@endif

<div class="portlet box green-meadow categories">
    <div class="portlet-title">
        <div class="caption">
            <i class="fa fa-list"></i>Categories
        </div>
        <div class="tools">
            <a href="javascript:;" class="collapse" data-original-title="" title=""> </a>
            <a href="javascript:;" class="reload" data-original-title="" title=""> </a>
        </div>

    </div>
    <div class="portlet-body">
        <div class="tab-content">
            <ul class="nav nav-tabs">
                <li class="active">
                    <a href="#portlet_tab1" data-toggle="tab" aria-expanded="false">All</a>
                </li>
                {{--<li class="">--}}
                {{--<a href="#portlet_tab2" data-toggle="tab" aria-expanded="true">Most Used</a>--}}
                {{--</li>--}}
            </ul>
            <div class="tab-pane active" id="portlet_tab1">
                <div class="md-checkbox-list">

                    @foreach($categories as $category)
                        <div class="md-checkbox">
                            <input type="checkbox" id="checkbox{{ $category->id }}" class="md-check" name="category[]"
                                   value="{{ $category->id }}" {{ isset($categories_ids) && in_array($category->id, $categories_ids) ? 'checked' : '' }}>
                            <label for="checkbox{{ $category->id }}">
                                <span></span>
                                <span class="check"></span>
                                <span class="box"></span>{{ $category->name }}</label>
                        </div>
                    @endforeach
                </div>
            </div>
            {{--<div class="tab-pane" id="portlet_tab2">--}}
            {{--<div class="md-checkbox-list">--}}
            {{--<div class="md-checkbox">--}}
            {{--<input type="checkbox" id="checkbox4" class="md-check">--}}
            {{--<label for="checkbox4">--}}
            {{--<span></span>--}}
            {{--<span class="check"></span>--}}
            {{--<span class="box"></span> Option 1 </label>--}}
            {{--</div>--}}
            {{--<div class="md-checkbox">--}}
            {{--<input type="checkbox" id="checkbox5" class="md-check" checked>--}}
            {{--<label for="checkbox5">--}}
            {{--<span></span>--}}
            {{--<span class="check"></span>--}}
            {{--<span class="box"></span> Option 2 </label>--}}
            {{--</div>--}}
            {{--</div>--}}
            {{--</div>--}}
        </div>
        <a href="{{ route('admin.category.add.get') }}">+ Add New Category</a>
    </div>
</div>

<div class="portlet box green-meadow tags">
    <div class="portlet-title">
        <div class="caption">
            <i class="fa fa-tags"></i>Tags
        </div>
        <div class="tools">
            <a href="javascript:;" class="collapse" data-original-title="" title=""> </a>
            <a href="javascript:;" class="reload" data-original-title="" title=""> </a>
        </div>
    </div>
    <div class="portlet-body feat">
        <div class="row">
            <div class="col-md-12">
                <input type="text" name="tags"
                       value="{{ isset($post) ? implode(',', $post->tagNames()) : old('tags') }}" data-role="tagsinput">
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                Separate tags with commas
            </div>
            <div class="col-md-12">
                <a>Choose from the most used tags </a>
            </div>
        </div>
    </div>
</div>


{{--<div class="portlet box green-meadow featured_image">--}}
{{--<div class="portlet-title">--}}
{{--<div class="caption">--}}
{{--<i class="fa fa-picture-o"></i>Featured Image--}}
{{--</div>--}}
{{--<div class="tools">--}}
{{--<a href="javascript:;" class="collapse" data-original-title="" title=""> </a>--}}
{{--<a href="javascript:;" class="reload" data-original-title="" title=""> </a>--}}
{{--</div>--}}
{{--</div>--}}
{{--<div class="portlet-body feat">--}}
{{--<div class="row">--}}
{{--<div class="col-md-12">--}}
{{--<div class="fileinput fileinput-new" data-provides="fileinput">--}}
{{--<div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 100%; height: 150px;">--}}

{{--</div>--}}
{{--<div>--}}
{{--<span class="btn default btn-file">--}}
{{--<span class="fileinput-new">Select image </span>--}}
{{--<span class="fileinput-exists">Change </span>--}}
{{--<input type="file" name="file"></span>--}}
{{--<a href="javascript:;" class="btn red fileinput-exists" data-dismiss="fileinput">Remove </a>--}}
{{--</div>--}}
{{--</div>--}}
{{--</div>--}}
{{--</div>--}}
{{--</div>--}}
{{--</div>--}}



@include('admin::partials.featured_images')
