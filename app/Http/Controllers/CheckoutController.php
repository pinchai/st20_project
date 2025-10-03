<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    //
    public function index(Request $request)
    {
        $products = DB::table('product')
            ->select('*')
            ->get();
        return view('checkout', ['products' => $products]);
    }


    public function placeOrder(Request $request)
    {
        $customer_info = "Email: <strong>{$request->email}</strong>\n";
        $customer_info .= "Phone: <strong>{$request->phone}</strong>\n";
        $customer_info .= "Name: <strong>{$request->first_name} {$request->last_name}</strong>\n";
        $customer_info .= "Address: <strong>{$request->address1}</strong>\n";

        $token = "bot8237102933:AAGbKFtEsQf-Nxat_HpnEaU5Pxxul9J-n0w";
        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'User-Agent' => 'Sample App Agent',
            'Content-Type' => 'application/json',
        ])->post("https://api.telegram.org/{$token}/sendMessage", [
            "text" => "\n🔔New Order Received!\n" . $customer_info,
            "parse_mode" => "HTML",
            "disable_web_page_preview" => "False",
            "disable_notification" => "False",
            "reply_to_message_id" => "None",
            "chat_id" => "756357473"
        ]);
        $data = $response->json();
        return redirect(route('checkout_index'))
            ->with('success', 'Order placed successfully!');
    }
}
