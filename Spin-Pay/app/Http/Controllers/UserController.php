<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use App\Models\Users;
use Illuminate\Support\Facades\Hash;
use App\Models\UserData;
use App\Models\UserDocument;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

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

    public function userdata(Request $request,$id){


            $validator = Validator::make($request->all(), [
                'address_line' => 'required',
                'city' => 'required',
                'state' => 'required',
                'age' => 'required',
                'gender' => 'required',
                'dob' => 'required',
                'image' => 'required'
                ]);

                if($validator->fails()) {
                    $flag = false;
                    return $data['message']['statusText'] = "Validation Failed ".$validator->errors();
                    } else {
                            $user= new UserData();
                            $user->user_id= $request['id'];
                            $user->address_line= $request['address_line'];
                            $user->city= $request['city'];
                            $user->state= $request['state'];
                            $user->age= $request['age'];
                            $user->gender= $request['gender'];
                            $user->dob= $request['dob'];
                            $user->image= $request['image'];
                            $user->save();
                            return "Success";
                           }
    }
    public function pancard(Request $request){
        $validate=Validator::make($request->all(),[
            'user_id'=> 'required',
            'master_document_id' => 'required',
            'document_number' => 'required',
            'pan_img' => 'required'
        ]);
        
        $user_doc=new UserDocument();
        if($validate->fails()){
            $flag=false;
            return response()->json([
                'message' => $validate->errors(),
                "status" => 400
            ]);
        }
        else{
            $size=$request->file('pan_img')->getsize();
            if($size > 7000000){
                return response()->json([
                    "message" => "image size should be less than 100kb",
                    "status" => 400
                ]);
            }
        }

        try{
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
                $path = $request->file('pan_img')->store('public/images/pan_images');
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

    public function checkDocs(Request $request){
        $userdoc = new UserDocument();
        // // $reqid=$request['id'];
        // $docs = $userdoc
        //         ->where('user_id',$request['id'])
        //         ->wherein('master_document_id',function($query){
        //             $query->select('master_document_id')
        //                   ->from(with(new UserDocument)->getTable())
        //                   ->where('user_id','2');
        //         })
        //         ->first();
        // return $docs;

        return $userdoc->select('master_document_id')
                        ->where('master_document_id',['1','2','3','4'])
                        ->where('user_id',$request['id'])->get();
    }
}
