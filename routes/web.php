<?php

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ListingController;
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

// Common Ressource routes : 
// index - show all lisstings
// show -show single listing
// create - Show form to create new listing
// store -Store new listing 
// edit - Show form to edit listing
// update - Update listing
// destroy - Delete listing

//All listings 
Route::get('/',[ListingController::class,"index"]);




//show create form
Route::get("/listings/create",[ListingController::class,"create"])->middleware("auth");


//store listing data
Route::post("/listings/store",[ListingController::class,"store"])->middleware("auth");


//edit listing data
Route::get("/listings/{listing}/edit",[ListingController::class,"edit"])->middleware("auth");


//Update listing
Route::put("listings/{listing}",[ListingController::class,"update"])->middleware("auth");

//delete listing
Route::delete("listings/{listing}",[ListingController::class,"destroy"])->middleware("auth");


//Manage Listings
Route::get("/listings/manage",[ListingController::class,"manage"])->middleware("auth");



//Single listing
Route::get("/listings/{listing}",[ListingController::class,"show"])->where("listing","[0-9]+");



//show register/create form
Route::get("/register",[UserController::class,"create"])->middleware("guest");

// Create new user
Route::post("/users",[UserController::class,"store"]);

//Log user out
Route::post("/logout",[UserController::class,"logout"])->middleware("auth");


//Show login form

Route::get("/login",[UserController::class,"login"])->name("login")->middleware("guest");


//authenticate  user
Route::post("/users/authenticate",[UserController::class,"authenticate"]);





// Route::get("/posts/{id}",function($id){
    //     // ddd($id); //die dump debug
    //     return response("Post $id");
    // })->where("id","[0-9]+");


// Route::get("/search",function(Request $request){
//     return ($request->name . " " .$request->pass);
// });