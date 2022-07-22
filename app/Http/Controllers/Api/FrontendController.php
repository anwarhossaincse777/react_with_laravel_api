<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Model\Category;
use App\Models\Model\Product;
use Illuminate\Http\Request;

class FrontendController extends Controller
{

    public function getCategory(){

        $category=Category::where('status','0')->get();

        if ($category){

            return response()->json([

                'status'=>200,
                'category'=>$category,
            ]);
        }

    }


    public function product($slug){

        $category=Category::where('slug',$slug)->where('status','0')->first();

        if ($category){

            $product=Product::where('category_id',$category->id)->where('status','0')->get();

            if ($product){

                return response()->json([

                    'status'=>200,
                    'product_data'=>[

                        'product'=>$product,
                        'category'=>$category,

                    ]

                ]);

            }

            else{


                return response()->json([

                    'status'=>400,
                    'category'=>"No such Product Available",
                ]);
            }

            return response()->json([

                'status'=>200,
                'category'=>$category,
            ]);
        }

        else{


            return response()->json([

                'status'=>404,
                'category'=>"No such category found",
            ]);

        }


    }

    public function viewProduct($category_slug,$product_slug)


                {

                    $category=Category::where('slug',$category_slug)->where('status','0')->first();



                    if ($category){

                        $product=Product::where('category_id',$category->id)
                            ->where('slug',$product_slug)
                            ->where('status','0')
                            ->first();


                        if ($product){

                            return response()->json([

                                    'status'=>200,
                                    'product'=>$product,
                            ]);

                        }

                        else{


                            return response()->json([

                                'status'=>400,
                                'category'=>"No such Product Available",
                            ]);
                        }


                    }

                    else{


                        return response()->json([

                            'status'=>404,
                            'category'=>"No such category found",
                        ]);

                    }



                }


}
