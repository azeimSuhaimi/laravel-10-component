<?php

namespace App\Http\Controllers;

use Gloudemans\Shoppingcart\Facades\Cart;

use Illuminate\Http\Request;

class shoppingCart extends Controller
{
    //https://packagist.org/packages/hardevine/shoppingcart

    public function index()
    {
        //Cart::instance('cart')->store('username');
        //Cart::instance('cart')->restore('username');

        return view('shoppingCart.index');
    }//end method

    public function add_to_cart(Request $request)
    {
        //make validation
        if ($request->has('id')) 
        {
            $id = $request->input('id');
            $price = $request->input('price');
            $name = $request->input('name');
            $stock = $request->input('stock');

            //check stock have or not
            if($stock <= 0)
            {
                return redirect()->back()->with('error', 'Item do not have stock !!!.');
            }

            //check it already in cart or not
            foreach (Cart::content() as $row )
            {
                if($row->id == $id)
                {
                    return redirect()->back()->with('error', 'Item added already in cart !!!.');
                }
            }

            //add to cart
            Cart::add($id, $name, 1, $price);


            return redirect()->back()->with('success', 'Item added to cart.');

        }

        return redirect()->back()->with('error', 'Item added have a problem.');

    }//end method

    public function cart()
    {
        return view('shoppingCart.cart');
    }//end method

    public function shoppingCart_remove(Request $request)
    {
        if($request->has('rowid'))
        {
            $rowId = $request->input('rowid');

            Cart::remove($rowId);

            return redirect()->back()->with('success', 'Product removed from cart.');
        }

        return redirect()->back()->with('error', 'Item remove have a problem.');
    }//end method

    public function shoppingCart_edit(Request $request)
    {
        if($request->has('id'))
        {
            if($request->input('qty') > 0)//enter not less zero
            {
                $id = $request->input('id');
                $quantity = $request->input('qty');

                $rowId = $request->input('rowid');
                Cart::update($rowId, $quantity); // Will update the quantity
                return redirect()->back()->with('success', 'finish.');
                
                /*
                $products = products::where('id',$id)->first();
                if($products->quantity >= $quantity)
                {
                }
                return redirect()->back()->with('error', 'quantity enter not enough stock!!!');
                */
            }
            return redirect()->back()->with('error', 'quantity cannot negetif added have a problem!!!');
        }

        return redirect()->back()->with('error', 'Item added have a problem.');
    }//emd method

    public function shoppingCart_remove_all(Request $request)
    {
        Cart::destroy();
        return redirect()->back()->with('success', 'Product removed all from cart.');
    }//end method

    public function shoppingCart_checkout()
    {
        return view('shoppingCart.checkout');
    }//end method

    public function shoppingCart_checkout_post(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email',
            'name' => 'required|string',
            'phone' => 'required|numeric|starts_with:01',
            'address' => 'required',
            'total' => 'required|numeric',
            ]);

            $i = 0;
            foreach (Cart::content() as $row) {
                $i = $loop->iteration;
            }

            if(!$i >= 1)
            {
                return redirect()->back()->with('error', 'no Item was add.');
            }

            //process get billcode payment here 

            //store to database 

            //jump to payment link


    }//end method

}//end class
