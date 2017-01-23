<?php
    $post_type = \Request::get('post_type');
    $extra = isset($post) ? json_decode($post->extra, true) : [];
?>

@if( $post_type !== null)


    @if( $post_type === 'team')

        <div class="form-group">
            <div class="col-md-12">
                <label>Job</label>
                <input type="text" name="extra[job]" class="form-control" value="{{ isset($extra['job']) ? $extra['job']: '' }}">
                @if ($errors->has('job'))
                    <span class="help-block">{{ $errors->first('job') }}</span>
                @endif
            </div>
        </div>

    @endif

    @if( $post_type === 'Case')

        <div class="form-group">
            <div class="col-md-12">
                <label>Job</label>
                <input type="text" name="extra[job]" class="form-control" value="{{ isset($extra['job']) ? $extra['job']: '' }}">
                @if ($errors->has('job'))
                    <span class="help-block">{{ $errors->first('job') }}</span>
                @endif
            </div>
        </div>

        <div class="form-group {{ $errors->has('casesummary') ? ' has-error' : '' }}">
            <div class="col-md-12">
                <textarea name="post_content" class="ckeditor form-control"
                                              rows="6">{{ isset($post) && $post->translate($current_lang) !== null ? $post->translate($current_lang)->post_content : old('post_content') }}</textarea>
                @if ($errors->has('post_content'))
                    <span class="help-block">{{ $errors->first('post_content') }}</span>
                @endif
            </div>
        </div>

    @endif

    @if( $post_type === 'client')

        <div class="form-group">
            <div class="col-md-12">
                <label>URL</label>
                <input type="text" name="extra[url]" class="form-control" value="{{ isset($extra['url']) ? $extra['url']: '' }}">
                @if ($errors->has('url'))
                    <span class="help-block">{{ $errors->first('url') }}</span>
                @endif
            </div>
        </div>

    @endif

@endif