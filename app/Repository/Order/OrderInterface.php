<?php
namespace App\Repository\Order;

interface OrderInterface {
    public function index();
    public function store($request);
    public function show($product);
}