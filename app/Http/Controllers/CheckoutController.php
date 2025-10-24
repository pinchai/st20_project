<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use KHQR\BakongKHQR;
use KHQR\Helpers\KHQRData;
use KHQR\Models\IndividualInfo;

class CheckoutController extends Controller
{
    //
    public function index(Request $request)
    {
        $cart = DB::table('cart')
            ->join('product', 'cart.product_id', '=', 'product.id')
            ->where('customer_id', 1)
            ->where('cart.selected', 1)
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
        return view('checkout', [
            'cart' => $cart,
            'total_price' => $total_price,
            'shipping_fee' => $shipping_fee,
        ]);
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

    public function generateQr(Request $request)
    {
        $total_price = $this->totalPrice();
        $individualInfo = new IndividualInfo(
            bakongAccountID: 'choeurn_pinchai@aclb',
            merchantName: 'PINCHAI CHOEURN',
            merchantCity: 'PHNOM PENH',
            currency: KHQRData::CURRENCY_USD,
            amount: $total_price
        );
        $qr = BakongKHQR::generateIndividual($individualInfo);
        return response()->json([
            'qr' => $qr,
            'amount' => $total_price,
            'currency' => 'USD',
            'merchantName' => 'PINCHAI CHOEURN',
        ]);
    }

    public function checkPaymentStatus(Request $request)
    {
        $md5 = $request->md5;
        $response = Http::withHeaders([
            'Authorization' => 'Bearer '.env("KHQR_TOKEN"),
            'Content-Type' => 'application/json'
        ])->post('https://api-bakong.nbc.gov.kh/v1/check_transaction_by_md5', [
            'md5' => $md5,
        ]);
        return response()->json($response->json());
    }

    public function customerThank(Request $request)
    {
        return view('customer_thank');
    }

    function totalPrice()
    {
        $cart = DB::table('cart')
            ->join('product', 'cart.product_id', '=', 'product.id')
            ->where('customer_id', 1)
            ->where('cart.selected', 1)
            ->select(
                'product.*',
                'cart.qty',
                'cart.id as cart_id',
                'cart.selected as selected'
            )
            ->get();

        $total_price = 0;
        foreach ($cart as $item) {
            if ($item->selected === 1) {
                $total_price += $item->price * $item->qty;
            }
        }
        return $total_price + 1.5;
    }

}
