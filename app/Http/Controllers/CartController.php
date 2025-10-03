<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    //
    public function index(Request $request)
    {
        $cart = DB::table('cart')
            ->join('product', 'cart.product_id', '=', 'product.id')
            ->where('customer_id', 1)
            ->select(
                'product.*',
                'cart.qty',
                'cart.id as cart_id',
                'cart.selected as selected'
            )
            ->get();
        $total_price = 0;
        $shipping_fee = 1.5;
        foreach ($cart as $item) {
            if ($item->selected === 1) {
                $total_price += $item->price * $item->qty;
            }
        }
        return view('cart', [
            'cart' => $cart,
            'total_price' => $total_price,
            'shipping_fee' => $shipping_fee,
            'tax' => 0,
        ]);
    }

    public function addToCart(Request $request)
    {
        $productId = $request->input('product_id');
        $customer_id = 1;
        $cart = DB::table('cart')
            ->where('customer_id', $customer_id)
            ->where('product_id', $productId)
            ->first();

        if ($cart) {
            DB::table('cart')
                ->where('customer_id', $customer_id)
                ->where('product_id', $productId)
                ->increment('qty', 1);
        } else {
            DB::table('cart')->insert([
                'customer_id' => $customer_id,
                'product_id' => $productId,
                'qty' => 1,
            ]);
        }
        $last_cart = DB::table('cart')
            ->where('customer_id', $customer_id)
            ->get();
        return response()->json(
            [
                'message' => 'Product added to cart',
                'last_cart' => $last_cart
            ]);
    }

    public function addCartQty(Request $request)
    {
        $cart_id = $request->input('cart_id');
        $cart = DB::table('cart')
            ->where('id', $cart_id)
            ->first();

        if ($cart) {
            DB::table('cart')
                ->where('id', $cart_id)
                ->increment('qty', 1);
        }
        return redirect(route('cart_index'));
    }

    public function removeCartQty(Request $request)
    {
        $cart_id = $request->input('cart_id');
        $cart = DB::table('cart')
            ->where('id', $cart_id)
            ->first();

        if ($cart) {
            DB::table('cart')
                ->where('id', $cart_id)
                ->decrement('qty', 1);
        }
        return redirect(route('cart_index'));
    }

    public function deleteCartItem(Request $request)
    {
        $cart_id = $request->input('cart_id');
        $cart = DB::table('cart')
            ->where('id', $cart_id)
            ->first();

        if ($cart) {
            DB::table('cart')
                ->where('id', $cart_id)
                ->delete();
        }
        return redirect(route('cart_index'));
    }

    public function toggleCartItemSelection(Request $request)
    {
        $cart_id = $request->input('cart_id');
        $cart = DB::table('cart')
            ->where('id', $cart_id)
            ->first();
        if ($cart && $cart->selected === 1) {
            DB::table('cart')
                ->where('id', $cart_id)
                ->update(['selected' => 0]);
        }

        if ($cart && $cart->selected === 0) {
            DB::table('cart')
                ->where('id', $cart_id)
                ->update(['selected' => 1]);
        }
        return redirect(route('cart_index'));
    }
}
