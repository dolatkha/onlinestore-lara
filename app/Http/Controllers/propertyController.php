<?php

namespace App\Http\Controllers;

use App\Models\Property;
use Illuminate\Http\Request;
use Exception;

class propertyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($msg='')
    {
        $prop=Property::paginate(5);
        return view('pages.property.table',['msg'=>$msg,'prop'=>$prop]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($msg='')
    {
        return view('pages.property.form',['msg'=>$msg]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated=$request->validate([
            'name'=>'required|string',
            'status'=>'required|numeric|in:0,1',
            'desc'=>'nullable|string',
        ]);
        try {
            $pr=new Property();
            $pr->name=$request->input('name');
            $pr->status=$request->input('status');
            $pr->desc=$request->input('desc');
            $pr->save();
            return $this->create('<div class="alert alert-success">ثبت با موفقیت</div>');
        }catch (Exception $ex){
            return $this->create('<div class="alert alert-danger">خطا در ثبت</div>');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id,$msg='')
    {
        $prop=Property::findOrFail($id);
        return view('pages.property.form',['prop'=>$prop,'msg'=>$msg]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validated=$request->validate([
            'name'=>'required|string',
            'status'=>'required|numeric|in:0,1',
            'desc'=>'nullable|string',
        ]);
        try {
            $pr=Property::findOrFail($id);
            $pr->name=$request->input('name');
            $pr->status=$request->input('status');
            $pr->desc=$request->input('desc');
            $pr->save();
            return $this->edit($id,'<div class="alert alert-success">ثبت با موفقیت</div>');
        }catch (Exception $ex){
            return $this->edit($id,'<div class="alert alert-danger">خطا در ثبت</div>');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            Property::destroy($id);
            return $this->index('<div class="alert alert-success">حذف با موفقیت</div>');
        }catch (Exception $ex){
            return $this->index('<div class="alert alert-danger">خطا در حذف</div>');
        }
    }
}
