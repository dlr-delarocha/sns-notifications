<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/send-notification', function () {
     $sms = \AWS::createClient('sns');
     $sms->publish([
         'Message' => json_encode(['nicho_id' => 7287878, 'status' => 'updated'], true),
         'TargetArn' => 'arn:aws:sns:us-west-2:66666666:styde-topic-updates',
    ]);
});
