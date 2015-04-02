<?php

/*
|--------------------------------------------------------------------------
| (Seflab) Check PHP.ini settings
|--------------------------------------------------------------------------
|
| If the max upload is lower than 100 the site will not run..
|
*/
if((int)str_replace('M', '', ini_get('post_max_size')) < 100 || (int)str_replace('M', '', ini_get('upload_max_filesize')) < 100) {
    die('The maximum file upload is lower than 100M! ' .
        'Set the PHP post_max_size and upload_max_filesize higher in the server php ini file. ' .
        'Consider setting it higher than 1 GB because virtual machines tend to get big.');
}

/*
|--------------------------------------------------------------------------
| Create The Application
|--------------------------------------------------------------------------
|
| The first thing we will do is create a new Laravel application instance
| which serves as the "glue" for all the components of Laravel, and is
| the IoC container for the system binding all of the various parts.
|
*/

$app = new Illuminate\Foundation\Application;

/*
|--------------------------------------------------------------------------
| Detect The Application Environment
|--------------------------------------------------------------------------
|
| Laravel takes a dead simple approach to your application environments
| so you can just specify a machine name for the host that matches a
| given environment, then we will automatically detect it for you.
|
*/

$env = $app->detectEnvironment(function() {

    // For environment detection we check if 'seflab' is in the host name
    // This is used so we don't have to put all machine names of the 
    // developers in here all the time
    //
    // use --env="production" modifier in console for production migrations
    //
    // *POTENTIAL SECURITY ISSUE*: for REAL production environments
    // use machine names instead, as the host name can be spoofed
    if(isset($_SERVER['HTTP_HOST']) && strpos($_SERVER['HTTP_HOST'], 'seflab')) return 'production';

    return 'local';
});

/*
|--------------------------------------------------------------------------
| Bind Paths
|--------------------------------------------------------------------------
|
| Here we are binding the paths configured in paths.php to the app. You
| should not be changing these here. If you need to change these you
| may do so within the paths.php file and they will be bound here.
|
*/

$app->bindInstallPaths(require __DIR__.'/paths.php');

/*
|--------------------------------------------------------------------------
| Load The Application
|--------------------------------------------------------------------------
|
| Here we will load this Illuminate application. We will keep this in a
| separate location so we can isolate the creation of an application
| from the actual running of the application with a given request.
|
*/

$framework = $app['path.base'].'/vendor/laravel/framework/src';

require $framework.'/Illuminate/Foundation/start.php';

/*
|--------------------------------------------------------------------------
| Return The Application
|--------------------------------------------------------------------------
|
| This script returns the application instance. The instance is given to
| the calling script so we can separate the building of the instances
| from the actual running of the application and sending responses.
|
*/

return $app;
