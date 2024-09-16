<?php

use App\Http\Controllers\CatagoryController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\ProfileController;
use App\Models\Catagory;
use App\Models\Item;
use Illuminate\Support\Facades\Route;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

Route::get('/', function () {
    return view('Home');
})->name('Home');

Route::get('test', function () {
    return view('test');
})->name('test');

Route::get('/dashboard',function(){
    $categories=Catagory::all();
    $items=Item::all();
    return view('profile.dashboard',compact('categories','items'));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::resource('category',CategoryController::class);
    Route::resource('item',ItemController::class);
    Route::get('search',[ItemController::class,'show'])->name('search');

});

require __DIR__.'/auth.php';
