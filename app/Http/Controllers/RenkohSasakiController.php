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
        // \Log::info(Image::where('position', 1)->where('web_display', 1)->first());
        // 表示用画像配列作成 
        for ($i = 1; $i <= 20; $i++) {
            if (Image::where('position', $i)->where('web_display', 1)->exists()) {
                $image = Image::where('web_display', 1)->where('position', $i)->inRandomOrder()->first();
                $file_name = $image['file_name'];
                $web_images[] = "/images/$file_name";
            } elseif (Image::where('position', $i)->where('web_display', 2)->exists()) {
                $image = Image::where('web_display', 2)->where('position', $i)->inRandomOrder()->first();
                $file_name = $image['file_name'];
                $web_images[] = "/images/$file_name";
            } else {
                continue;
            }
        }
        \Log::info($web_images);
        // 一段目の画像をセット
        $first_web_image = $web_images[0];
        // 一段目の画像を配列から削除
        unset($web_images[0]);
        \Log::info($web_images);
        // 一段目の画像を配列から削除
        $web_images = array_values($web_images);

        // ポップアップ用画像配列作成
        for ($i = 1; $i <= 20; $i++) {
            // 一覧表示するものがなかければ、スキップ
            if (Image::where('position', $i)->where('list_display', 1)->exists() === false &&
                Image::where('position', $i)->where('list_display', 2)->exists() === false) {
                    continue;
            }

            // 一覧表示優先の物を追加
            $file_paths_for_list = [];
            if (Image::where('position', $i)->where('list_display', 1)->exists()) {
                $images = Image::where('position', $i)->where('list_display', 1)->inRandomOrder()->get();
                $file_paths_for_list = [];
                foreach ($images as $image) {
                    $file_name = $image['file_name'];
                    $file_path_for_list = "/images/$file_name";
                    $file_paths_for_list[] = $file_path_for_list;
                }
            }

            // 一覧表示可の物を追加
            if (Image::where('position', $i)->where('list_display', 2)->exists()) {
                $images = Image::where('position', $i)->where('list_display', 2)->inRandomOrder()->get();
                foreach ($images as $image) {
                    $file_name = $image['file_name'];
                    $file_path_for_list = "/images/$file_name";
                    $file_paths_for_list[] = $file_path_for_list;
                }
            }

            // モーダル表示用配列にセット
            $modal_images[] = $file_paths_for_list;
        }

        // 一段目のポップアップ画像をセット
        $first_modal_images = $modal_images[0];
        // 一段目のポップアップ画像を配列から削除
        unset($modal_images[0]);

        $top_first_modal_image= $first_modal_images[0];
        unset($first_modal_images[0]);

        
        foreach ($modal_images as $i => $modal_image) {
            $top_modal_images[] = $modal_image[0];
            unset($modal_images[$i][0]);
        }
        $modal_images = array_values($modal_images);

        return view("renkohsasaki.index", [
            'first_web_image' => $first_web_image,
            'web_images' => $web_images,

            'top_first_modal_image' => $top_first_modal_image,
            'first_modal_images' => $first_modal_images,

            'top_modal_images' => $top_modal_images,
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
        for ($i = 1; $i <= 20; $i++) {

            // 各段の画像の配列（ストーリー）
            $file_paths_for_list = [];
            // 一覧表示可のものを格納
            if (Image::where('position', $i)->where('list_display', 2)->exists()) {
                $images = Image::where('position', $i)->where('list_display', 2)->orderBy('file_name', 'asc')->get();
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
