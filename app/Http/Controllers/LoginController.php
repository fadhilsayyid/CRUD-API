<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\User;
use Auth;

class LoginController extends Controller
{
    
    public function getUser()
    {
        $data = User::all();
        return response()->json(["status"=>"success","result"=>$data]);
    }

    public function addUser(Request $req)
    {
        $input = $req->all();
        $input["password"] = bcrypt($input["password"]);
        $data = User::create($input);
        return response()->json(["status"=>"success","result"=>$data]);
    }

    public function login(Request $req){
        $input = $req->all();
        if(Auth::attempt($input)){
            $user = Auth::user();
            $user->token = $user->createToken('crudapi')->accessToken;
            return response()->json(["status"=>"success","result"=>$user]);
        }else{
            return response()->json(["status"=>"error","result"=>[],"message"=>"invalid credential"]);
        }
    }

    public function profile(){
        $user = Auth::user();
        return response()->json(["status"=>"success","result"=>$user]);
    }

    public function delete($id){
        User::find($id)->delete();
        return response()->json(["status"=>"success","result"=>[],"message"=>"delete successfully"]);
    }

    public function importForm(){
        return view('import-form');
    }
}
