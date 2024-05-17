<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Models\TaskDiagram;

Route::get('/', function (Request $request) {
    $token = $request->get('token');
    $diagram = TaskDiagram::where('token', $token)->first() ?? new TaskDiagram();
    \Log::debug('diagram', [
        'diagram data' => $diagram,
    ]);
    return view('drawflow', ['diagram' => $diagram]);
});

// Route::get('/', function () {
//     return view('welcome');
// });
