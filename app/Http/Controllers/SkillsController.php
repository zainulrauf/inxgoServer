<?php

namespace App\Http\Controllers;
use App\Models\Skills;
use App\Models\SkillsType;
use Illuminate\Http\Request;
use carbon\carbon;
use DB;
use Schema;
use Validator;
class SkillsController extends Controller
{
    public function index()
    {
//where('IsActive',1)
       $data=Skills::where('IsActive',1)->orderby('id','Desc')->get()->toArray();
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
    	$data=[
    		'Title'=>$request['title'],
    		'ServiceTypeId'=>$request['serviceTypeId'],
    		'PhotoPath'=>$request['photo']['dbUrl'],
    		'UpdatedDate'=>carbon::now(),
    		'IsActive'=>$request['active'],
    	];
    	Skills::where('Id',$request['id'])->update($data);
    	return response()->json(
        [
            'status' => 'success',
            'code' => '200',
            'message' => 'Successfully Skills Update...!',
        ]);
    }
    public function delete(Request $request)
    {
        $request = json_decode($request->getContent(), true);
        $validator = Validator::make($request, [
        'id'     => 'required|integer|exists:Skill,Id',
        ],[
        'id.required' => 'Skill Id is required!',
        ]);
        if ($validator->fails()) {
            return response()->json(
                [
                    'error'  => $validator->errors(),
                    'status' => 'failure',
                    'code'   => '401',
                ]);
        }
        $data=Skills::where('Id',$request['id'])->first()->toArray();
        //$data['SkillId']=$data['Id'];
        unset($data['Id']);
        DB::table('Skill_Log')->insert($data);
        Skills::where('id',$request['id'])->update(['IsActive'=>0]);
        return response()->json(
        [
            'status' => 'success',
            'code' => '200',
            'message' => 'Successfully Skill Delete'
        ]);
    }
}