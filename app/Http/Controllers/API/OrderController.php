<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Repository\Order\OrderRepository;
use App\Repository\Product\ProductRepository;
use Illuminate\Http\Request;


class OrderController extends Controller
{
    private $orderRepository;
    private $productRepository;

    public function __construct(OrderRepository $orderRepository, ProductRepository $productRepository) {
        $this->orderRepository = $orderRepository;
        $this->productRepository = $productRepository;
    }

    public function index()
    {
        $orders = $this->orderRepository->index();
        return $orders;
    }

    public function store(Request $request)
    {
        $order = $this->orderRepository->store($request);

        if($order == true){
            $product = $this->productRepository->minus_product_quantity($request);
            return $product;
        }

        return $order;
    }

    public function show(Order $order)
    {
        $order = $this->orderRepository->show($order);
        return $order;
    }
}
