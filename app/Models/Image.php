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

    public function registerImageData($file_name, $param)
    {
        $this->file_name     = $file_name;
        $this->web_display   = $param['web_display'];
        $this->list_display  = $param['list_display'];
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
