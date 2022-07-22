<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Model\Category;
use App\Models\Model\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use function response;

class CategoryController extends Controller
{
    //

    public function index(){

        $category=Category::all();

        return response()->json([

               'status'=>200,
                'category'=>$category,
            ]);


    }




    public function store(Request $request){

        $validator=Validator::make($request->all(),[

                   'meta_title'=>'required|max:191',
                   'slug'=>'required|max:191',
                   'name'=>'required|max:191',
             ]);

             if ($validator->fails()){


                 return response()->json([
                     'status'=>400,
                     'error'=>$validator->messages(),

                 ]);

             }


       else{

           $category=new Category();

           $category->meta_title=$request->input('meta_title');
           $category->meta_keyword=$request->input('meta_keyword');
           $category->meta_description=$request->input('meta_description');
           $category->slug=$request->input('slug');
           $category->name=$request->input('name');
           $category->description=$request->input('description');
           $category->status=$request->input('status')==true?'1':'0';
           $category->save();

           return response()->json([
               'status'=>200,
               'message'=>'Category Added Successfully',

           ]);



       }

           }


           public function edit($id){

                  $category=Category::find($id);
                  if ($category){
                      return response()->json([
                          'status'=>200,
                          'category'=>$category,

                      ]);

                  }
                  else{
                          return response()->json([
                              'status'=>404,
                              'message'=>'No category id found',

                          ]);

                  }


           }

                       public function update(Request  $request,$id){


                           $validator=Validator::make($request->all(),[

                               'meta_title'=>'required|max:191',
                               'slug'=>'required|max:191',
                               'name'=>'required|max:191',
                           ]);

                           if ($validator->fails()){


                               return response()->json([
                                   'status'=>422,
                                   'error'=>$validator->messages(),

                               ]);

                           }


                           else{

                               $category= Category::find($id);

                               if ($category){

                                   $category->meta_title=$request->input('meta_title');
                                   $category->meta_keyword=$request->input('meta_keyword');
                                   $category->meta_description=$request->input('meta_description');
                                   $category->slug=$request->input('slug');
                                   $category->name=$request->input('name');
                                   $category->description=$request->input('description');
                                   $category->status=$request->input('status')==true?'1':'0';
                                   $category->update();

                                   return response()->json([
                                       'status'=>200,
                                       'message'=>'Category Updated Successfully',

                                   ]);


                               }

                               else{


                                   return response()->json([
                                       'status'=>404,
                                       'message'=>'No category Id Found',

                                   ]);



                               }




                           }


                       }



                       public function destroy($id){

                        $category=Category::find($id);

                            if ($category) {

                                $category->delete();

                                return response()->json([

                                    'status' => 200,
                                    'message' => 'category Deleted Successfully',
                                ]);
                            }

                           else{
                               return response()->json([

                                   'status' => 200,
                                   'message' => 'No category id found',
                               ]);

                                }


                            }



                            public function allCategory(){

                                $category=Category::where('status','0')->get();

                                return response()->json([

                                   'status'=>200,
                                   'category'=>$category,
                                ]);


                            }


                            public function allOrders(){


                                $orders=Order::orderBy('id','DESC')->get();

                                return response()->json([

                                    'status'=>200,
                                    'orders'=>$orders,
                                ]);

                            }



}
