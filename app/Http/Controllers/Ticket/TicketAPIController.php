<?php

namespace App\Http\Controllers\Ticket;
use App\Models\Ticket\Ticket;
use Illuminate\Http\Request;
use DB;
use Validator;
use App\Models\Ticket\Status;
use App\Models\UserMaster\UserRole;
class TicketAPIController 
{
    public function index(Request $request)
    {
		if(isset($request->flag) && $request->flag==1)
		{
			 $request=$request->all();
		}else
		{
			$request = json_decode($request->getContent(), true);
		}
        
        $user=UserRole::with('role')->where('user_id',$request['user_id'])->first();
        if($user->role[0])
        {
            $role=strtolower($user->role[0]->name);
        }
        if($role == 'admin' || $role =='admins')
        {
            $data=Ticket::where('status',1)->get();
        }
        else
        {
            $data=Ticket::where('status',1)->where('user_id',$request['user_id'])->get();
        }
        return response()->json(
        [
            'status' => 'success',
            'code' => '200',
            'data' =>  $data,
        ]);
    }
    public function edit($id)
    {
        $data=Ticket::where('id',$id)->where('status',1)->first();
        return response()->json(
        [
            'status' => 'success',
            'code' => '200',
            'data' =>  $data,
        ]);
    }
    public function update(Request $request)
    {
        if(isset($request->flag) && $request->flag==1)
		{
			 $request=$request->all();
		}else
		{
			$request = json_decode($request->getContent(), true);
		}
        $validator = Validator::make($request, [
        'title'     => 'required',
        'description'=>'required',
        'ticket_type_id'     => 'integer',
        'id'     => 'integer|exists:tickets,id',
        ],[
        'title.required' => 'Ticket Title is required!',
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
        if(!isset($request['ticket_type_id']))
        {
            $status=Status::where('name','pending')->first();
            if(!$status)
            {
                $status=Status::where('name','Pending')->first();
            }
            if(!$status)
            {
                $status=Status::first();
            }
            $request['ticket_status_id']=isset($status->id)?$status->id:null;

        }
        Ticket::updateOrCreate($match,$request);
        return response()->json(
        [
            'status' => 'success',
            'code' => '200',
            'message' => 'Successfully Ticket '.(isset($request['id'])?'Update':'Create').'..!',
            
        ]);
    }
    public function delete(Request $request)
    {
        if(isset($request->flag) && $request->flag==1)
		{
			 $request=$request->all();
		}else
		{
			$request = json_decode($request->getContent(), true);
		}
        $validator = Validator::make($request, [
        'id'     => 'required|integer|exists:tickets,id',
        ],[
        'id.required' => 'Ticket Id is required!',
        ]);
        if ($validator->fails()) {
            return response()->json(
                [
                    'error'  => $validator->errors(),
                    'status' => 'failure',
                    'code'   => '401',
                ]);
        }
        Ticket::where('id',$request['id'])->update(['status'=>0]);
        return response()->json(
        [
            'status' => 'success',
            'code' => '200',
            'message' => 'Successfully Ticket Type Delete'
        ]);
    }
     
}
