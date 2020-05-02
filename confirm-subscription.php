<?php

use Illuminate\Support\Facades\Route;
use Aws\Sns\Message;
use Aws\Sns\MessageValidator;
use Aws\Sns\Exception\InvalidSnsMessageException

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

Route::get('/sns-notifications', function () {
    // Instantiate the Message and Validator
    $message = Message::fromRawPostData();
    $validator = new MessageValidator();

    // Validate the message and log errors if invalid.
    try {
        $validator->validate($message);
    } catch (InvalidSnsMessageException $e) {
        // Pretend we're not here if the message is invalid.
        throw $e;
    }

    // Check the type of the message and handle the subscription.
    if ($message['Type'] === 'SubscriptionConfirmation') {
        // Confirm the subscription by sending a GET request to the SubscribeURL
        $this->client->get($message['SubscribeURL']);
    }
});
