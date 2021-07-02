<?php
namespace App\Repository\Order;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\OrderResource;

class OrderRepository {

    public function index() {
        $orders = Order::all();
        return response([ 'orders' => OrderResource::collection($orders), 'message' => 'Retrieved successfully'], 200);
    }

    public function store($request) {
        $is_order_success = false;

        $data = $request->all();

        $validator = Validator::make($data, [
            'user_id' => 'required',
            'product_id' => 'required',
            'quantity' => 'required'
        ]);

        if ($validator->fails()) {
            return response(['error' => $validator->errors(), 'Validation Error']);
        }

        $order = Order::create($data);

        if($order) {
            $is_order_success = true;
        }

        return response($is_order_success);
    }

    public function show($order) {
        return response(['order' => new OrderResource($order), 'message' => 'Retrieved successfully'], 200);
    }
}