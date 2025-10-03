<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    //
    public function index(Request $request)
    {
        $products = DB::table('product')
            ->select('*')
            ->get();
        $cart_count = DB::table('cart')
            ->where('customer_id', 1)
            ->count();
        return view('home', [
            'products' => $products,
            'cart_count' => $cart_count
        ]);
    }

    public function getById(Request $request)
    {

        $products = DB::table('product')
            ->select('*')
            ->where('id', intval($request->pro_id))
            ->get();
        dd($products);
        return view('home', ['products' => $products]);
    }
}
