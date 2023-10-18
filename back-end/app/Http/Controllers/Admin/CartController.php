<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Products;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $carts = session()->get('carts',[]);
        return response()->json([
            'status' => 'success',
            'message' => 'Cart fetched successfully!',
            'carts' => $carts
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $product = Products::findOrFail($request->product_id);
        $carts = session()->get('carts',[]);
        if(isset($carts[$product->id])){
            $carts[$product->id]['quantity']++;
        }else{
            $carts[$product->id] = [
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => $request->quantity,
                'image' => $product->image,
            ];
        }
        session()->put('carts', $carts);
        return response()->json([
            'status' => 'success',
            'message' => 'Product added to cart successfully!',
            'carts' => $carts
        ]);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function updateCart(Request $request)
    {
        if($request->id && $request->quantity){

            $carts = session()->get('carts');
            $carts[$request->id]["quantity"] = $request->quantity;
            session()->put('carts', $carts);
            return response()->json([
                'status' => 'success',
                'message' => 'Cart updated successfully',
                'carts' => $carts
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    public function removeCart(Request $request)
    {
        $carts = session()->get('carts',[]);
        unset($carts[$request->product_id]);
        session()->put('carts', $carts);
        return response()->json([
            'status' => 'success',
            'message' => 'Product removed from cart successfully!',
            'carts' => $carts
        ]);
    }
    public function getCarts() {
        $carts = session()->get('carts',[]);
        return view('admin.checkout.cart',compact('carts'));
    }

    public function unsetCarts() {
        session()->forget('carts');
    }
}
