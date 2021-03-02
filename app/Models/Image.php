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
      'display',
    ];

    // 画像登録
    public function registerImageData($file_name, $param)
    {
        // ファイル名
        $this->file_name     = $file_name;
        // 一覧表示
        $this->display  = $param['display'];
        // ポジション
        $this->position      = $param['position'];
        $this->save();

        return $this->id;
    }

    public function redactImageData($param)
    {
        $this->display = $param['display'];
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
