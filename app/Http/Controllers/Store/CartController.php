<?php
namespace App\Http\Controllers\Store;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
/**
 * Custom requests
 */
use App\Http\Requests\Shopping\AddToCartRequest;
/**
 * Models
 */
use App\Models\Product;
use Cart;

class CartController extends Controller
{
    /**
     * Adds product to cart
     *
     * @param AddToCartRequest $request
     */
    public function add(AddToCartRequest $request)
    {
        $product = Product::where('active', 1)->findOrFail((int)$request->product_id);
        if ($product) {
            Cart::associate('App\Models\Product')->add($product->id, $product->name, 1, $product->price);
        }
        return back();
    }

    public function show()
    {
        return view('store.shopping.cart');
    }

    /**
     * Removes product from cart
     *
     * @param  Request $request
     * @return Response
     */
    public function remove(Request $request)
    {
        Cart::remove($request['rowId']);
        return back();
    }

    /**
     * Clears current cart
     *
     * @return Response
     */
    public function clear()
    {
        Cart::destroy();
        return back();
    }

    /**
     * Shows view for confirming cart content and proceeding to order
     *
     * @return Response
     */
    public function checkout()
    {
        return view('store.shopping.checkout');
    }
}
