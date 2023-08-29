<?php

namespace App\Http\Controllers;
use App\Models\UserMaster\RolePermission;
use App\Models\UserMaster\UserRole;
use Illuminate\Http\Request;
use DB;
use Validator;
class PermisionRoleAPIController extends Controller
{
    public function getrolePermision($id)
    {
        $data=RolePermission::where('role_id',$id)->pluck('permision_id');
        return response()->json(
        [
            'status' => 'success',
            'code' => '200',
            'data' => $data,
            
        ]);
    }
    public function rolePermision(Request $request)
    {
        $request = json_decode($request->getContent(), true);
        $validator = Validator::make($request, [
        'role_id'     => 'required',
        'permision_id' => 'required|array',
        'permision_id.*'     => 'required',
        ],[
        'role_id.required' => 'Role ID is required!',
        ]);
        if ($validator->fails()) {
            return response()->json(
                [
                    'error'  => $validator->errors(),
                    'status' => 'failure',
                    'code'   => '401',
                ]);
        }
        $old_ids=RolePermission::where('role_id',$request['role_id'])->pluck('permision_id');
        $diff=array_diff($old_ids->toArray(),$request['permision_id']);
        foreach($request['permision_id'] as $key=>$value)
        {
        	$temp=['role_id'=>$request['role_id'],'permision_id'=>$value];
        	RolePermission::updateOrCreate($temp,$temp);
        }
        foreach($diff as $key=>$value)
        {
        	$temp=['role_id'=>$request['role_id'],'permision_id'=>$value];
        	RolePermission::where($temp)->delete();
        }
        return response()->json(
        [
            'status' => 'success',
            'code' => '200',
            'message' => 'Successfully Permision Asign to this Role..!',
            
        ]);
    }
    public function roleUser(Request $request)
    {
        $request = json_decode($request->getContent(), true);
        $validator = Validator::make($request, [
        'user_id'     => 'required',
        'role_id' => 'required|array',
        'role_id.*'     => 'required',
        ],[
        'user_id.required' => 'User ID is required!',
        ]);
        if ($validator->fails()) {
            return response()->json(
                [
                    'error'  => $validator->errors(),
                    'status' => 'failure',
                    'code'   => '401',
                ]);
        }
        $old_ids=UserRole::where('user_id',$request['user_id'])->pluck('role_id');
        $diff=array_diff($old_ids->toArray(),$request['role_id']);
        foreach($request['role_id'] as $key=>$value)
        {
        	$temp=['user_id'=>$request['user_id'],'role_id'=>$value];
        	UserRole::updateOrCreate($temp,$temp);
        }
        foreach($diff as $key=>$value)
        {
        	$temp=['user_id'=>$request['user_id'],'role_id'=>$value];
        	UserRole::where($temp)->delete();
        }
        return response()->json(
        [
            'status' => 'success',
            'code' => '200',
            'message' => 'Successfully Role Asign to this Permision..!',
            
        ]);
    }
    
     
}
