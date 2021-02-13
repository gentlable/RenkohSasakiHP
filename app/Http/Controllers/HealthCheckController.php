<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

use App\Constants\SystemConstant;

class HealthCheckController extends Controller
{
    public function healthCheck()
    {
        // Log::info('HealthCheckController. '.env('APP_NAME').' '.env('APP_ENV'));
        // return "OK ".env('APP_NAME');
        return "OK";
    }
}
