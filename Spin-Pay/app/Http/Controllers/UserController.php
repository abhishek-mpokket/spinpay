<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use App\Models\Users;
use Illuminate\Support\Facades\Hash;
use App\Models\UserData;
use App\Models\UserDocument;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function store_users(Request $request){
        $validate=Validator::make($request->all(),[
            'name'=>'required',
            'email'=>'required',
            'phone'=>'required',
            'password'=>'required',
            "password_confirmation"=>"required|same:password",
            'role_id'=>'required'
        ]);

        $users=new Users();
        if($validate->fails()){
            $flag=false;
            return response()->json([
                'message' => $validate->errors(),
                "status" => 400
            ]);
        }

        
        try{
            if($users->where('email',$request['email'])->get()->first()){
                return response()->json([
                    'msg' => 'this email is already registered with us, please login.',
                    'code'=> 400,
                ]);
            }
            else{
                $users->name=$request['name'];
                $users->email=$request['email'];
                $users->phone=$request['phone'];
                $users->password=Hash::make($request['password']);
                $users->role_id=$request['role_id'];
                $ifsaved = $users->save();
                if($ifsaved == 1){
                    return response()->json([
                        'message' => 'success',
                        "status" => 200
                    ]);
                }
                else{
                    return response()->json([
                        'message' => 'data not saved',
                        "status" => 400
                    ]);
                }
            }
        }
        catch(QueryException $e){
            return response()->json([
                'message' => 'Internal Server Error',
                "status" => 500
            ]);
        }
        
        
    }


    public function pancard(Request $request){
        $validate=Validator::make($request->all(),[
            'user_id'=> 'required',
            'master_document_id' => 'required',
            'document_number' => 'required',
            'document_image' => 'required'
        ]);
        
        if($validate->fails()){
            $flag=false;
            return response()->json([
                'message' => $validate->errors(),
                "status" => 400
            ]);
        }
        else{
            $size=$request->file('document_image')->getsize();
            if($size > 2000000){
                return response()->json([
                    "message" => "image size should be less than 100kb",
                    "status" => 400
                ]);
            }
        }
        
        try{
            $user_doc=new UserDocument();
            if($user_doc->where('document_number',$request['document_number'])->get()->first()){
                return response()->json([
                    'message' => "this document number already exists",
                    'status' => 400
                ]);
            }
    
            else{
                $user_doc->user_id= $request['user_id'];
                $user_doc->master_document_id= $request['master_document_id'];
                $user_doc->document_number= $request['document_number'];
                $path = $request->file('document_image')->store('public/images/pan_images');
                $user_doc->document_image= $path;
                $ifsaved = $user_doc->save();
                if($ifsaved == 1){
                    return response()->json([
                        'message' => 'success',
                        "status" => 200
                    ]);
                }
                else{
                    return response()->json([
                        'message' => 'data not saved',
                        "status" => 400
                    ]);
                }
            }
        }
        catch(QueryException $e){
            return response()->json([
                'message' => 'Internal Server Error',
                "status" => 500
            ]);
        }
    }

}