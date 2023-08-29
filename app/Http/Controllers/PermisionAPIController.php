<?php

namespace App\Http\Controllers;
use App\Models\UserMaster\Permission;
use Illuminate\Http\Request;
use DB;
use Validator;
class PermisionAPIController extends Controller
{
    public function index()
    {
        // where('status',1)
        $data=Permission::get()->groupBy('module');
        return response()->json(
        [
            'status' => 'success',
            'code' => '200',
            'data' =>  $data,
        ]);
    }
    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
        'name'     => 'required',
        'display_name' => 'required',
        'module'     => 'required',
        'id'     => 'integer|exists:permisions,id',
        ],[
        'name.required' => 'Permission Name is required!',
        ]);
        if ($validator->fails()) {
            return response()->json(
                [
                    'error'  => $validator->errors(),
                    'status' => 'failure',
                    'code'   => '401',
                ]);
        }
        $match=['id'=>isset($request->id)?$request->id:null];
        Permission::updateOrCreate($match,$request->all());
        return response()->json(
        [
            'status' => 'success',
            'code' => '200',
            'message' => 'Successfully Permission '.(isset($request->id)?'Update':'Create').'..!',
            
        ]);
    }
    public function delete(Request $request)
    {
        $validator = Validator::make($request->all(), [
        'id'     => 'required|integer|exists:permisions,id',
        ],[
        'id.required' => 'Permission Id is required!',
        ]);
        if ($validator->fails()) {
            return response()->json(
                [
                    'error'  => $validator->errors(),
                    'status' => 'failure',
                    'code'   => '401',
                ]);
        }
        Permission::where('id',$request->id)->update(['status'=>0]);
        return response()->json(
        [
            'status' => 'success',
            'code' => '200',
            'message' => 'Successfully Permission Delete'
        ]);
    }
     
}
