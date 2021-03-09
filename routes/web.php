<?php

use App\Http\Livewire\Admin;
use App\Http\Livewire\AddNewProperty;
use App\Http\Livewire\EditSingleProperty;
use App\Http\Controllers\ImageController;
use Illuminate\Support\Facades\Route as RouteAlias;


RouteAlias::get('/', function () {
    return view('welcome');
});

RouteAlias::get('/admin', Admin::class);
RouteAlias::get('/update-property/{id}', EditSingleProperty::class);
RouteAlias::get('/add-new-property', AddNewProperty::class);


RouteAlias::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');
