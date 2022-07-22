<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\User;
use App\Models\Product;
use Hekmatinasser\Verta\Verta;
use Illuminate\Http\Request;
use Exception;

class orderController extends Controller
{
    public function index($msg=''){
        $orders=Order::paginate(10);
        return view('pages.order.table',['orders'=>$orders,'msg'=>$msg]);
    }

    public function edit($id,$msg=''){
        $ordit=Order::findOrFail($id);
        return view('pages.order.form',['ordit'=>$ordit,'msg'=>$msg]);
    }

    public function update(Request $request,$id){
        $validation=$request->validate([
            'name'=>'required|string|min:3',
            'loc'=>'nullable|file|mimes:jpg,png|min:100|max:1024',
            'price'=>'required|numeric',
            'count'=>'required|numeric',
            'status'=>'required|in:0,1',
            'cat'=>'required|exists:categories,id',
            'start_date'=>'required|jdate:Y/m/d',
        ]);
        try {
            $pr=Product::findOrFail($id);
            $pr->name=$request->input('name');
            if($request->file('loc')){
                $path=$request->file('loc')->storeAs('public/product',$pr->id.'.'.$request->file('loc')->extension());
            }
            $pr->loc=$path;
            $pr->price=$request->input('price');
            $pr->count=$request->input('count');
            $pr->status=$request->input('status');
            $pr->category_id=$request->input('cat');
            $shamsidate=Verta::parse($request->input('start_date'));
            $pr->start_date=$shamsidate->datetime();
            $pr->save();
            return $this->edit($id,'<div class="alert alert-success">ویرایش انجام شد</div>');
        }
        catch (Exception $ex){
            return $this->edit($id,'<div class="alert alert-danger">خطا در ویرایش</div>');
        }
    }

    public function destroy(Request $request){
        try{
            $order=Order::findOrFail($request->input('row'));
            Order::destroy($order->id);
            return $this->index('<div class="alert alert-success">حذف با موفقیت انجام شد</div>');
        }catch (Exception $ex){
            return $this->index('<div class="alert alert-danger">خطا در حذف</div>');
        }
    }
}
