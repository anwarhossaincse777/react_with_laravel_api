<?php

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

//our route start


    Route::post('register',[\App\Http\Controllers\Api\AuthController::class,'register']);
    Route::post('login',[\App\Http\Controllers\Api\AuthController::class,'login']);
    Route::get('/get-category',[\App\Http\Controllers\Api\FrontendController::class,'getCategory']);
    Route::get('/fetchProduct/{slug}',[\App\Http\Controllers\Api\FrontendController::class,'product']);
    Route::get('view-Product-details/{category_slug}/{product_slug}',[\App\Http\Controllers\Api\FrontendController::class,'viewProduct']);
    Route::post('add-to-cart',[\App\Http\Controllers\Api\CartController::class,'addToCart']);
    Route::get('cart',[\App\Http\Controllers\Api\CartController::class,'viewCart']);
    Route::put('cart-updateQuantity/{cart_id}/{scope}',[\App\Http\Controllers\Api\CartController::class,'updateQuantity']);

    Route::delete('delete_cartItem/{cart_id}',[\App\Http\Controllers\Api\CartController::class,'deleteCartItem']);


Route::post('validate-order',[\App\Http\Controllers\Api\CheckoutController::class,'validateOrder']);

    Route::post('place_oder',[\App\Http\Controllers\Api\CheckoutController::class,'placeOder']);









    //admin route

        Route::middleware('auth:sanctum','isApiAdmin')->group(function (){


            Route::get('/checkingAuthenticated',function (){

               return response()->json(['message'=>'Your are in','status'=>200],200);

            });

            //category route
            Route::get('/view-category',[\App\Http\Controllers\Api\CategoryController::class, 'index']);
            Route::post('/store/add-category',[\App\Http\Controllers\Api\CategoryController::class, 'store']);
            Route::get('/edit-category/{id}',[\App\Http\Controllers\Api\CategoryController::class, 'edit']);
            Route::put('/update-category/{id}',[\App\Http\Controllers\Api\CategoryController::class, 'update']);
            Route::delete('/delete-category/{id}',[\App\Http\Controllers\Api\CategoryController::class, 'destroy']);
            Route::get('/all-category',[\App\Http\Controllers\Api\CategoryController::class, 'allCategory']);

        //products route
            Route::get('/view-product',[\App\Http\Controllers\Api\ProductController::class, 'index']);
            Route::post('/store-product',[\App\Http\Controllers\Api\ProductController::class, 'store']);
            Route::get('/edit-product/{id}',[\App\Http\Controllers\Api\ProductController::class, 'edit']);
            Route::post('/update-product/{id}',[\App\Http\Controllers\Api\ProductController::class, 'update']);
            Route::delete('/delete-category/{id}',[\App\Http\Controllers\Api\CategoryController::class, 'destroy']);
            Route::get('/all-category',[\App\Http\Controllers\Api\CategoryController::class, 'allCategory']);


        //order routes


        Route::get('/admin/view-orders',[\App\Http\Controllers\Api\CategoryController::class, 'allOrders']);

        });



        Route::middleware('auth:sanctum')->group(function (){

            Route::post('logout',[\App\Http\Controllers\Api\AuthController::class,'logout']);
        });




//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();








//
//});
