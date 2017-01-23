<h2>Search Engine Optimization</h2>
<div class="form-group">
    <div class="col-md-12">
        <label>SEO Meta Keys</label>
        <input type="text" name="MetaTags"
               value="{{ isset($post) ? $post->MetaTags : old('MetaTags') }}" data-role="tagsinput">
        <div class="col-md-12">
            Separate tags with commas
        </div>

    </div>
</div>

<div class="form-group">
    <div class="col-md-12">
        <label>SEO Meta Title</label>
        <input type="text" name="MetaTitle"
               value="{{ isset($post) ? $post->MetaTitle : old('MetaTitle') }}" class="form-control">
    </div>
</div>

<div class="form-group">
    <div class="col-md-12">
        <label>SEO Meta Description</label>
        <textarea name="MetaDesc" class="form-control" rows="6"
                  placeholder="Enter Meta Description here">{{ isset($post) ? $post->MetaDesc : old('MetaDesc') }}</textarea>
    </div>
</div>
