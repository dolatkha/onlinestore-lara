<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Exception;

class categoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($msg='')
    {
        $cat=Category::paginate(2);
        return view('pages.category.table',['cat'=>$cat,'msg'=>$msg]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($msg='')
    {
        return view('pages.category.form',['msg'=>$msg]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validation=$request->validate([
            'name'=>'required|string|min:3',
            'status'=>'required|in:0,1',
            'description'=>'nullable|string',
        ]);
        try {
            $ca=new Category();
            $ca->title=$request->input('name');
            $ca->status=$request->input('status');
            $ca->description=$request->input('description');
            $ca->save();
            return $this->create('<div class="alert alert-success">Success submit</div>');
        }
        catch (Exception $ex){
            return $this->create('<div class="alert alert-danger">Fail in submit</div>');
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
        $cat=Category::findOrFail($id);
        return view('pages.category.form',['cat'=>$cat,'msg'=>$msg]);
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
        $validation=$request->validate([
            'name'=>'required|string|min:3',
            'status'=>'required|in:0,1',
            'description'=>'nullable|string',
        ]);
        try {
            $ca=Category::findOrFail($id);
            $ca->title=$request->input('name');
            $ca->status=$request->input('status');
            $ca->description=$request->input('description');;
            $ca->save();
            return $this->edit($id,'<div class="alert alert-success">Edit success</div>');
        }
        catch (Exception $ex){
            return $this->edit($id,'<div class="alert alert-danger">Fail in edit</div>');
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
            Category::destroy($id);
            return $this->index('<div class="alert alert-success">Delete success</div>');
        }catch (Exception $ex){
            return $this->index('<div class="alert alert-danger">Fail in delete</div>');
        }
    }
}
