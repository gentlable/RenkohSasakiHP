@extends('test.test_app')
@section('title', 'TestPage')
@section('content')
<!-- メイン -->
<main>
    @foreach($modal_images as $i => $modal_image)
    <div class="section">
        <div id="carouselExampleFade_{{ $i }}" class="carousel slide carousel-fade" data-interval="false">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="{{ asset($modal_image[0]) }}">
                </div>
                @if (count($modal_images[$i]) > 2)
                @for($j = 1; $j <= count($modal_images[$i]) - 1; $j++)
                <div class="carousel-item">
                    <img src="{{ asset($modal_image[$j]) }}">
                </div>
                @endfor
                @endif
            </div>
            @if (count($modal_images[$i]) > 2)
            <a class="carousel-control-prev" href="#carouselExampleFade_{{ $i }}" role="button" data-slide="prev">
            </a>
            <a class="carousel-control-next" href="#carouselExampleFade_{{ $i }}" role="button" data-slide="next">
            </a>
            <ol class="carousel-indicators">
                <li data-target="#carouselExampleFade_{{ $i }}" data-slide-to="0" class="active"></li>
                @for ($j = 1; $j <= count($modal_images[$i]) - 1; $j++)
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
    max-width: 100%;
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
