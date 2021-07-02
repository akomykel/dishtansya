<?php
namespace App\Repository\Product;

interface ProductInterface {
    public function index();
    public function store($request);
    public function show($product);
    public function update($request, $product);
    public function destroy($product);
    public function minus_product_quantity($product);
}