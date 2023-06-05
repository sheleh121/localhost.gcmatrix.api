<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

require_once  base_path('app/Http/Modules/Manufacturers/routes.php');
require_once  base_path('app/Http/Modules/Vendors/routes.php');
require_once  base_path('app/Http/Modules/Files/routes.php');
