@extends('admin::index', ['header' => '', '_user_' => ''])

@section('content')
<div class='title container-fluid'>
    <h3 style="margin-bottom: 20px">編集ページ</h3>
    <div class='content'>
        <form method="POST" class="form-horizontal" name="form" action="{{ route('doRedact') }}" enctype="multipart/form-data">
        @csrf
        <div class="box" style=max-width:1300px;>
            <div class="box-body">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h2 class="panel-title">{{ $image->file_name }}</h2>
                    </div>
                    <div class="panel-body padding-y-0">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">表示可否</span></label>
                        <div class="col-sm-9">
                            <select class="form-control" name="display">
                                @if($image->display === 1)
                                <option value="{{ $image->display }}" selected>変更前 : 可</option>
                                @else
                                <option value="{{ $image->display }}" selected>変更前 : 不可</option>
                                @endif
                                <option value='1'>可</option>
                                <option value='0'>不可</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">ポジション</span></label>
                        <div class="col-sm-9">
                            <select class="form-control" name="position">
                                <option value="{{ $image->position }}">変更前 : {{$image->position}}</option>
                                @for ($i = 1; $i <= config('const.position'); $i++)
                                <option value="{{ $i }}">{{ $i }}</option>
                                @endfor
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">内容</span></label>
                        <div class="col-sm-9">
                        <img src="{{ asset($image_path) }}" style="width:300px">
                        </div>
                    </div>
                    <input type="hidden" class="form-control" name="id" value="{{ $image->id }}">
                    </div>
                </div>
            </form>
            </div>
        </div>
        <a class="btn btn-default" href="/admin/images">一覧画面へ戻る</a>
        <a class="btn btn-primary" href="javascript:form.submit()" style="margin-left: 20px">Submit</a>
    </div>
</div>
@endsection
