<?php

namespace App\Http\Controllers;

use App\Models\Special;
use App\Models\User;
use Hekmatinasser\Verta\Verta;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\Auth;

class specialController extends Controller
{
    public function index($msg=''){
        $allspecial=Special::with('user')->paginate(5);
        return view('pages.special.table',['msg'=>$msg,'specials'=>$allspecial]);
    }
    public function create($msg=''){

        return view('pages.special.form',['msg'=>$msg]);
    }

    public function store(Request $request){
        $validated = $request->validate([
            'user_id'=>'required|exists:users,id',
            'mehmani' => 'required|in:0,1,2,3',
            'tedad' => 'required|numeric',
            'date' => 'required|jdate:Y/m/d',
            'ash' => 'required|numeric',
            'ghorme' => 'required|numeric',
            'bastani' => 'required|numeric',
            'ab' => 'required|numeric',
            'kashk' => 'required|numeric',
            'kabab' => 'required|numeric',
            'jelle' => 'required|numeric',
            'dough' => 'required|numeric',
            'dolme' => 'required|numeric',
            'gosht' => 'required|numeric',
            'poding' => 'required|numeric',
            'noshabeh' => 'required|numeric',
            'mazeh' => 'required|numeric',
            'koofteh' => 'required|numeric',
            'shaik' => 'required|numeric',
            'delester' => 'required|numeric',

        ]);
        try {
            $sp=new Special();
            $sp->user_id=$request->input('user_id');
            $sp->mehmani=$request->input('mehmani');
            $sp->tedad=$request->input('tedad');
            $shamsidate=Verta::parse($request->input('date'));
            $sp->date=$shamsidate->datetime();
            $sp->ash=$request->input('ash');
            $sp->ghorme=$request->input('ghorme');
            $sp->bastani=$request->input('bastani');
            $sp->ab=$request->input('ab');
            $sp->kashk=$request->input('kashk');
            $sp->kabab=$request->input('kabab');
            $sp->jelle=$request->input('jelle');
            $sp->dough=$request->input('dough');
            $sp->dolme=$request->input('dolme');
            $sp->gosht=$request->input('gosht');
            $sp->poding=$request->input('poding');
            $sp->noshabeh=$request->input('noshabeh');
            $sp->mazeh=$request->input('mazeh');
            $sp->koofteh=$request->input('koofteh');
            $sp->shaik=$request->input('shaik');
            $sp->delester=$request->input('delester');
            $sp->save();
            return $this->create('<div class="alert alert-success">'.'ثبت با موققییت انجام شد'.'</div>');
        }
        catch (Exception $ex){
            return $this->create('<div class="alert alert-danger">'.'ثبت انجام نشد'.'</div>'.$ex->getMessage());
        }
    }
}
