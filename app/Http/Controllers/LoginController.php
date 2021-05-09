<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\models\User;
use Illuminate\Support\Facades\Validator;
use Excel;
use App\Imports\UserImport;
use Illuminate\Support\Facades\DB;

class LoginController extends Controller
{
    
    public function getUser()
    {
        $data = User::all();
        return response()->json(["status"=>"success","result"=>$data]);
    }

    public function addUser(Request $req)
    {
        $validator = Validator::make($req->all(), [
            'name'=>'required',
            'email'=>'required|email',
            'password'=>'required',
            'c_password'=>'required|same:password',
        ]);
        if($validator->fails()){
            return response()->json($validator->errors(), 202);
        }
        
        $input = $req->all();
        $input["password"] = bcrypt($input["password"]);
        $user = User::create($input);
        $resArr = [];
        $resArr['token']=$user->createToken('api-application')->accessToken;
        $resArr['name']=$user->name;
        return response()->json([$resArr, 200]);
    }

    public function login(Request $req){
        $input = $req->all();
        if(Auth::attempt([
            'email'=>$req->email,
            'password'=>$req->password
        ])){
            $user = Auth::user();
            $resArr = [];
            $resArr['token']=$user->createToken('api-application')->accessToken;
            $resArr['name']=$user->name;
            
            return response()->json([$resArr, 200]);
        }else{
            return response()->json(['error'=>'Unauthorized Access']);
        }
    }

    public function store(StorePostRequest $request){
        $validated = $request->validated();
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

    public function import(Request $request){
        $file = $request->file('file')->store('import');
        (new UserImport)->import($file);
        return back()->withStatus('Record are imported successfully!');
    }

    public function userList(Request $request){
        $users = DB::table('users')->paginate(3);
        return view('userList', ['users'=>$users]);
    }
}
