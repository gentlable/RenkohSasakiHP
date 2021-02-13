<?php

namespace App\Admin\Controllers;

use App\Models\Image;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Grid;
use Illuminate\Http\Request;

class ImageController extends AdminController
{
    protected $title = 'Image';

    public function register()
    {
        return view('admin.image.register');
    }

    public function doRegister(Request $request)
    {
        if ($request->file('image') === null) {
            $validator_arr['file_exit'] = null;
        } else {
            $validator_arr['file_exit'] = 'exit';
            $file_name = $request->file('image')->getClientOriginalName();
            $validator_arr['file_name'] = $file_name;
            $pathinfo = pathinfo($file_name);
            $validator_arr['extension'] = $pathinfo['extension'];
        }
        $validator = Image::validator($validator_arr);
        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        }
        $request->file('image')->storeAs('images', $file_name);
        \File::move(storage_path("app/images/$file_name"), public_path("/images/$file_name"));
        $image = new Image;
        $id = $image->registerImageData($file_name, $request->except(['image']));

        return redirect()->route('detail', ['id' => $id]);
    }

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

    public function doRedact(Request $request)
    {
        $image = Image::find($request->id);

        $image->redactImageData($request->all());

        return redirect()->route('list');
    }

    public function doDelete(Request $request)
    {
        $image = Image::find($request->id);
        $file_path = "/images/$image->file_name";
        $image->deleteImageDataFromServer($file_path);
        $image->deleteImageDataFromDB();


        return redirect()->route('list');
    }

    protected function grid()
    {
        $grid = new Grid(new Image());

        $route = route('register');
        $grid->tools(function ($tools) use ($route) {
            $tools->prepend("<a href='{$route}' class='btn btn-sm btn-success'>新規画像登録</a>");
        });

        $grid->filter(function ($filter) {
            $filter->disableIdFilter();
            $filter->like('file_name', 'ファイル名');
            $filter->like('position', 'ポジション')
            ->select([
                '1' => '1',
                '2' => '2',
                '3' => '3',
                '4' => '4',
                '5' => '5',
                '6' => '6',
                '7' => '7',
                '8' => '8',
                '9' => '9',
                '10' => '10',
                '11' => '11',
                '12' => '12',
                '13' => '13',
                '14' => '14',
                '15' => '15',
                '16' => '16',
                '17' => '17',
                '18' => '18',
                '19' => '19',
                '20' => '20',
            ]);
            $filter->like('web_display', 'Web表示')
            ->select([
                '1' => '優先',
                '2' => '可',
                '3' => '不可',
            ]);
            $filter->like('list_display', '一覧表示')
            ->select([
                '1' => '優先',
                '2' => '可',
                '3' => '不可',
            ]);
        });
        
        $grid->column('id', 'ID')->sortable();
        $grid->column('file_name', 'ファイル名')->sortable();
        $grid->column('position', 'ポジション')->sortable();
        $grid->column('web_display', 'Web表示')
            ->display(function ($web_display) {
                if ($web_display === 1) {
                    $web_display = '優先';
                } elseif ($web_display === 2) {
                    $web_display = '可';
                } else {
                    $web_display = '不可';
                }
                return $web_display;
            })->sortable();
        $grid->column('list_display', '一覧表示')
            ->display(function ($list_display) {
                if ($list_display === 1) {
                    $list_display = '優先';
                } elseif ($list_display === 2) {
                    $list_display = '可';
                } else {
                    $list_display = '不可';
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
