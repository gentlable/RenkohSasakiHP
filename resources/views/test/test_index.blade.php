@extends('test.test_app')
@section('title', 'TestPage')
@section('content')
<!-- メイン -->
<main>
    <div class="section">
        <div id="carousel_1" class="carousel slide carousel-fade">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="{{ asset($top_first_modal_image) }}">
                </div>
                @foreach($first_modal_images as $first_modal_image)
                <div class="carousel-item">
                    <img src="{{ asset($first_modal_image) }}">
                </div>
                @endforeach
            </div>
            @if (count($first_modal_images) !== 0)
            <a class="carousel-control-prev" href="#carousel_1" role="button" data-slide="prev">
            </a>
            <a class="carousel-control-next" href="#carousel_1" role="button" data-slide="next">
            </a>
            <ol class="carousel-indicators">
                <li data-target="#carousel_1" data-slide-to="0" class="active"></li>
                <li data-target="#carousel_1" data-slide-to="1"></li>
                <li data-target="#carousel_1" data-slide-to="2"></li>
            </ol>
            @endif
        </div>
    </div>
    @foreach($web_images as $i => $web_image)
    <div class="section">
        <div id="carouselExampleFade_{{ $i }}" class="carousel slide carousel-fade" data-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="{{ asset($web_image) }}">
                </div>
                @foreach($modal_images[$i] as $modal_image)
                <div class="carousel-item">
                    <img src="{{ asset($modal_image) }}">
                </div>
                @endforeach
            </div>
            @if (count($modal_images[$i]) !== 0)
            <a class="carousel-control-prev" href="#carouselExampleFade_{{ $i }}" role="button" data-slide="prev">
            </a>
            <a class="carousel-control-next" href="#carouselExampleFade_{{ $i }}" role="button" data-slide="next">
            </a>
            <ol class="carousel-indicators">
                <li data-target="#carouselExampleFade_{{ $i }}" data-slide-to="0" class="active"></li>
                @for ($j = 1; $j <= count($modal_images[$i]); $j++)
                <li data-target="#carouselExampleFade_{{ $i }}" data-slide-to="{{ $j }}"></li>
                @endfor
            </ol>
            @endif
        </div>
    </div>
    @endforeach
</main>
<style>
.section {
    max-height: 100vh;
}
.carousel {
    margin: auto;
    margin-top: 10vh;
    margin-bottom: 15vh;
    /* 0.79 縦横の比率 */
    max-width: calc(80vh * 0.79);
}
.carousel a {
    width: 50%;
}
.carousel-item {
    text-align: center;
}
.carousel-item img {
    max-height: 80vh;
    max-width: 90vw;
    object-fit: cover;
}
.carousel-indicators {
    bottom: -45px;
}
.carousel-indicators li {
    background-color: #000;
}
</style>
@endsection
