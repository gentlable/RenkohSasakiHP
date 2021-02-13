<?php

use Illuminate\Support\Facades\Route;

// health check
Route::get('health_check', 'HealthCheckController@healthCheck')->name('health_check');
