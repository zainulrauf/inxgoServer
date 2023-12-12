<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\SkillsType;
use carbon\carbon;
use DB;
use Validator;
class SkillsTypeController extends Controller
{
    public function delete(Request $request)
    {
        $request = json_decode($request->getContent(), true);
        $validator = Validator::make($request, [
        'id'     => 'required|integer|exists:ServiceType,Id',
        ],[
        'id.required' => 'Service Type Id is required!',
        ]);
        if ($validator->fails()) {
            return response()->json(
                [
                    'error'  => $validator->errors(),
                    'status' => 'failure',
                    'code'   => '401',
                ]);
        }
        $data=SkillsType::where('Id',$request['id'])->first()->toArray();
        //$data['ServiceTypeId']=$data['Id'];
        unset($data['Id']);
        DB::table('ServiceType_Log')->insert($data);
       	SkillsType::where('id',$request['id'])->update(['IsActive'=>0]);
        return response()->json(
        [
            'status' => 'success',
            'code' => '200',
            'message' => 'Successfully Service Type Delete..!'
        ]);
    }
}