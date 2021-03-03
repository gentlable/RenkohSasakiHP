<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Mail\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

// ページ表示用コントローラー
class RenkohSasakiController extends Controller
{
    // トップページ
    public function index()
    {
        $modal_images = [];
        for ($i = 1; $i <= config('const.position'); $i++) {

            // 各段の画像の配列（ストーリー）
            $file_paths_for_list = [];
            // 一覧表示可のものを格納
            if (Image::where('position', $i)->where('display', 1)->exists()) {
                $images = Image::where('position', $i)->where('display', 1)->orderBy('file_name', 'asc')->get();
                foreach ($images as $image) {
                    $file_name = $image['file_name'];
                    $file_path_for_list = "/images/$file_name";
                    $file_paths_for_list[] = $file_path_for_list;
                }
            } else {
                continue;
            }
            $modal_images[] = $file_paths_for_list;
        }

        return view("renkohsasaki.index", [
            'modal_images' => $modal_images,
            ]);
    }

    // contact
    public function contact(Request $request)
    {
        $params = [];
        $params['name'] = $request->input('name');
        $params['company'] = $request->input('company');
        $params['mail'] = $request->input('mail');
        $params['tell'] = $request->input('tell');
        $params['body'] = $request->input('body');

        // $inquiry_log = new InquiryLog;
        // $inquiry_log = $inquiry_log->validateAndSave($request);
        // if ($inquiry_log->fails()) {
        //     return redirect()
        //         ->route(\App::getLocale() . '.contact_us', ['#contact'])
        //         ->withErrors($inquiry_log)
        //         ->withInput();
        // }

        Mail::to('renkohsasaki@gmail.com')->send(new Contact($params));

        return redirect()->route('index');
    }

    // テストページ
    public function test()
    {
        for ($i = 1; $i <= config('const.position'); $i++) {

            $modal_images = [];
            // 各段の画像の配列（ストーリー）
            $file_paths_for_list = [];
            // 一覧表示可のものを格納
            if (Image::where('position', $i)->where('display', 1)->exists()) {
                $images = Image::where('position', $i)->where('display', 1)->orderBy('file_name', 'asc')->get();
                foreach ($images as $image) {
                    $file_name = $image['file_name'];
                    $file_path_for_list = "/images/$file_name";
                    $file_paths_for_list[] = $file_path_for_list;
                }
            } else {
                continue;
            }
            $modal_images[] = $file_paths_for_list;
        }

        $modal_images = array_values($modal_images);

        return view("test.test_index", [
            'modal_images' => $modal_images,
            ]);
    }
}
