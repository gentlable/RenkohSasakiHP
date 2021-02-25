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
                        <label class="col-sm-2 control-label">Web表示</span></label>
                        <div class="col-sm-9">
                            <select class="form-control" name="web_display">
                                @if($image->web_display === 2)
                                <option value="{{ $image->web_display }}" selected>変更前 : 可</option>
                                @else
                                <option value="{{ $image->web_display }}" selected>変更前 : 不可</option>
                                @endif
                                <option value='2'>可</option>
                                <option value='0'>不可</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">一覧表示</span></label>
                        <div class="col-sm-9">
                            <select class="form-control" name="list_display">
                                @if($image->list_display === 2)
                                <option value="{{ $image->list_display }}" selected>変更前 : 可</option>
                                @else
                                <option value="{{ $image->list_display }}" selected>変更前 : 不可</option>
                                @endif
                                <option value='2'>可</option>
                                <option value='0'>不可</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">ポジション</span></label>
                        <div class="col-sm-9">
                            <select class="form-control" name="position">
                                <option value="{{ $image->position }}">変更前 : {{$image->position}}</option>
                                <option value='1'>1</option>
                                <option value='2'>2</option>
                                <option value='3'>3</option>
                                <option value='4'>4</option>
                                <option value='5'>5</option>
                                <option value='6'>6</option>
                                <option value='7'>7</option>
                                <option value='8'>8</option>
                                <option value='9'>9</option>
                                <option value='10'>10</option>
                                <option value='11'>11</option>
                                <option value='12'>12</option>
                                <option value='13'>13</option>
                                <option value='14'>14</option>
                                <option value='15'>15</option>
                                <option value='16'>16</option>
                                <option value='17'>17</option>
                                <option value='18'>18</option>
                                <option value='19'>19</option>
                                <option value='20'>20</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">画像</span></label>
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
