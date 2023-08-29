<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\SkillsType;
use carbon\carbon;
use DB;
use Validator;
use Schema;
class SkillsTypeController extends Controller
{
    public function delete(Request $request)
    {
	//$request = $request->all();
        $request = json_decode($request->getContent(), true);
        $validator = Validator::make($request, [
        'id'     => 'required|integer|exists:ServiceType,id',
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
        $data=SkillsType::where('id',$request['id'])->first()->toArray();
        //$data['ServiceTypeId']=$data['Id'];
        unset($data['Id']);
        DB::table('ServiceType_Log')->insert($data);
	//return SkillsType::where('id',$request['id'])->first();
	//Schema::disableForeignKeyConstraints();
        //DB::statement('SET FOREIGN_KEY_CHECKS=0');
        SkillsType::where('id',$request['id'])->delete();
        return response()->json(
        [
            'status' => 'success',
            'code' => '200',
            'message' => 'Successfully Service Type Delete..!'
        ]);
    }
}