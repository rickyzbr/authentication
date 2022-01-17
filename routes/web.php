<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\CargoController;
use App\Http\Controllers\ContactsClientController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\SubCategoriesController;
use App\Http\Controllers\WarrantyController;
use App\Http\Controllers\StatusWarrantyController;
use App\Http\Controllers\StepsWarrantyController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [HomeController::class, 'index'] )->middleware('auth');

//Rotas Para Home Dashboard
Route::get('/dashboard', [HomeController::class, 'index'] )->middleware('auth');

//Rotas Para Gerenciamento dos Clientes
Route::get('clientes', [ClientController::class, 'index'] )->name('clients.index')->middleware('auth');
Route::get('clientes/create', [ClientController::class, 'create'] )->name('client.create')->middleware('auth');
Route::post('clientes', [ClientController::class, 'store'] )->name('client.store')->middleware('auth');
Route::get('clientes/edit/{id}', [ClientController::class, 'edit'] )->name('client.edit')->middleware('auth');
Route::put('clientes/{id}', [ClientController::class, 'update'] )->name('client.update')->middleware('auth');
Route::delete('clientes/{id}', [ClientController::class, 'destroy'] )->name('client.destroy')->middleware('auth');
Route::get('clientes/view/{id}',[ClientController::class, 'show'] )->name('client.view')->middleware('auth');


//Links para Vincular contatos ao cliente
Route::get('clientes/{id}/contatos', [ContactsClientController::class, 'index'] )->name('client.contacts')->middleware('auth');
Route::post('clientes/contatos/{id}', [ContactsClientController::class, 'store'] )->name('clientcontact.store')->middleware('auth');
Route::put('clientes/contatos/{id}/edit', [ContactsClientController::class, 'edit'])->name('clientcontact.edit')->middleware('auth');
Route::post('clientes/{id}/update',[ContactsClientController::class, 'update'])->name('clientcontact.update')->middleware('auth');
Route::post('clientes/contatos', [ContactsClientController::class, 'store'])->name('clientcontact.store')->middleware('auth');
Route::get('clientes/contatos/{id}/delete', [ContactsClientController::class, 'destroy'])->name('clientcontact.delete')->middleware('auth');

//Kinks para cadastrar Cargo 
Route::post('clientes/cargos/', [CargoController::class, 'store'] )->name('cargo.store')->middleware('auth');

//Links para Vincular Anexos ao cliente
Route::get('clientes/{id}/anexos', [AttachmentsClientsController::class, 'index'] )->name('client.attachments');
Route::post('clientes/{id}/file_upload', [AttachmentsClientsController::class, 'uploadFiles'])->name('client.uploadFiles');

//Rotas Para Gerenciamento das Categorias
Route::get('categorias', [CategoriesController::class, 'index'] )->name('categories.index')->middleware('auth');
Route::get('categorias/create', [CategoriesController::class, 'create'] )->name('category.create')->middleware('auth');
Route::post('categorias', [CategoriesController::class, 'store'] )->name('category.store')->middleware('auth');
Route::get('categorias/edit/{id}', [CategoriesController::class, 'edit'] )->name('category.edit')->middleware('auth');
Route::put('categorias/{id}', [CategoriesController::class, 'update'] )->name('category.update')->middleware('auth');
Route::delete('categorias/{id}', [CategoriesController::class, 'destroy'] )->name('category.destroy')->middleware('auth');
Route::get('categorias/view/{id}', [CategoriesController::class, 'show'] )->name('category.view')->middleware('auth');
Route::post('categories/reorder', [CategoriesController::class, 'reorder'])->name('categories.reorder');

//Rotas para Gerenciamento das Sub-Categorias

Route::get('subcategorias', [SubCategoriesController::class, 'index'] )->name('subcategories.index')->middleware('auth');
Route::get('subcategorias/create', [SubCategoriesController::class, 'create'] )->name('subcategory.create')->middleware('auth');
Route::post('subcategorias', [SubCategoriesController::class, 'store'] )->name('subcategory.store')->middleware('auth');
Route::get('subcategorias/edit/{id}', [SubCategoriesController::class, 'edit'] )->name('subcategory.edit')->middleware('auth');
Route::put('subcategorias/{id}', [SubCategoriesController::class, 'update'] )->name('subcategory.update')->middleware('auth');
Route::delete('subcategorias/{id}', [SubCategoriesController::class, 'destroy'] )->name('subcategory.destroy')->middleware('auth');
Route::post('subcategorias/reorder',  [SubCategoriesController::class, 'reorder'] )->name('subcategories.reorder');

