<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MasterController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [MasterController::class, 'index'])->name('index');
Route::post('login'. '/', [MasterController::class, 'login'])->name('login');
Route::middleware('auth')->group(function(){
    Route::post('loadpage', function(Request $request){
        $destination = $request->destination; // Get the destination from the request
        return redirect(url($destination)); // Redirect to the module route
    })->name('loadpage');
    Route::post('sidebar_panel', [MasterController::class, 'sidebar_panel'])->name('sidebar_panel');
});
Route::post('logout', [MasterController::class, 'logout'])->name('logout');