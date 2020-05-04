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
         'Message' => 'Primer publicación SNS',
         'TargetArn' => 'arn:aws:sns:us-west-2:242380520906:styde-topic-updates',
         'name' => 'updated',
         'MessageAttributes' => [
             'Information' => [
                 'DataType' => 'String',
                 'StringValue' => json_encode([
                     'nicho' => 'mexicans',
                     'id' => '123456',
                     'status' => 'updated'
                 ], true),
             ]
        ],
    ]);
});
