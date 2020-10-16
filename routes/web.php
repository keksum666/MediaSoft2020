<?php

use Illuminate\Support\Facades\Route;

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




/*Routes films*/
Route::get('/',[App\Http\Controllers\FilmController::class,'index']);

Route::get('/getOne/{id}',[App\Http\Controllers\FilmController::class,'getOne']);

Route::get('/film/add',[App\Http\Controllers\FilmController::class,'getAddView'])->middleware('admin');

Route::post('/film/add',[App\Http\Controllers\FilmController::class,'addFilm'])->middleware('admin');

Route::get('/film/edit/{id}',[App\Http\Controllers\FilmController::class,'editFilmView'])->middleware('admin');

Route::post('/film/edit/{id}',[App\Http\Controllers\FilmController::class,'editFilm'])->middleware('admin');

Route::get('/film/delete/{id}',[App\Http\Controllers\FilmController::class,'deleteFilm'])->middleware('admin');



/*Routes actor*/
Route::get('/actors',[App\Http\Controllers\ActorController::class,'getActors']);

Route::get('/actor/add',[App\Http\Controllers\ActorController::class,'getAddView'])->middleware('admin');

Route::post('/actor/add',[App\Http\Controllers\ActorController::class,'addActor'])->middleware('admin');

Route::get('/actor/{id}',[App\Http\Controllers\ActorController::class,'getActor']);

Route::get('/actor/edit/{id}',[App\Http\Controllers\ActorController::class,'getEditView'])->middleware('admin');

Route::post('/actor/edit/{id}',[App\Http\Controllers\ActorController::class,'editActor'])->middleware('admin');

Route::get('/actor/delete/{id}',[App\Http\Controllers\ActorController::class,'deleteActor'])->middleware('admin');





/*Routes Producer*/
Route::get('/producers',[App\Http\Controllers\ProducerController::class,'getProducers']);

Route::get('/producer/add',[App\Http\Controllers\ProducerController::class,'getAddView'])->middleware('admin');

Route::post('/producer/add',[App\Http\Controllers\ProducerController::class,'addProducer'])->middleware('admin');

Route::get('/producer/{id}',[App\Http\Controllers\ProducerController::class,'getProducer']);

Route::get('/producer/edit/{id}',[App\Http\Controllers\ProducerController::class,'getEditView'])->middleware('admin');

Route::post('/producer/edit/{id}',[App\Http\Controllers\ProducerController::class,'editProducer'])->middleware('admin');

Route::get('/producer/delete/{id}',[App\Http\Controllers\ActorController::class,'deleteProducer'])->middleware('admin');

/*Routes review*/
Route::post('/review/new',[App\Http\Controllers\ReviewController::class,'newReview']);

Route::get('/review/delete/{review_id}/{film_id}',[App\Http\Controllers\ReviewController::class,'delete']);




/*Routes genre*/
Route::get('/genres',[App\Http\Controllers\GenreController::class,'getGenres']);

Route::get('/filmByGenre/{id}',[App\Http\Controllers\GenreController::class,'filmsByGenres']);

Route::get('/genres/add/',[App\Http\Controllers\GenreController::class,'getAddView'])->middleware('admin');

Route::post('/genres/add',[App\Http\Controllers\GenreController::class,'genreAdd'])->middleware('admin');

Route::get('/genres/delete/{id}',[App\Http\Controllers\GenreController::class,'genreDelete'])->middleware('admin');

Route::get('/genre/edit/{id}',[App\Http\Controllers\GenreController::class,'getEditView'])->middleware('admin');

Auth::routes();






