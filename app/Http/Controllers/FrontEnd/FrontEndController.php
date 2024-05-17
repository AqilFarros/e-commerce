<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
}
