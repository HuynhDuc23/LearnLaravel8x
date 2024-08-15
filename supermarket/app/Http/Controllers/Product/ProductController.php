<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $data = $request->all();
        print_r($data['id']);
        // return view('clients.products.detail', compact('id'));
        $data = [
            'id' => $data['id'],
        ];

        // mac du la mang nhung khi render ra view thi truy xuat den phan tu la duoc

        // return view('clients.products.detail', $data);

        return view('clients.products.detail', $data);
    }
}
