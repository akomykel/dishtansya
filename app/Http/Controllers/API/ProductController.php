<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Repository\Product\ProductRepository;
use Illuminate\Http\Request;


class ProductController extends Controller
{
    private $productRepository;

    public function __construct(ProductRepository $productRepository) {
        $this->productRepository = $productRepository;
    }

    public function index()
    {
        $products = $this->productRepository->index();
        return $products;
    }

    public function store(Request $request)
    {
        $product = $this->productRepository->store($request);
        return $product;
    }

    public function show(Product $product)
    {
        $product = $this->productRepository->show($product);
        return $product;
    }

    public function update(Request $request, Product $product)
    {
        $product = $this->productRepository->update($request, $product);
        return $product;
    }

    public function destroy(Product $product)
    {
        $product = $this->productRepository->destroy($product);
        return $product;
    }
}
