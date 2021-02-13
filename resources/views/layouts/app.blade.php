<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>@yield('title')</title>
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body class="bg-white">
    @include('shared.navbar')
    @yield('content')
  <script src="{{ asset('js/app.js') }}"></script>

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



<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

</body>

</html>