<?php
namespace App\Repository\Product;

use App\Models\Product;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\ProductResource;

class ProductRepository {

    public function index()
    {
        $products = Product::all();
        return response([ 'products' => ProductResource::collection($products), 'message' => 'Retrieved successfully'], 200);
    }

    public function store($request)
    {
        $data = $request->all();

        $validator = Validator::make($data, [
            'name' => 'required|max:255',
            'available_stock' => 'required|max:255'
        ]);

        if ($validator->fails()) {
            return response(['error' => $validator->errors(), 'Validation Error']);
        }

        $product = Product::create($data);
        return response(['product' => new ProductResource($product), 'message' => 'Created successfully'], 201);
    }

    public function show($product)
    {
        return response(['product' => new ProductResource($product), 'message' => 'Retrieved successfully'], 200);
    }

    public function update($request, $product)
    {
        $product->update($request->all());
        return response(['product' => new ProductResource($product), 'message' => 'Update successfully'], 200);
    }

    public function destroy($product)
    {
        $product->delete();
        return response(['message' => 'Deleted']);
    }

    public function minus_product_quantity($request) {
        $product = Product::where('id', $request->input("product_id"))->first();

        if($request->input("quantity") > $product->available_stock) {
            return response(['message' => 'Failed to order this product due to unavailability of the stock'], 400);
        } else {
            $product->update([
                'available_stock' => $product->available_stock - $request->input("quantity"),
            ]);

            return response(['message' => 'You have successfully ordered this product.'], 201);
        }
    }
}