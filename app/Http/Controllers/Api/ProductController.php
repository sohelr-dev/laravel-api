<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $product=Product::select('*')->get();
        return response()->json([
            'product'=>$product,
            'success'=>true
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        // if($request->file('photo')){
        //     $productName = time().'.'.$request->photo->extension();

        //     // Save the image to public/images/products
        //     $request->photo->move(public_path('images/products'), $productName);

        //     // Save correct path to DB
        //     $request->merge([
        //         'photo' => 'images/products/' . $productName
        //     ]);

        //     // return $request->all(); // Return all data including photo path
        // }

        if($request->file('photo')){
            $productName = time().'.'.$request->photo->extension();
            $productPath = 'images/products/' . $productName;
            $request->photo->move(public_path('images/products'), $productPath);
            $request->merge([
                'photo'=>'images/products/'.$productName
            ]);
            // return $request->input('photo');
        };

        $product=DB::table('products')->insertGetId([
                'name' => $request->name,
                // 'price' => $request->price,
                // 'category_id' => $request->price,
                // 'quantity' => $request->quantity,
                'photo' => $request->input('photo'),
                // 'discount' => $request->discount ?? 0,
                // 'created_at' => now(),
                // 'updated_at' => now()
            ]);
        
        if($product){
            return response()->json([
                "message"=>"Product Save successfully",
                'data'=>$product,
                'success'=>true

            ]);
        }else{
            return response()->json([
                "message"=>"Product Not Found",
                'success'=>false

            ]);

        }

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
