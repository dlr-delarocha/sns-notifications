<?php

use Aws\Sns\Message;
use Aws\Sns\MessageValidator;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

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

//This is only an example.You are able to use other alternaives to retriver data from SNS.
Route::post('/sns-notifications', function (Request $request) {
    $message = json_decode($request->getContent(), true);
    $data = json_decode(data_get($message, 'MessageAttributes.Information.Value'), true);

    \Log::info($data);
    if ($data['status'] === 'updated') {
        \Log::info('Actualizando Nicho');
    } elseif ($message['status'] === 'deleted') {
        \Log::info('Borrando Nicho');
    }
});

