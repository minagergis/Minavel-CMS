@if(isset($slider) && count($slider) > 0)
<section id="slider">
    <div class="carousel fade-carousel slide" data-ride="carousel" data-interval="4000" id="bs-carousel">
        <!-- Overlay -->
        <div class="overlay"></div>

        <!-- Indicators -->
        <ol class="carousel-indicators">
            @foreach($slider as $key => $slide)
            <li data-target="#bs-carousel" data-slide-to="{{ $key }}" class="{{ $key == 0 ? 'active' : '' }}"></li>
            @endforeach
        </ol>

        <!-- Wrapper for slides -->
        <div class="carousel-inner">

            @foreach($slider as $key => $slide)
            <div class="item slides {{ $key == 0 ? 'active' : '' }}">
                @if($slide->post_have_thumbnail())
                <div class="slide-{{ $key +1 }}" style="background-image: url({{ asset('public/uploads/full/' . $slide->media->guid) }});">

                </div>
                @endif
                <div class="hero">
                    <hgroup>
                        <h1>{{ $slide->post_title }}</h1>
                        <br>
                        <h3>{{ $slide->post_excerpt }}</h3>
                    </hgroup>
                </div>
            </div>
            @endforeach


        </div>
    </div>
</section>
@endif
