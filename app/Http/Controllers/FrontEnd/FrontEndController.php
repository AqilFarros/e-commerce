<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\TransactionItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Midtrans\Config;
use Midtrans\Snap;

class FrontEndController extends Controller
{
    public function index()
    {
        $category = Category::select('id', 'name', 'slug')->latest()->get();
        $product = Product::with('product_galleries')->select('id', 'name', 'slug', 'price')->latest()->limit(8)->get();
        return view('pages.frontend.index', compact('category', 'product'));
    }

    public function detailProduct($slug)
    {
        $category = Category::select('id', 'name', 'slug')->latest()->get();
        $product = Product::with('product_galleries')->where('slug', $slug)->first();
        $recommendation = Product::with('product_galleries')->select('id', 'slug', 'name', 'price')->inRandomOrder()->limit(8)->get();

        return view('pages.frontend.detail-product', compact('category', 'product', 'recommendation'));
    }

    public function detailCategory($slug)
    {
        $category = Category::select('id', 'name', 'slug')->latest()->get();
        $thisCategory = Category::select('id', 'name', 'slug')->where('slug', $slug)->first();
        $product = Product::with('product_galleries')->where('category_id', $thisCategory->id)->select('id', 'slug', 'name', 'price')->latest()->get();

        return view('pages.frontend.detail-category', compact('category', 'thisCategory', 'product'));
    }

    public function cart()
    {
        $category = Category::select('id', 'name', 'slug')->latest()->get();
        $cart = Cart::with('product')->where('user_id', Auth::user()->id)->latest()->get();

        return view('pages.frontend.cart', compact('category', 'cart'));
    }

    public function addToCart(Request $request, $id)
    {
        try {
            Cart::create([
                'product_id' => $id,
                'user_id' => Auth::user()->id
            ]);

            return redirect()->route('cart');
        } catch (\Exception $th) {
            return redirect()->route('cart');
        }
    }

    public function deleteCart($id)
    {
        try {
            Cart::findOrFail($id)->delete();

            return redirect()->route('cart');
        } catch (\Exception $th) {
            return redirect()->back();
        }
    }

    public function checkOut(Request $request)
    {
        try {
            $data = $request->all();

            $cart = Cart::with('product')->where('user_id', auth()->user()->id)->get();

            $transaction = Transaction::create([
                "user_id" => auth()->user()->id,
                "name" => $data['name'],
                "email" => $data['email'],
                "address" => $data['address'],
                "phone" => $data['phone'],
                "total_price" => $cart->sum('product.price')
            ]);

            foreach ($cart as $item) {
                TransactionItem::create([
                    'user_id' => auth()->user()->id,
                    'product_id' => $item->product_id,
                    'transaction_id' => $transaction->id
                ]);
            }

            Cart::where('user_id', auth()->user()->id)->delete();

            Config::$serverKey = config('services.midtrans.serverKey');
            Config::$clientKey = config('services.midtrans.clientKey');
            Config::$isProduction = config('services.midtrans.isProduction');
            Config::$isSanitized = config('services.midtrans.isSanitized');
            Config::$is3ds = config('services.midtrans.is3ds');

            $midtrans = [
                'transaction_details' => [
                    'order_id' => 'Farros' . $transaction->id,
                    'gross_amount' => (int) $transaction->total_price
                ],
                'customer_details' => [
                    'first_name' => $transaction->name,
                    'email' => $transaction->email,
                    'phone' => $transaction->phone
                ],
                'enable_payments' => ['gopay', 'bank_transfer'],
                'vtweb' => []
            ];

            $paymentUrl = Snap::createTransaction($midtrans)->redirect_url;

            $transaction->update([
                'payment_url' => $paymentUrl
            ]);

            return redirect($paymentUrl);
        } catch (\Exception $th) {
            dd($th->getMessage());
            return redirect()->back();
        }
    }
}
