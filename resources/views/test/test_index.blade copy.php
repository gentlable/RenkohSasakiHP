@extends('test.test_app')
@section('title', 'TestPage')
@section('content')
<main>
    <div class="container text-center">
        <div class="d-block d-md-none">
            <div style="margin-top:100px; margin-bottom:250px">
                <a data-toggle="modal" data-target="#FirstImage"><img src="{{ asset($first_web_image) }}" class="img-responsive" style="width:100%;"></a>
            </div>
        </div>
        <div class="d-none d-md-block">
            <div style="margin-top:50px; margin-bottom:30px;">
                <a data-toggle="modal" data-target="#FirstImage"><img src="{{ asset($first_web_image) }}" class="img-responsive" style="max-height:700px;"></a>
            </div>
        </div>
        @foreach ($web_images as $i => $web_image)
        <div class="d-block d-md-none">
            <div style="margin-top:30px; margin-bottom:250px;">
                <a data-toggle="modal" data-target="#modal_{{ $i }}"><img src="{{ asset($web_image) }}" class="img-responsive" style="width:100%;"></a>
            </div>
        </div>
        <div class="d-none d-md-block">
            <div style="margin-top:500px; margin-bottom:200px">
                <a data-toggle="modal" data-target="#modal_{{ $i }}"><img src="{{ asset($web_image) }}" class="img-responsive" style="max-height:700px;"></a>
            </div>
        </div>
        @endforeach
    </div>
</main>

<!-- モーダル 最初の写真 -->
<div class="modal fade" id="FirstImage" tabindex="-1" role="dialog" aria-labelledby="Modal" aria-hidden="true" style="margin-top:60px;">
    <div class="modal-dialog modal-lg" role="document" style="max-width:550px;">
        <div class="modal-content">
            <button type="button" class="close" data-dismiss="modal" aria-label="閉じる"></button>
            <div id="carouselExampleFade" class="carousel slide carousel-fade" data-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img class="d-block w-100" src="{{ asset($top_first_modal_image) }}">
                    </div>
                    @foreach($first_modal_images as $first_modal_image)
                    <div class="carousel-item">
                        <img class="d-block w-100" src="{{ asset($first_modal_image) }}">
                    </div>
                    @endforeach
                </div>
                <a class="carousel-control-prev" href="#carouselExampleFade" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleFade" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                </a>
            </div>
        </div>
    </div>
</div>

<!-- モーダル ２番目以降の写真 -->
@foreach($top_modal_images as $i => $top_modal_image)
<div class="modal fade" id="modal_{{ $i }}"  tabindex="-1" role="dialog" aria-labelledby="Modal" aria-hidden="true" style="margin-top:60px;">
    <div class="modal-dialog modal-lg" role="document" style="max-width:550px;">
        <div class="modal-content">
            <button type="button" class="close" data-dismiss="modal" aria-label="閉じる"></button>
            <div id="carouselExampleFade_{{ $i }}" class="carousel slide carousel-fade" data-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img class="d-block w-100" src="{{ asset($top_modal_image) }}">
                    </div>
                    @foreach($modal_images[$i] as $modal_image)
                    <div class="carousel-item">
                        <img class="d-block w-100" src="{{ asset($modal_image) }}">
                    </div>
                    @endforeach
                </div>
                <a class="carousel-control-prev" href="#carouselExampleFade_{{ $i }}" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleFade_{{ $i }}" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                </a>
            </div>
        </div>
    </div>
</div>
@endforeach

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
@endsection
