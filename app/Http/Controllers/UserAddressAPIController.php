<?php

namespace App\Http\Controllers;
use App\Models\UserMaster\UserAddress;
use Illuminate\Http\Request;
use carbon\carbon;
use DB;
use Illuminate\Support\Str;
use Validator;
class UserAddressAPIController extends Controller
{
    public function convert_from_latin1_to_utf8_recursively($dat)
    {
      if (is_string($dat)) {
         return utf8_encode($dat);
      } elseif (is_array($dat)) {
         $ret = [];
         foreach ($dat as $i => $d) $ret[ $i ] = self::convert_from_latin1_to_utf8_recursively($d);

         return $ret;
      } elseif (is_object($dat)) {
         foreach ($dat as $i => $d) $dat->$i = self::convert_from_latin1_to_utf8_recursively($d);

         return $dat;
      } else {
         return $dat;
      }
    }
    public function index($id)
    {
        $data=UserAddress::where('user_id',$id)->first()->toArray();
        return response()->json(
        [
            'status' => 'success',
            'code' => '200',
            'data' =>  $data,
        ]);
    }
    public function store(Request $request)
    {
        $request = json_decode($request->getContent(), true);
        $validator = Validator::make($request, [
        'user_id'     => 'required',
        // 'password' => 'min:6',
        'street' => 'required',
        'apartment'     => 'required',
        ],[
        'user_id.required' => 'User Id is required!',
        ]);
        if ($validator->fails()) {
            return response()->json(
                [
                    'error'  => $validator->errors(),
                    'status' => 'failure',
                    'code'   => '401',
                ]);
        }
        $data=[
            'user_id'=>$request['user_id'],
            'street'=>$request['street'],
            'apartment'=>$request['apartment'],
            'floor'=>isset($request['floor'])?$request['floor']:null,
        ];
        UserAddress::create($data);
        return response()->json(
        [
            'status' => 'success',
            'code' => '200',
            'message' => 'Successfully Add Address ..!',
            
        ]);
    }
    public function update($id,Request $request)
    {
        $request = json_decode($request->getContent(), true);
        $validator = Validator::make($request, [
        'user_id'     => 'required',
        // 'password' => 'min:6',
        'street' => 'required',
        'apartment'     => 'required',
        ],[
        'user_id.required' => 'User Id is required!',
        ]);
        if ($validator->fails()) {
            return response()->json(
                [
                    'error'  => $validator->errors(),
                    'status' => 'failure',
                    'code'   => '401',
                ]);
        }
        $data=[
            'user_id'=>$request['user_id'],
            'street'=>$request['street'],
            'apartment'=>$request['apartment'],
            'floor'=>isset($request['floor'])?$request['floor']:null,
        ];
        UserAddress::where('user_id',$id)->update($data);
        return response()->json(
        [
            'status' => 'success',
            'code' => '200',
            'message' => 'Successfully Update Address ..!',
            
        ]);
    }
    public function delete(Request $request)
    {
        $request = json_decode($request->getContent(), true);
        $validator = Validator::make($request, [
        'user_id'     => 'required|integer',
        ],[
        'user_id.required' => 'User Id is required!',
        ]);
        if ($validator->fails()) {
            return response()->json(
                [
                    'error'  => $validator->errors(),
                    'status' => 'failure',
                    'code'   => '401',
                ]);
        }
        UserAddress::where('id',$request['id'])->delete();
        return response()->json(
        [
            'status' => 'success',
            'code' => '200',
            'message' => 'Successfully User Delete'
        ]);
    }
}