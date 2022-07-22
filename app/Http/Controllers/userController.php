<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;

class userController extends Controller
{
    public function index($msg=''){
        $users=User::paginate(5);
        return view('pages.user.table',['users'=>$users,'msg'=>$msg]);
    }

    public function create($msg=''){
        return view('pages.user.form',['msg'=>$msg]);
    }

    public function store(Request $request){
        $validation=$request->validate([
            'name'=>'required|string|min:3|unique:users',
            'email'=>'required|email',
            'typeUser'=>'required|numeric',
            'password'=>['required', 'confirmed', 'min:8'],
            'password_confirmation'=>'required|same:password|min:8',
        ]);
        try {
            $us=new User();
            $us->name=$request->input('name');
            $us->email=$request->input('email');
            $us->typeUser=$request->input('typeUser');
            $us->password=Hash::make($request->input('password'));
            $us->save();
            return $this->create('<div class="alert alert-success">ثبت با موققیت انجام شد</div>');
        }catch (Exception $ex){
            return $this->create('<div class="alert alert-danger">خطا در ثبت</div>'.$ex->getMessage());
        }
    }

    public function destroy(Request $request){
        $user=User::findOrFail($request->input('row'));
        try {
            User::destroy($user->id);
            return $this->index('<div class="alert alert-success">حذف با موققیت انجام شد</div>');
        }catch (Exception $ex){
            return $this->index('<div class="alert alert-danger">خطا در حذف</div>');
        }
    }
}
