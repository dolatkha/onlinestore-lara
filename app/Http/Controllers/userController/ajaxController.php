<?php

namespace App\Http\Controllers\userController;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class ajaxController extends Controller
{
    public function search(Request $request){
        if ($request->input('search')){
            $products=Product::where('status','1')->where('name','like','%'.$request->input('search').'%')->get();
        }
        return response()->json($products);
    }

    public function index(Request $request){
        $sabad=Order::where('user_id',$request->input('user_id'))->get();
        $sumPrice=Order::where('user_id',$request->input('user_id'))->sum('totalprice');
        return response()->json(['sabad'=>$sabad,'sumPrice'=>$sumPrice]);
    }

    public function create(Request $request){
        $product=Product::findOrFail($request->input('product_id'));
        $order=Order::where('user_id',$request->input('user_id'))->where('product_id',$request->input('product_id'))->get();
        return response()->json(['order'=>$order,'product'=>$product]);
    }

    public function store(Request $request){
        if ($request->input('product_id')){
            $product=Product::findOrFail($request->input('product_id'));
            $validation=$request->validate([
                'user_id'=>'required|exists:users,id',
                'product_id'=>'required|exists:products,id',
            ]);
            $pr=new Order();
            $pr->loc=$product->loc;
            $pr->name=$product->name;
            $pr->price=$product->price;
            $pr->totalprice=($product->price*1);
            $pr->user_id=$request->input('user_id');
            $pr->product_id=$request->input('product_id');
            $pr->save();
            $cart=Order::where('user_id',$request->input('user_id'))->count();
            $sabad=Order::where('user_id',$request->input('user_id'))->get();
            $sumPrice=Order::where('user_id',$request->input('user_id'))->sum('totalprice');
        }
        return response()->json(['cart'=>$cart,'sabad'=>$sabad,'sumPrice'=>$sumPrice]);
    }

    public function update(Request $request){
        $pr=Order::findOrFail($request->input('item_id'));
        $pr->loc=$pr->loc;
        $pr->name=$pr->name;
        $pr->price=$pr->price;
        $pr->count=$request->input('count');
        $pr->totalprice=($pr->price*$request->input('count'));
        $pr->user_id=$pr->user_id;
        $pr->product_id=$pr->product_id;
        $pr->save();
        $sabad=Order::where('user_id',$request->input('user_id'))->get();
        $sumPrice=Order::where('user_id',$request->input('user_id'))->sum('totalprice');

        return response()->json(['sabad'=>$sabad,'sumPrice'=>$sumPrice]);
    }

    public function destroy(Request $request){
        if ($request->input('sadadID')){
            Order::destroy($request->input('sadadID'));
            $cart=Order::where('user_id',$request->input('user_id'))->count();
            $sabad=Order::where('user_id',$request->input('user_id'))->get();
            $sumPrice=Order::where('user_id',$request->input('user_id'))->sum('totalprice');
        }
        return response()->json(['cart'=>$cart,'sabad'=>$sabad,'sumPrice'=>$sumPrice]);
    }
}
