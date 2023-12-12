<?php

namespace App\Http\Controllers;
use App\Models\Promotion;
use Illuminate\Http\Request;
use carbon\carbon;
use DB;
use Illuminate\Support\Str;
use Validator;
class PromotionAPIController extends Controller
{
    public function index()
    {
        $data=Promotion::get()->toArray();
        return response()->json(
        [
            'status' => 'success',
            'code' => '200',
            'path'=>config('app.url').'/promotion/',
            'data' =>  $data,
        ]);
    }
    public function store(Request $request)
    {
    //$request = json_decode($request->getContent(), true);
        $validator = Validator::make($request->all(), [
        'image'     => 'required',
        ],[
        'image.required' => 'Image is required!',
        ]);
        if ($validator->fails()) {
            return response()->json(
                [
                    'error'  => $validator->errors(),
                    'status' => 'failure',
                    'code'   => '401',
                ]);
        }
        $imageName = time().'.'.$request->image->extension();  
        $request->image->move(public_path('promotions'), $imageName);
        $data=[
            'image'=>$imageName
        ];
        // dd($data);
        Promotion::create($data);
        return response()->json(
        [
            'status' => 'success',
            'code' => '200',
            'message' => 'Successfully Add Promotion image ..!',
            
        ]);
    }
    public function edit(Request $request)
    {
        //$request = json_decode($request->getContent(), true);
        $validator = Validator::make($request->all(), [
        'image'     => 'required',
        'id' => 'required',
        ],[
        'image.required' => 'Image is required!',
        ]);
        if ($validator->fails()) {
            return response()->json(
                [
                    'error'  => $validator->errors(),
                    'status' => 'failure',
                    'code'   => '401',
                ]);
        }
        $imageName = time().'.'.$request->image->extension();  
        $request->image->move(public_path('promotions'), $imageName);
        $data=[
            'image'=>$imageName
        ];
        Promotion::where('id',$request->id)->update($data);
        return response()->json(
        [
            'status' => 'success',
            'code' => '200',
            'message' => 'Successfully Update Promotion Image  ..!',
            
        ]);
    }
    public function delete(Request $request)
    {
        //$request = json_decode($request->getContent(), true);
        $validator = Validator::make($request->all(), [
        'id'     => 'required|integer',
        ],[
        'id.required' => 'Id is required!',
        ]);
        if ($validator->fails()) {
            return response()->json(
                [
                    'error'  => $validator->errors(),
                    'status' => 'failure',
                    'code'   => '401',
                ]);
        }
        Promotion::where('id',$request['id'])->delete();
        return response()->json(
        [
            'status' => 'success',
            'code' => '200',
            'message' => 'Successfully Promotion Image Delete'
        ]);
    }
}