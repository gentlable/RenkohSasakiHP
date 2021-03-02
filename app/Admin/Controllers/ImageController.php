<?php

namespace App\Admin\Controllers;

use App\Models\Image;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Grid;
use Illuminate\Http\Request;

// 写真編集画面
class ImageController extends AdminController
{
    protected $title = 'Image';

    // 新規画像登録画面へ
    public function register()
    {
        return view('admin.image.register');
    }

    // 新規画像登録
    public function doRegister(Request $request)
    {
        // ファイルが空の時
        if ($request->file('image') === null) {
            $validator_arr['file_exist'] = null;
        // ファイルが選択されているとき
        } else {
            // バリデータ配列に値をセット
            $validator_arr['file_exist'] = 'exist';
            $file_name = $request->file('image')->getClientOriginalName();
            $validator_arr['file_name'] = $file_name;
            $pathinfo = pathinfo($file_name);
            $validator_arr['extension'] = $pathinfo['extension'];
        }

        // バリデーション
        $validator = Image::validator($validator_arr);
        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        }
        // ファイルを保存
        $request->file('image')->storeAs('images', $file_name);

        // 保存したファイルをpublicへ移動
        \File::move(storage_path("app/images/$file_name"), public_path("/images/$file_name"));
        $image = new Image;
        $id = $image->registerImageData($file_name, $request->except(['image']));

        return redirect()->route('detail', ['id' => $id]);
    }

    // 詳細ボタン押下
    public function detail(Request $request)
    {
        $image = Image::find($request->id);
        $file_name = $image->file_name;
        $image_path = "/images/$file_name";

        return view('admin.image.detail', [
            'image' => $image,
            'image_path' => $image_path,
        ]);
    }

    // 編集ボタン押下
    public function redact(Request $request)
    {
        $image = Image::find($request->id);
        $file_name = $image->file_name;
        $image_path = "/images/$file_name";

        return view('admin.image.redact', [
            'image' => $image,
            'image_path' => $image_path,
        ]);
    }

    // 編集確定
    public function doRedact(Request $request)
    {
        $image = Image::find($request->id);

        $image->redactImageData($request->all());

        return redirect()->route('list');
    }

    // 削除ボタン押下
    public function doDelete(Request $request)
    {
        $image = Image::find($request->id);
        $file_path = "/images/$image->file_name";
        $image->deleteImageDataFromServer($file_path);
        $image->deleteImageDataFromDB();

       return redirect()->route('list');
    }

    // Image画面作ってる
    protected function grid()
    {
        $grid = new Grid(new Image());

        $route = route('register');
        $grid->tools(function ($tools) use ($route) {
            $tools->prepend("<a href='{$route}' class='btn btn-sm btn-success'>新規画像登録</a>");
        });

        $grid->filter(function ($filter) {
            $array = [];
            for($i = 1; $i <= config('const.position'); $i++) {
                $array[] = $i; 
            }
            $filter->disableIdFilter();
            $filter->like('file_name', 'ファイル名');
            $filter->like('position', 'ポジション')
            ->select($array);
            $filter->like('list_display', '表示可否')
            ->select([
                '2' => '可',
                '0' => '不可',
            ]);
        });
        
        $grid->column('id', 'ID')->sortable();
        $grid->column('file_name', 'ファイル名')->sortable();
        $grid->column('position', 'ポジション')->sortable();
        $grid->column('list_display', '表示可否')
            ->display(function ($list_display) {
                if ($list_display === 0) {
                    $list_display = '不可';
                } elseif ($list_display === 2) {
                    $list_display = '可';
                }
                return $list_display;
            })->sortable();
        $grid->disableActions();
        $grid->disableCreateButton();
        $grid->expandFilter();


        $grid->column('詳細')->display(function () {
            return '<a class="btn btn-primary"
            href="' . route('detail', ['id' => $this->id]) . '">詳細</a>';
        });

        $grid->column('編集')->display(function () {
            return '<a class="btn btn-success"
            href="' . route('redact', ['id' => $this->id]) . '">編集</a>';
        });

        $grid->column('削除')->display(function () {
            return '<a class="btn btn-warning"
            href="' . route('doDelete', ['id' => $this->id]) . '">削除</a>';
        });

        return $grid;
    }
}
