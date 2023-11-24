<?php

use App\Http\Controllers\Api\Inspectors\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Inspectors\InspectorController;
use App\Http\Controllers\Api\Inspectors\ReportController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group([

    'middleware' => 'api',
    'namespace' => 'Inspectors',
    'prefix' => 'auth/inspectors'

], function () {
    Route::post('login', 'AuthController@login');
    Route::post('reset', 'ForgotPasswordController@forgot');
});

Route::group([
    'middleware' => 'auth:inspector',
    'namespace' => 'Inspectors',
    'prefix' => 'inspector'

], function ($router) {
    Route::get('get-profile', [InspectorController::class,'getProfile'])->middleware('blocked');
    Route::post('edit-profile', 'InspectorController@editProfile')->middleware('blocked');
    Route::post('logout', 'AuthController@logout');

    Route::post('clientDetails', 'ClientDataController@formData');
    Route::get('dataList', 'ClientDataController@dataList');
    Route::delete('deleteClientData', 'ClientDataController@deleteClientData');

    Route::post('catData', 'FormDataController@catData');
    Route::post('catAllData', 'FormDataController@catAllData');
    Route::get('getAllFormData', 'FormDataController@getAllFormData');

    Route::post('saveNarratives', 'NarrativeController@saveNarratives');
    Route::delete('deleteNarratives', 'NarrativeController@deleteNarratives');
    Route::get('getNarratives', 'NarrativeController@getNarratives');

    Route::post('comments', 'CommentController@comments');
    Route::post('editComment', 'CommentController@editComment');
    Route::delete('commentDelete', 'CommentController@commentDelete');
    Route::get('getComment', 'CommentController@getComment');
    Route::get('getPinnedComment', 'CommentController@getPinnedComment');
    Route::post('syncImage', 'CommentController@syncImage');

    Route::post('spareImage', 'SpareImageController@spareImage');
    Route::delete('spareImgDelete', 'SpareImageController@spareImgDelete');
    Route::get('getspareImg', 'SpareImageController@getspareImg');
});

Route::group([
    'middleware' => 'auth:inspector',
    'prefix' => 'inspector'
], function (){
    Route::post('refresh-token', [AuthController::class, 'refresh']);
});

Route::group([
    'middleware' => 'auth:inspector',
    'prefix' => 'reports'
], function (){
    Route::post('save', [ReportController::class, 'save'])->middleware('blocked');
});
