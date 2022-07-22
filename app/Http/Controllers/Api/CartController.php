<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Model\Cart;
use App\Models\Model\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{

    public function addToCart(Request $request)
    {


        if (auth('sanctum')->check()) {


            $user_id = auth('sanctum')->user()->id;
            $product_id = $request->product_id;
            $product_qty = $request->product_qty;

            $productCheck = Product::where('id', $product_id)->first();
            if ($productCheck) {

                if (Cart::where('product_id', $product_id)->where('user_id', $user_id)->exists()) {

                    return response()->json([

                        'status' => 409,
                        'message' => $productCheck->name . ' Already Added to Cart',

                    ]);

                } else {

                    $cartItem = new Cart();

                    $cartItem->user_id = $user_id;
                    $cartItem->product_id = $product_id;
                    $cartItem->product_qty = $product_qty;
                    $cartItem->save();

                    return response()->json([

                        'status' => 200,
                        'message' => ' Added to Cart',
                    ]);

                }

                return response()->json([

                    'status' => 200,
                    'message' => ' I am in Cart',

                ]);

            } else {

                return response()->json([

                    'status' => 404,
                    'message' => 'Product Not Found',


                ]);


            }


        } else {

            return response()->json([

                'status' => 401,
                'message' => 'Login to add to Cart',


            ]);


        }


    }


    public function viewCart()
    {

        if (auth('sanctum')->check()) {

            $user_id = auth('sanctum')->user()->id;
            $cartItems = Cart::where('user_id', $user_id)->get();

            return response()->json([

                'status' => 200,
                'cart' => $cartItems,
            ]);
        } else {

            return response()->json([

                'status' => 401,
                'message' => 'Login to view cart Data',


            ]);


        }


    }


    public function updateQuantity($cart_id,$scope)
    {

        if (auth('sanctum')->check()) {

            $user_id = auth('sanctum')->user()->id;
            $cartItems = Cart::where('id',$cart_id)->where('user_id', $user_id)->first();

           if ($scope=="inc"){

               $cartItems->product_qty +=1;
           }
           else if($scope=="dec"){

               $cartItems->product_qty -=1;
           }
           $cartItems->update();

           return response()->json([

                'status' => 200,
                'cart' => "Quantity Updated",
            ]);
        }


    else {

        return response()->json([

            'status' => 401,
            'message' => 'Login in to continue',


        ]);


    }

    }


    public function deleteCartItem($cart_id){

        if (auth('sanctum')->check()) {

            $user_id = auth('sanctum')->user()->id;
            $cartItems = Cart::where('id',$cart_id)->where('user_id', $user_id)->first();

            if ($cartItems){

                 $cartItems->delete();
                return response()->json([

                    'status' => 200,
                    'message' => "Cart Item remove Successfully",
                ]);
            }
            else{

                return response()->json([

                    'status' => 404,
                    'message' => 'Cart Item not found',


                ]);
            }

        }
        else {

            return response()->json([

                'status' => 401,
                'message' => 'Login in to continue',


            ]);


        }

    }
}
