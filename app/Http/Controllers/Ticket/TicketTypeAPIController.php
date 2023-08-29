<?php

namespace App\Http\Controllers\Ticket;
use App\Models\Ticket\Type;
use Illuminate\Http\Request;
use DB;
use Validator;
class TicketTypeAPIController 
{
    public function index()
    {
        $data=Type::where('status',1)->get();
        return response()->json(
        [
            'status' => 'success',
            'code' => '200',
            'data' =>  $data,
        ]);
    }
    public function edit($id)
    {
        $data=Type::where('id',$id)->where('status',1)->first();
        return response()->json(
        [
            'status' => 'success',
            'code' => '200',
            'data' =>  $data,
        ]);
    }
    public function update(Request $request)
    {
        // $request=$request->all();
        $request = json_decode($request->getContent(), true);
        $validator = Validator::make($request, [
        'name'     => 'required',
        'id'     => 'integer|exists:ticket_type,id',
        ],[
        'name.required' => 'Ticket Type Name is required!',
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
        Type::updateOrCreate($match,$request);
        return response()->json(
        [
            'status' => 'success',
            'code' => '200',
            'message' => 'Successfully Ticket Type '.(isset($request['id'])?'Update':'Create').'..!',
            
        ]);
    }
    public function delete(Request $request)
    {
        //$request=$request->all();
        $request = json_decode($request->getContent(), true);
        $validator = Validator::make($request, [
        'id'     => 'required|integer|exists:ticket_type,id',
        ],[
        'id.required' => 'Ticket Type Id is required!',
        ]);
        if ($validator->fails()) {
            return response()->json(
                [
                    'error'  => $validator->errors(),
                    'status' => 'failure',
                    'code'   => '401',
                ]);
        }
        Type::where('id',$request['id'])->update(['status'=>0]);
        return response()->json(
        [
            'status' => 'success',
            'code' => '200',
            'message' => 'Successfully Ticket Type Delete'
        ]);
    }
     
}
