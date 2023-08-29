<?php

namespace App\Http\Controllers\Ticket;
use App\Models\Ticket\Status;
use Illuminate\Http\Request;
use DB;
use Validator;
class TicketStatusAPIController
{
    public function index()
    {
        $data=Status::where('status',1)->get();
        return response()->json(
        [
            'status' => 'success',
            'code' => '200',
            'data' =>  $data,
        ]);
    }
    public function edit($id)
    {
        $data=Status::where('id',$id)->where('status',1)->first();
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
        'id'     => 'integer|exists:ticket_status,id',
        ],[
        'name.required' => 'Ticket Status Name is required!',
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
        Status::updateOrCreate($match,$request);
        return response()->json(
        [
            'status' => 'success',
            'code' => '200',
            'message' => 'Successfully Ticket Status '.(isset($request['id'])?'Update':'Create').'..!',
            
        ]);
    }
    public function delete(Request $request)
    {
        // $request=$request->all();
        $request = json_decode($request->getContent(), true);
        $validator = Validator::make($request, [
        'id'     => 'required|integer|exists:ticket_status,id',
        ],[
        'id.required' => 'Ticket Status Id is required!',
        ]);
        if ($validator->fails()) {
            return response()->json(
                [
                    'error'  => $validator->errors(),
                    'status' => 'failure',
                    'code'   => '401',
                ]);
        }
        Status::where('id',$request['id'])->update(['status'=>0]);
        return response()->json(
        [
            'status' => 'success',
            'code' => '200',
            'message' => 'Successfully Ticket Status Delete'
        ]);
    }
     
}
