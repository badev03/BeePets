<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Products;
use Brian2694\Toastr\Facades\Toastr;
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
        try {
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
            Toastr::success('Product added to cart successfully!','Success');
            return response()->json([
                'status' => 'success',
                'message' => 'Product added to cart successfully!',
                'carts' => $carts
            ]);
        }catch (\Exception $exception) {
            Toastr::error('Something went wrong!', 'Error');
            return response()->json([
                'status' => 'error',
                'message' => 'Something went wrong!',
            ]);
        }

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
        try {
            if($request->id && $request->quantity){

                $carts = session()->get('carts');
                $carts[$request->id]["quantity"] = $request->quantity;
                session()->put('carts', $carts);
                Toastr::success('Cart updated successfully!','Success');
                return response()->json([
                    'status' => 'success',
                    'message' => 'Cart updated successfully',
                    'carts' => $carts
                ]);
            }
        }catch (\Exception $exception) {
            Toastr::error('Something went wrong!', 'Error');
            return response()->json([
                'status' => 'error',
                'message' => 'Something went wrong!',
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
        try {
            $carts = session()->get('carts',[]);
            unset($carts[$request->product_id]);
            session()->put('carts', $carts);
            Toastr::success('Product removed from cart successfully!','Success');
            return response()->json([
                'status' => 'success',
                'message' => 'Product removed from cart successfully!',
                'carts' => $carts
            ]);
        }catch (\Exception $exception) {
            Toastr::error('Something went wrong!', 'Error');
            return response()->json([
                'status' => 'error',
                'message' => 'Something went wrong!',
            ]);
        }
    }
    public function getCarts() {
        $carts = session()->get('carts',[]);
        return view('admin.checkout.cart',compact('carts'));
    }

    public function unsetCarts() {
        session()->forget('carts');
        Toastr::success('Cart cleared successfully!','Success');
    }
}
