@extends('layouts.app')
@section('title', 'RenkohSasaki')
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


<!-- メール送信用モーダルの設定 -->
<div class="modal fade" id="Modal" tabindex="-1" role="dialog" aria-labelledby="Modal" aria-hidden="true">
  <!--以下modal-dialogのCSSの部分で modal-lgやmodal-smを追加するとモーダルのサイズを変更することができる-->
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="Modal">Contact</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="閉じる">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
          <form action="{{ route('contact') }}"class="form-horizontal"  method="POST">
          @csrf
          <div class="form-row">
            @if ($errors->any())
            <div class="alert alert-danger">
              <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
              </ul>
            </div>
            @endif
          </div>
              <div class="form-group">
                  <label class="col-sm-3 control-label">Name</label>
                  <div class="col-sm-12">
                  <input type="text" class="form-control require" name="name">
                  </div>
              </div>

              <div class="form-group">
                  <label class="col-sm-3 control-label">Company</label>
                  <div class="col-sm-12">
                  <input type="text" class="form-control require" name="company">
                  </div>
              </div>

              <div class="form-group">
                  <label class="col-sm-3 control-label">E-mail</label>
                  <div class="col-sm-12">
                  <input type="text" class="form-control require" name="mail">
                  </div>
              </div>

              <div class="form-group">
                  <label class="col-sm-3 control-label">Tell</label>
                  <div class="col-sm-12">
                  <input type="text" class="form-control require" name="tell">
                  </div>
              </div>

            <div class="form-group">
                  <label class="col-sm-3 control-label">Body</label>
                  <div class="col-sm-12">
                    <textarea rows="6" name="body" class="form-control require"></textarea>
                  </div>  
            </div>
          </div>
          
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <input type="submit" class="btn btn-primary" value="Confirm">
          </div>
          
        </form>
    </div>
  </div>
</div>

<style>
.section {
  max-height: 100vh;
  height: 100vh;
  display: flex;
  align-items: center;
  justify-content: center;
}
.carousel {
    margin: auto;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-direction: column;
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
    width: 15px;
}
</style>

@endsection