//Rotas para Gerenciamento das Garantias
Route::get('garantias', [WarrantyController::class, 'index'] )->name('warranties.index')->middleware('auth');
Route::get('garantias/create', [WarrantyController::class, 'create'] )->name('warranty.create')->middleware('auth');
Route::post('garantias', [WarrantyController::class, 'store'] )->name('warranty.store')->middleware('auth');
Route::get('garantias/edit/{id}', [WarrantyController::class, 'edit'] )->name('warranty.edit')->middleware('auth');
Route::get('garantias/view/{id}', [WarrantyController::class, 'show'] )->name('warranty.show')->middleware('auth');
Route::get('garantias/viewpdf/{id}', [WarrantyController::class, 'showPdf'])->name('warranty.pdf')->middleware('auth');
Route::get('garantias/images/{id}', [WarrantyController::class, 'photos'] )->name('warranty.images')->middleware('auth');
Route::post('garantias/images/{id}', [WarrantyController::class, 'uploadPhotos'] )->name('warrantyimages.store')->middleware('auth');
Route::delete('garantias/images/{id}/delete', [WarrantyController::class, 'destroyPhotos'] )->name('warrantyimages.destroy')->middleware('auth');
Route::get('garantias/files/{id}', [WarrantyController::class, 'files'] )->name('warranty.files')->middleware('auth');
Route::put('garantias/{id}', [WarrantyController::class, 'update'] )->name('warranty.update')->middleware('auth');
Route::put('garantias/{id}/update', [WarrantyController::class, 'statusChange'] )->name('warranty.updatestatus')->middleware('auth');
Route::delete('garantias/{id}', [WarrantyController::class, 'destroy'] )->name('warranty.destroy')->middleware('auth');
Route::any('garantias/search', [WarrantyController::class, 'searchWarranty'] )->name('warranty.search')->middleware('auth');

//Rotas para Estapas do processo da Garantia
Route::get('garantias/steps/{id}', [StepsWarrantyController::class, 'index'] )->name('stepswarranties.index')->middleware('auth');
Route::get('garantias/steps/{id}/create', [StepsWarrantyController::class, 'create'] )->name('stepswarranty.create')->middleware('auth');
Route::post('garantias/steps/{id}', [StepsWarrantyController::class, 'store'] )->name('stepswarranty.store')->middleware('auth');
Route::get('garantias/steps/{id}/edit', [StepsWarrantyController::class, 'edit'] )->name('stepswarranty.edit')->middleware('auth');
Route::put('garantias/steps/edit/{id}', [StepsWarrantyController::class, 'update'] )->name('stepswarranty.update')->middleware('auth');
Route::delete('garantias/steps/{id}', [StepsWarrantyController::class, 'destroy'] )->name('stepswarranty.destroy')->middleware('auth');


//Rotas para Gerenciamento dos Status das Garantias
Route::get('garantias/status', [StatusWarrantyController::class, 'index'] )->name('warrantiesstatus.index')->middleware('auth');
Route::get('garantias/status/create', [StatusWarrantyController::class, 'create'] )->name('warrantystatus.create')->middleware('auth');
Route::post('garantias/status', [StatusWarrantyController::class, 'store'] )->name('warrantystatus.store')->middleware('auth');
Route::get('garantias/status/edit/{id}', [StatusWarrantyController::class, 'edit'] )->name('warrantystatus.edit')->middleware('auth');
Route::put('garantias/status/{id}', [StatusWarrantyController::class, 'update'] )->name('warrantystatus.update')->middleware('auth');
Route::delete('garantias/status/{id}', [StatusWarrantyController::class, 'destroy'] )->name('warrantystatus.destroy')->middleware('auth');




require __DIR__.'/auth.php';
