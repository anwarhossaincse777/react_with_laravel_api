<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Model\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $category=Product::all();

        return response()->json([

            'status'=>200,
            'category'=>$category,
        ]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validator=Validator::make($request->all(),[

            'category_id'=>'required',
            'meta_title'=>'required|max:191',
            'slug'=>'required|max:191',
            'name'=>'required|max:191',
            'brand'=>'required|max:20',
            'selling_price'=>'required|max:20',
            'original_price'=>'required|max:20',
            'qty'=>'required|max:20',
            'image'=>'required|image|mimes:jpg,png,jpg|max:2048',
        ]);

        if ($validator->fails()){


            return response()->json([
                'status'=>400,
                'error'=>$validator->messages(),

            ]);

        }

        else{

            $product=new Product;
            $product->category_id=$request->input('category_id');
            $product->slug=$request->input('slug');
            $product->name=$request->input('name');
            $product->description=$request->input('description');



            $product->meta_title=$request->input('meta_title');
            $product->meta_keyword=$request->input('meta_keywords');
            $product->meta_description=$request->input('meta_description');



            $product->selling_price=$request->input('selling_price');
            $product->original_price=$request->input('original_price');
            $product->qty=$request->input('qty');
            $product->brand=$request->input('brand');


            if ($request->hasFile('image')){

                $file=$request->file('image');
                $extension=$file->getClientOriginalExtension();

                $filename=time().'.'.$extension;
                $file->move('uploads/product/',$filename);
                $product->image = 'uploads/product/'.$filename;


            }


            $product->feature=$request->input('feature')== true?'1':'0';
            $product->popular=$request->input('popular')== true?'1':'0';
            $product->status=$request->input('status')== true?'1':'0';

            $product->save();


            return response()->json([
                'status'=>200,
                'message'=>'product Added Successfully',

            ]);

        }




    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Model\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Model\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
            $product=Product::find($id);
            if ($product){
                return response()->json([
                    'status'=>200,
                    'product'=>$product,

                ]);

            }
            else {
                return response()->json([
                    'status' => 404,
                    'message' => 'No Product id found',

                ]);
            }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Model\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator=Validator::make($request->all(),[

            'category_id'=>'required',
            'meta_title'=>'required|max:191',
            'slug'=>'required|max:191',
            'name'=>'required|max:191',
            'brand'=>'required|max:20',
            'selling_price'=>'required|max:20',
            'original_price'=>'required|max:20',
            'qty'=>'required|max:20',
        ]);

        if ($validator->fails()){


            return response()->json([
                'status'=>400,
                'error'=>$validator->messages(),

            ]);

        }

        else{



            $product= Product::findOrFail($id);
            if ($product){

                $product->category_id=$request->input('category_id');
                $product->slug=$request->input('slug');
                $product->name=$request->input('name');
                $product->description=$request->input('description');



                $product->meta_title=$request->input('meta_title');
                $product->meta_keyword=$request->input('meta_keywords');
                $product->meta_description=$request->input('meta_description');



                $product->selling_price=$request->input('selling_price');
                $product->original_price=$request->input('original_price');
                $product->qty=$request->input('qty');
                $product->brand=$request->input('brand');


                if ($request->hasFile('image')){

                   $path=$product->image;
                   if (File::exists($path)){

                       File::delete($path);
                   }
                    $file=$request->file('image');
                    $extension=$file->getClientOriginalExtension();

                    $filename=time().'.'.$extension;
                    $file->move('uploads/product/',$filename);
                    $product->image = 'uploads/product/'.$filename;


                }


                $product->feature=$request->input('feature');
                $product->popular=$request->input('popular');
                $product->status=$request->input('status');

                $product->update();


                return response()->json([
                    'status'=>200,
                    'message'=>'Product Updated  Successfully',

                ]);


            }

            else{

                return response()->json([
                    'status'=>400,
                    'message'=>'Product Not Found',

                ]);


            }
        }






    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Model\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }
}
