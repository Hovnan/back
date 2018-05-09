<?php

namespace App\Http\Controllers;

use Auth;
use App\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index() {
        $user = Auth::user();
        return $user->products()->orderBy('created_at', 'desc')->get();
    }

    public function show($id) {
        $user = Auth::user();

        $product = $user->products()->where('id', $id)->first();
        if($product)
            return response()->json($product, 200);

        return response()->json(['error' => 'Resourse not found!'], 404);
    }
    public function update(Request $request, $id) {
        try {
            $user = Auth::user();
            $product = $user->products()->where('id', $id)->update($request->all());
            return response()->json($product, 204);
        }catch (\Exception $e){
            return response(['Problem with updating the product'], 500);
        }
    }


    public function store(Request $request) {
        $user = Auth::user();

        $user->products()->create([
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description,
        ]);
        return response()->json(['status' => 'success', 'message' => 'Product successfully added!'], 200);
    }

    /**
     * @param array
     */
    public function destroy($id)
    {
        try {
            Product::destroy($id);

            return response([], 204);
        }catch (\Exception $e){
            return response(['Problem with deleting the product'], 500);
        }
    }
}
