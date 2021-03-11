@extends('admin::index', ['header' => '', '_user_' => ''])

@section('content')
<div class='title container-fluid'>
    <h3 style="margin-bottom: 20px">詳細ページ</h3>
    <div class='content'>
        <div class="box" style=max-width:1300px;>
            <div class="box-body">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h2 class="panel-title">ファイル 詳細</h2>
                    </div>
                    <div class="panel-body padding-y-0">
                        <label class="col-sm-3 control-label">ファイル名</span></label>
                        {{ $image->file_name }}
                        <hr>
                        <label class="col-sm-3 control-label">ポジション</span></label>
                        {{ $image->position }}
                        <hr>
                        <label class="col-sm-3 control-label">表示可否</span></label>
                        @if($image->display === 1)
                        可
                        @else
                        不可
                        @endif
                        <hr>
                        <label class="col-sm-3 control-label" >内容</span></label>
                        @if($image->file_type === '1')
                        <img src="{{ asset($image_path) }}" style="width:300px">
                        @elseif($image->file_type === '2')
                        <video src="{{ asset($image_path) }}" style="width:300px" controls></video>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <a class="btn btn-default" href="/admin/images">一覧画面へ戻る</a>
    </div>
</div>
@endsection
