<?php

/*
|--------------------------------------------------------------------------
| Login Routes
|--------------------------------------------------------------------------
|
*/
Route::get('login', array('as'=>'login', 'uses' => function()
{
	return View::make('login');
}));

Route::get('password/reset/{token}',    'RemindersController@getReset');
Route::post('password/reset/{token}',   'RemindersController@postReset');
Route::post('doLogin',                  'UserController@doLogin');
Route::get('logout',                    'UserController@doLogOut');
Route::get('register',                  'UserController@makeRegister');
Route::post('doRegister',               'UserController@doCreateUser');
Route::get('rememberCredentials',       'UserController@makeCredentials');
Route::post('doSendCredentials',        'RemindersController@postRemind');
/*
|--------------------------------------------------------------------------
| User logged in Routes
|--------------------------------------------------------------------------
|
*/
Route::group(array('before' => 'auth'), function() {

    Route::get('/', function() {
        return Redirect::route('dashboard');
    });
    Route::get('dashboard',                 array('as' => 'dashboard',                  'uses' => 'UserController@makeDashboard'));
    Route::get('results/overview',          array('as' => 'results-overview',           'uses' => 'ResultController@getOverview'));
    Route::get('results/charts/{id}',       array('as' => 'chart',                      'uses' => 'ResultController@getChart'))->where('id', '[0-9]+');
    Route::get('upload',                    array('as' => 'upload',                     'uses' => 'VirtualController@makeUpload'));
    Route::post('doUpload',                 array('as' => 'doUpload',                   'uses' => 'VirtualController@doUpload'));
    Route::get('profile',                   array('as' => 'profile',                    'uses' => 'UserController@editProfile'));
    Route::post('profile',                  array('as' => 'doEditProfile',              'uses' => 'UserController@doEditProfile'));
    Route::get('vms/overview',              array('as' => 'vms-overview',               'uses' => 'VirtualController@getOverview'));
    Route::get('delete_loadscript/{id}',    array('as' => 'delete-loadscript',          'uses' => 'VirtualController@doDeleteLoadscript'))->where('id', '[0-9]+');
    Route::get('delete_virtualMachine/{id}',array('as' => 'delete-virtualMachine',      'uses' => 'VirtualController@doDeleteVirtualMachine'))->where('id', '[0-9]+');
    Route::post('upload_loadscript',        array('as' => 'upload-loadscript',          'uses' => 'VirtualController@doUploadLoadscript'));
    Route::get('vms/{id}',                  array('as' => 'vm',                         'uses' => 'VirtualController@getVM'))->where('id', '[0-9]+');
    Route::get('queue/add/{id}',            array('as' => 'doAddQueue',                 'uses' => 'QueueController@add'))->where('id', '[0-9]+');
    Route::get('queue',                     array('as' => 'queue',                      'uses' => 'QueueController@getOverview'));
    Route::get('profile/delete',            array('as' => 'doDelete',                   'uses' => 'UserController@doDelete'));

});

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
*/

Route::group(array('prefix'=>'api'), function() {

    Route::get('queue',                     array('uses' => 'ApiQueueController@get'));
    Route::post('queue',                    array('uses' => 'ApiQueueController@update'));
    Route::post('report',                   array('uses' => 'ApiReportController@store'));

});