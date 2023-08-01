<?php



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

Route::group(['middleware' => ['web','throttle:60,1','auth']], function () {

    Route::apiResources([
        'header'=>'Api\HeaderController',
        'about'=>'Api\aboutController',
        'footer'=>'Api\FooterController',
        'magazine'=>'Api\MagazineController',
        'magazineUpdate'=>'Api\MagazineUpdateController',
        'content'=>'Api\ContentController',
        'list'=>'Api\ListController',
    ]);
    Route::get('contentSearch/{data}','Api\ContentController@contentSearch');
    Route::get('magazineSearch/{data}','Api\MagazineController@magazineSearch');
});

Route::apiResources([
    'headerU'=>'Api\HeaderUController',
    'aboutU'=>'Api\aboutUController',
    'footerA'=>'Api\FooterAController',
    'magazin'=>'Api\MagazinController',
    'cont' => 'Api\ContController',

]);
Route::get('dashboardSearch/{data}','Api\MagazinController@dashboardSearch');
Route::get('magazineDetailSearch/{data}','Api\MagazinController@magazineDetailSearch');
Route::get('contentDetailSearch/{data}','Api\ContController@contentDetailSearch');
