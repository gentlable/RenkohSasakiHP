@extends('admin::index', ['header' => '', '_user_' => ''])

@section('content')
<div class='title container-fluid'>
    <h3>新規ファイル登録</h3>
    <div class="content">
        <form method="POST" class="form-horizontal" name="form" action="{{ route('doRegister') }}" enctype="multipart/form-data">
            @csrf
            <div class="box">
                <div class="box-body">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h2 class="panel-title">新規ファイル情報入力</h2>
                        </div>
                        <div class="form-group" style="margin-top:20px">
                            <label class="col-sm-2 control-label">表示可否</label>
                            <div class="col-sm-5">
                                <select class="form-control" name="display">
                                    <option value='1'>可</option>
                                    <option value='0'>不可</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">ポジション</label>
                            <div class="col-sm-5">
                                <select class="form-control" name="position">
                                    @for ($i = 1; $i <= config('const.position'); $i++)
                                    <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                            </div>
                        </div>
                        <div class="form-group" style="margin-top:20px">
                            <label class="col-sm-2 control-label">ファイル選択</label>
                            <div  class="col-sm-5">
                                <input type="file" class="custom-file-input" name="image">
                            </div>
                        </div>
                        @if($errors->has('file_exist'))
                        <div class="form-group">
                            <label class="col-sm-2 control-label"></label>
                        </div>
                        <div class="col-sm-5">
                            <label class="control-label" style="color:red;" for="inputError">ファイルを選択してください。</label><br>
                        </div>
                        @elseif($errors->has('extension'))
                        <div class="form-group">
                            <label class="col-sm-2 control-label"></label>
                        </div>
                        <div class="col-sm-5">
                            <label class="control-label" style="color:red;" for="inputError">jpg, mp4またはwebmファイルを選択してください。</label><br>
                        </div>
                        @elseif($errors->has('file_name'))
                        <div class="form-group">
                            <label class="col-sm-2 control-label"></label>
                        </div>
                        <div class="col-sm-9">
                            <label class="control-label" style="color:red;" for="inputError">このファイル名はすでに使用されています。ファイル名を変えてください。</label><br>
                        </div>
                        @elseif($errors->has('diff'))
                        <div class="form-group">
                            <label class="col-sm-2 control-label"></label>
                        </div>
                        <div class="col-sm-9">
                            <label class="control-label" style="color:red;" for="inputError">同じポジションに異なる種類のファイルがあります。ポジションを変えてください。</label><br>
                        </div>
                        @elseif($errors->has('duplicate'))
                        <div class="form-group">
                            <label class="col-sm-2 control-label"></label>
                        </div>
                        <div class="col-sm-9">
                            <label class="control-label" style="color:red;" for="inputError">同じポジションに既にファイルがあります。ポジションを変えてください。</label><br>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            <div>
                <a class="btn btn-default" href="/admin/images">一覧画面へ戻る</a>
                <a class="btn btn-primary" href="javascript:form.submit()" style="margin-left: 20px">Submit</a>
            </div>
        </form>
    </div>
</div>
@endsection