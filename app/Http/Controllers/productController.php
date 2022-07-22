<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Property;
use Hekmatinasser\Verta\Verta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Exception;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class productController extends Controller
{
    public  function index($msg=''){
//        $products=Product::all();
        $products=Product::with('category')->paginate(10);
//        $products=DB::table('products')->get();
//        $products=DB::table('products')->paginate(5);
        return view('pages.product.table',['products'=>$products,'msg'=>$msg]);
    }

    public function create($msg=''){
        $allcat=Category::all();
        return view('pages.product.form',['msg'=>$msg,'cats'=>$allcat]);
    }

    public function store(Request $request){
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
            DB::beginTransaction();
            $pr=new Product();
            $pr->name=$request->input('name');
            $pr->price=$request->input('price');
            $pr->count=$request->input('count');
            $pr->status=$request->input('status');
            $pr->category_id=$request->input('cat');
            $shamsidate=Verta::parse($request->input('start_date'));
            $pr->start_date=$shamsidate->datetime();
            $pr->save();
            if($request->file('loc')){
                $path=$request->file('loc')->storeAs('public/product',$pr->id.'.'.$request->file('loc')->extension());
                $pr->loc=$path;
                $pr->save();
            }
            DB::commit();
            return $this->create('<div class="alert alert-success">ثبت انجام شد</div>');
        }
        catch (Exception $ex){
            DB::rollBack();
            return $this->create('<div class="alert alert-danger">خطا در ثبت</div>');
        }
    }

    public function edit($id,$msg=''){
        $predit=Product::findOrFail($id);
        $allcats=Category::all();
        return view('pages.product.form',['predit'=>$predit,'msg'=>$msg,'cats'=>$allcats]);
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
            $pr=Product::findOrFail($request->input('row'));
            Product::destroy($pr->id);
            if($pr->loc!=null){
                Storage::delete($pr->loc);
            }
            return $this->index('<div class="alert alert-success">حذف با موفقیت انجام شد</div>');
        }catch (Exception $ex){
            return $this->index('<div class="alert alert-danger">خطا در حذف</div>');
        }
    }

    public  function indexBread(){
        $breads=Product::all()->where('category_id', '=', '1');
        return view('pages.bread',['breads'=>$breads]);
    }

    public  function indexCake(){
        $cakes=Product::all()->where('category_id', '=', '2');
        return view('pages.cake',['cakes'=>$cakes]);
    }

    public  function indexFood(){
        $foods=Product::all()->where('category_id', '=', '3');
        return view('pages.food',['foods'=>$foods]);
    }

    public function indexProperty($id,$msg=''){
        $product=Product::findOrFail($id);
//        $productwithproperties=Product::with('property')->where('id',$id)->get();

        $productwithproperties=Property::with(['product'])->whereHas('product',function($query) use($id){
            return $query->where('products.id','=',$id);
        })->paginate(4);

        return view('pages.property-pivot.table',['msg'=>$msg,'product'=>$product,'productwithproperties'=>$productwithproperties]);
    }
    public function createProperty($id,$msg=''){
        $product=Product::findOrFail($id);
        $allproperty=Property::all();
        return view('pages.property-pivot.form',['product'=>$product,'allproperty'=>$allproperty,'msg'=>$msg]);
    }
    public function storeProperty(Request $request,$id,$msg=''){
        $product=Product::findOrFail($id);
        $validated=$request->validate([
            'property'=>'required|exists:properties,id',
            'amount'=>'string|nullable',
            'unit'=>'string|nullable',
        ]);
        try {
            $propertyproduct=Property::find($request->input('property'));
            $product->property()->attach($propertyproduct->id,['amount'=>$request->input('amount'),'unit'=>$request->input('unit')]);
            return $this->createProperty($id,'<div class="alert alert-success">ثبت با موفقیت</div>');
        }catch (Exception $ex){
            if ($ex->getCode()==23000)
                return $this->createProperty($id,'<div class="alert alert-danger">این مشخصه فنی تکراری است</div>');
            else
                return $this->createProperty($id,'<div class="alert alert-danger">خطا در ثبت</div>'.$ex->getMessage());
        }
    }

    public function editProperty($id,$idPivot,$msg=''){
        $product=Product::findOrFail($id);
        $allproperty=Property::all();
        $pivot=DB::table('product_property')->select('*')->find($idPivot);
        return view('pages.property-pivot.form',['product'=>$product,'allproperty'=>$allproperty,'msg'=>$msg,'pivot'=>$pivot]);
    }

    public function updateProperty(Request $request,$id,$idPivot,$msg=''){
        $product=Product::findOrFail($id);
        $validated=$request->validate([
            'property'=>'required|exists:properties,id',
            'amount'=>'string|nullable',
            'unit'=>'string|nullable',
        ]);
        try {
            DB::table('product_property')->where('id',$idPivot)->update(['property_id'=>$request->input('property'),'amount'=>$request->input('amount'),'unit'=>$request->input('unit')]);

            return $this->editProperty($id,$idPivot,'<div class="alert alert-success">ثبت با موفقیت</div>');
        }catch (Exception $ex){
            if ($ex->getCode()==23000)
                return $this->editProperty($id,$idPivot,'<div class="alert alert-danger">این مشخصه فنی تکراری است</div>');
            else
                return $this->editProperty($id,$idPivot,'<div class="alert alert-danger">خطا در ثبت</div>'.$ex->getMessage());
        }
    }

    public function destroyProperty(Request $request,$id){
        try{
            $product=Product::findOrFail($id);
            $property=Property::findOrFail($request->input('row'));
            $product->property()->detach($property->id);
            return $this->indexProperty($id,'<div class="alert alert-success">حذف مشخصه فنی با موفقیت</div>');
        }catch (Exception $ex){
            return $this->indexProperty($id,'<div class="alert alert-danger">حذف مشخصه فنی با خطا</div>');
        }
    }
}
