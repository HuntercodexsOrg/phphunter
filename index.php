<?php

require_once __DIR__ . '/vendor/autoload.php';

use PhpHunter\Framework\Connectors\ApiRouterConector;

#################################################
# API
#################################################

$api = new ApiRouterConector();

/*Error: Nao pode aceitar rotas sem controllers*/
$api->get('/api/find-all')->run();

//----------------------------------------------------------------------------------------------------------------------
/*POST:CREATE*/
$api->post('/api/create', 'AppAuthMiddleware@checkAuth', 'ApplicationSampleController@createSample')->run();
$api->post('/api/{id:number}/create', 'AppAuthMiddleware@checkAuth', 'ApplicationSampleController@createIdSample')->run();
$api->post('/api/{id:number}/create/{profile:string}', 'AppAuthMiddleware@checkAuth', 'ApplicationSampleController@createUserSample')->run();
$api->post('/api/{id:number}/create{query:query_string}', 'AppAuthMiddleware@checkAuth', 'ApplicationSampleController@createIdSample')->run();
/*file*/
$api->post('/api/service/file/send', 'AppAuthMiddleware@checkAuth', 'ApplicationFileService@sendFile')->run();
/*test*/
$api->post('/api/test/user', 'AppAuthMiddleware@checkAuth', 'ApplicationSampleController@testSamplePost')->run();
/*new*/
$api->post('/api/user', 'AppAuthMiddleware@checkAuth', 'UserSampleController@new')->run();

//----------------------------------------------------------------------------------------------------------------------
/*GET:READ*/
$api->get('/api/read', 'AppAuthMiddleware@checkAuth', 'ApplicationSampleController@readSample')->run();
$api->get('/api/{id:number}/read', 'AppAuthMiddleware@checkAuth', 'ApplicationSampleController@readIdSample')->run();
/*static*/
$api->get('/api/static/read', 'AppAuthMiddleware@checkAuth', 'ApplicationSampleController::staticSample')->run();
/*test*/
$api->get('/api/test/user', 'AppAuthMiddleware@checkAuth', 'ApplicationSampleController@testSampleGet')->run();
/*service/sample*/
$api->get('/api/service/sample', 'AppAuthMiddleware@checkAuth', 'ApplicationSampleService@sampleServiceTest')->run();
/*faker*/
$api->get('/api/faker', 'AppAuthMiddleware@checkAuth', 'UserSampleController@findFaker')->run();
/*model-user-find, example: http://local.phphunter.dockerized/api/user/444444*/
$api->get('/api/user/{id:number}', 'AppAuthMiddleware@checkAuth', 'UserSampleController@find')->run();
/*model-user-find-all, example: http://local.phphunter.dockerized/api/user*/
$api->get('/api/user', 'AppAuthMiddleware@checkAuth', 'UserSampleController@findAll')->run();

//----------------------------------------------------------------------------------------------------------------------
/*PUT:UPDATE*/
$api->put('/api/update', 'AppAuthMiddleware@checkAuth', 'ApplicationSampleController@updateSample')->run();
$api->put('/api/{id:number}/update', 'AppAuthMiddleware@checkAuth', 'ApplicationSampleController@updateIdSample')->run();
/*update, example: http://local.phphunter.dockerized/api/user/333333*/
$api->put('/api/user/{id:number}', 'AppAuthMiddleware@checkAuth', 'UserSampleController@up')->run();

//----------------------------------------------------------------------------------------------------------------------
/*DELETE:DELETE*/
$api->delete('/api/delete', 'AppAuthMiddleware@checkAuth', 'ApplicationSampleController@deleteSample')->run();
$api->delete('/api/{id:number}/delete', 'AppAuthMiddleware@checkAuth', 'ApplicationSampleController@deleteIdSample')->run();
/*delete, example: http://local.phphunter.dockerized/api/user/222222*/
$api->delete('/api/user/{id:number}', 'AppAuthMiddleware@checkAuth', 'UserSampleController@down')->run();

//----------------------------------------------------------------------------------------------------------------------
/*PATCH:NULL*/
$api->patch('/api/update2', 'AppAuthMiddleware@checkAuth', 'ApplicationSampleController@patchSample')->run();
$api->patch('/api/{id:number}/update2', 'AppAuthMiddleware@checkAuth', 'ApplicationSampleController@patchIdSample')->run();
/*patch-fix, example: http://local.phphunter.dockerized/api/user/111111*/
$api->patch('/api/user/{id:number}', 'AppAuthMiddleware@checkAuth', 'UserSampleController@fix')->run();

