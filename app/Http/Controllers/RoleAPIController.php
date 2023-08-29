<?php

namespace App\Http\Controllers;
use App\Models\UserMaster\Role;
use Illuminate\Http\Request;
use DB;
use Validator;
class RoleAPIController extends Controller
{
    public function index()
    {
        $data=Role::where('status',1)->get();
        return response()->json(
        [
            'status' => 'success',
            'code' => '200',
            'data' =>  $data,
        ]);
    }
    public function edit($id)
    {
        $data=Role::where('id',$id)->where('status',1)->first();
        return response()->json(
        [
            'status' => 'success',
            'code' => '200',
            'data' =>  $data,
        ]);
    }
    public function update(Request $request)
    {
        $request = json_decode($request->getContent(), true);
        $validator = Validator::make($request, [
        'name'     => 'required',
        'id'     => 'integer|exists:roles,id',
        ],[
        'name.required' => 'Role Name is required!',
        ]);
        if ($validator->fails()) {
            return response()->json(
                [
                    'error'  => $validator->errors(),
                    'status' => 'failure',
                    'code'   => '401',
                ]);
        }
        $match=['id'=>isset($request['id'])?$request['id']:null];
        Role::updateOrCreate($match,$request);
        return response()->json(
        [
            'status' => 'success',
            'code' => '200',
            'message' => 'Successfully Role '.(isset($request['id'])?'Update':'Create').'..!',
            
        ]);
    }
    public function delete(Request $request)
    {
        $request = json_decode($request->getContent(), true);
        $validator = Validator::make($request, [
        'id'     => 'required|integer|exists:roles,id',
        ],[
        'id.required' => 'Role Id is required!',
        ]);
        if ($validator->fails()) {
            return response()->json(
                [
                    'error'  => $validator->errors(),
                    'status' => 'failure',
                    'code'   => '401',
                ]);
        }
        Role::where('id',$request['id'])->update(['status'=>0]);
        return response()->json(
        [
            'status' => 'success',
            'code' => '200',
            'message' => 'Successfully Role Delete'
        ]);
    }
     
}
