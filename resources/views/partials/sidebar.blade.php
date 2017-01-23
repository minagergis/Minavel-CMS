<div class="widget">
    <form>
        <i class="fa fa-search"></i>
        <input type="text" name="search" class="" placeholder="TYPE KEYWORD HERE...">
    </form>
</div>

@if(isset($categories) && count($categories) > 0)
<div class="widget">
    <span>{{ trans('main.categories') }}</span>
    <div class="widget-body">
        <ul class="category-list">
            @foreach($categories as $category)
            <li><a href="#">{{ $category->name }}</a></li>
            @endforeach
        </ul>
    </div>
</div>
@endif


@if(isset($recent_posts) && count($recent_posts) > 0)
<div class="widget">
    <span>{{ trans('main.recent_posts') }}</span>
    <div class="widget-body">
        <ul class="category-list">
            @foreach($recent_posts as $recent_post)
            <li>
                <a class="items" href="{{ route('frontend.blog.single.get', $recent_post->id) }}">{{ str_limit($recent_post->post_excerpt, $limit = 80, $end = '...') }}</a>
                {{ Date::parse($post->created_at)->format('l - j F, Y') }}
            </li>
           @endforeach
        </ul>
    </div>
</div>
@endif

<div class="widget sidebar-tags">
    <span>{{ trans('main.tags') }}</span>
    <div class="widget-body">
        <a href="#">Advertisement</a>
        <a href="#">Fashion</a>
        <a href="#">Sea</a>
        <a href="#">Forest</a>
        <a href="#">Nature</a>
        <a href="#">Portrait</a>
        <a href="#">Wordpress</a>
        <a href="#">Photo</a>
        <a href="#">Sky</a>
    </div>
</div>
