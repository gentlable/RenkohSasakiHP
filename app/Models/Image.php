<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

class Image extends Model
{
    protected $table = "images";

    public $timestamps = false;

    protected $fillable = [
      'file_name',
      'position',
      'web_display',
      'list_display',
    ];

    // 画像登録
    public function registerImageData($file_name, $param)
    {
        // ファイル名
        $this->file_name     = $file_name;
        // web表示
        $this->web_display   = $param['web_display'];
        // 一覧表示
        $this->list_display  = $param['list_display'];
        // ポジション
        $this->position      = $param['position'];
        $this->save();

        return $this->id;
    }

    public function redactImageData($param)
    {
        $this->web_display  = $param['web_display'];
        $this->list_display = $param['list_display'];
        $this->position     = $param['position'];

        $this->save();
    }

    public function deleteImageDataFromServer($file_path)
    {
        unlink(public_path($file_path));
    }

    public function deleteImageDataFromDB()
    {
        $this->destroy($this->id);
    }

    // バリデーションを行う。
    // $validator_arrの各要素がfalseの時、各要素はエラーを返す。
    public static function validator(array $validator_arr)
    {
        $validator = Validator::make($validator_arr, [
          'file_name'  => 'unique:images,file_name',
          'file_exist'  => 'required',
          'extension'  => 'starts_with:jpg',
        ]);

        return $validator;
    }
}