//----------------------------------------------------------------------------------------------------------------------
//$api->get('/api/find-all', 'HandlerTasksController::getAllTasks')->run();
//$api->get('/api/find-all', 'PhpHunterAuthMiddleware@testAuth', 'HandlerTasksController::getAllTasks')->run();
//$api->get('/api/find-all', 'PhpHunterAuthMiddleware@checkAuth', 'HandlerTasksController::getAllTasks')->run();
//$api->get('/api/find/{file:alpha}', 'PhpHunterAuthMiddleware@checkAuth', 'HandlerTasksController::getTasks')->run();
//$api->post('/api/find/{id:number}/update/{email:email}', 'HandlerTasksController::getAllTasks')->run();
//$api->run();
//$api->showRouterDetails()->run();
$api->exception();

#######################################################################################################################

//use PhpHunter\Kernel\Utils\GenericTools;
//use PhpHunter\Kernel\Controllers\DotEnvController;
//use PhpHunter\Kernel\Controllers\DumperController;
//use PhpHunter\Kernel\Controllers\HunterCatcherController;
//use PhpHunter\Kernel\Controllers\InitServerController;
//use PhpHunter\Kernel\Controllers\ApiRouterController;
//use PhpHunter\Kernel\Controllers\WebRouterController;

//use PhpHunter\Framework\App\Controllers\HandlerTasksController;

#################################################
# CATHER
#################################################

//HunterCatcherController::hunterCatcher('This is a error message', 500, true);

#################################################
# DUMPER
#################################################

//DumperController::smartDumper("This is a test", true);

#################################################
# GENERIC TOOLS
#################################################

//$local_logger = GenericTools::localLogger('hunter', 'testing 123', true);
//$to_array = GenericTools::toArray(DotEnvController::getEnv("/api", "SETUP_DIR"), ',');
//var_dump('<pre>', $to_array, '</pre>');

#################################################
# DOT ENV
#################################################

//DotEnvController::loadEnvCached("/api");
//$app_description = DotEnvController::getEnvCached('APP_DESCRIPTION');
//echo $app_description;

//DotEnvController::debugEnv("./api");

//$app_name = DotEnvController::getEnv("/api", "APP_NAME");
//echo "<br />".$app_name;

#################################################
# INIT SERVER
#################################################

//new InitServerController(['error' => true, 'cors' => true, 'memory' => true]);

#################################################
# WEB ROUTER
#################################################

//$web = new WebRouterController();
//$web->setAbsoluteLocation("https://www.google.com")->redirect(); //Error
//$web->setRelativeLocation("https://www.google.com")->redirect(); //Error
//$web->setExternalLocation("/api/pages")->redirect(); //Error

//$web->setAbsoluteLocation("/api/pages")->redirect();
//$web->setAbsoluteLocation("/api/pages/profile")->redirect();
//$web->setAbsoluteLocation("/api/pages/profile/user.php?name=Username")->redirect();

//$web->setRelativeLocation("/api/pages")->redirect();
//$web->setRelativeLocation("/api/pages/profile")->redirect();
//$web->setRelativeLocation("/api/pages/profile/user.php?name=UsernameRel")->redirect();

//$web->setExternalLocation("https://www.google.com")->redirect();

//$web->redirectTo("/api/pages/profile");
//$web->redirectTo("/api/pages/profile/user.php?name=UsernameTo");
//$web->redirectTo("https://www.google.com");

#################################################
# API ROUTER
#################################################

//$api = new ApiRouterController();

//$api->get('/api/find-all')->run();/*Error*/
//$api->get('/api/find-all', 'HandlerTasksController::getAllTasks')->run();
//$api->get('/api/find-all', 'AuthMiddleware@testAuth', 'HandlerTasksController::getAllTasks')->run();
//$api->get('/api/find/{file:alpha}', 'AuthMiddleware@checkAuth', 'HandlerTasksController::getTasks')->run();
//$api->post('/api/find/{id:number}/update/{email:email}', 'HandlerTasksController::getAllTasks')->run();

//$api->run();
//$api->showRouterDetails()->run();
//$api->exception();

#################################################
# OLD
#################################################

//session_start();
//
//require_once "./app/functions.php";
//require_once "./app/source/AppHandler.php";
//
//$path = env('CONTENT_PATH');
//$public = env('PUBLIC_DIR');
//$file = env('DEFAULT_FILE');
//$setup = toArray(env('SETUP_DIR'));
//$views_file = env("VIEWS_FILE");
//
//$app = new AppHandler($path, $public, $file, $views_file, $setup);
//$app->appControl($_SERVER);
//$app->run();
