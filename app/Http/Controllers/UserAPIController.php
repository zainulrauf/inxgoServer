<?php

namespace App\Http\Controllers;
use App\Models\UserMaster\User;
use App\Models\UserMaster\Role;
use App\Models\UserMaster\Module;
use App\Models\UserMaster\Token;
use App\Models\UserMaster\UserRole;
use App\Models\Skills;
use Illuminate\Http\Request;
use App\Models\Ticket\Ticket;
use carbon\carbon;
use DB;
use Illuminate\Support\Str;
use Validator;
class UserAPIController extends Controller
{
    public function dashboard()
    {
        $users=User::count();
        $skills=Skills::where('active',1)->count();
        $tickets=Ticket::count();
        return response()->json(
        [
            'status' => 'success',
            'code' => '200',
            'users' =>  $users,
            'skills' =>  $skills,
            'tickets' =>  $tickets,
        ]);
    }
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
    public function index()
    {
        $data=User::with('role')->get()->toArray();
        return response()->json(
        [
            'status' => 'success',
            'code' => '200',
            'data' =>  $this->convert_from_latin1_to_utf8_recursively($data),
        ]);
    }
    public function update(Request $request)
    {
        $request = json_decode($request->getContent(), true);
        $validator = Validator::make($request, [
        'name'     => 'required',
        // 'password' => 'min:6',
        'email' => 'required',
        'number'     => 'required|min:11|numeric',
        'is_admin'     => 'required|integer',
        ],[
        'name.required' => 'Name is required!',
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
            'Rating'=>1,
            'IsPhNoVerified'=>1,
            'IsActive'=>1,
            "CreatedBy"=>1,
            'Name'=>$request['name'],
            'UserId'=>$request['email'],
            'PhNo'=>$request['number'],
            'IsAdmin'=>$request['is_admin'],
            'CreatedDate'=>carbon::now(),
            'UpdatedDate'=>carbon::now(),
        ];
        if($request['password'])
        {
            $data['Password']=$request['password'];
        }
        if(isset($request['id']))
        {
            User::where('Id',$request['id'])->update($data);
            $role_id=UserRole::where('user_id',$request['id'])->first();
            if($role_id)
            {
                UserRole::where('user_id',$request['id'])->update(['role_id'=>$request['role_id']]);
            }
            else
            {
                UserRole::create(['user_id'=>$request['id'],'role_id'=>$request['role_id']]);
            }
        }
        else
        {
            $data=User::create($data);
            UserRole::create(['user_id'=>$data->Id,'role_id'=>$request['role_id']]);
        }
        return response()->json(
        [
            'status' => 'success',
            'code' => '200',
            'message' => 'Successfully User '.(isset($request['id'])?'Update':'Create').'..!',
            
        ]);
    }
    public function delete(Request $request)
    {
        $request = json_decode($request->getContent(), true);
        $validator = Validator::make($request, [
        'id'     => 'required|integer',
        ],[
        'id.required' => 'User Id is required!',
        ]);
        if ($validator->fails()) {
            return response()->json(
                [
                    'error'  => $validator->errors(),
                    'status' => 'failure',
                    'code'   => '401',
                ]);
        }
        $data=User::where('id',$request['id'])->first()->toArray();
        $data['User_Id']=$data['Id'];
        unset($data['Id']);
        unset($data['AboutUser']);
        unset($data['PhotoPath']);
        unset($data['DeviceID']);
        unset($data['Longitude']);
        unset($data['Latitude']);
        unset($data['Location']);
        unset($data['IsOnline']);
        unset($data['Hour_Rate']);
        unset($data['LastActivityDateTime']);
        // dd($data);
        DB::table('User_Log')->insert($data);
        User::where('id',$request['id'])->delete();
        return response()->json(
        [
            'status' => 'success',
            'code' => '200',
            'message' => 'Successfully User Delete'
        ]);
    }
    public function login(Request $request)
    {
        //$request=$request->all();
         $request = json_decode($request->getContent(), true);
        $validator = Validator::make($request, [
            'email' => 'required',
            'password' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json(
            [
                'error'  => $validator->errors(),
                'status' => 'failure',
                'code'   => '401',
            ]);
        }
         $data=User::select('Id','Rating','Name','UserId','IsPhNoVerified','Password','PhNo','IsAdmin','IsActive')->with('role.role.permission.permisions')->where('UserId',$request['email'])->where('Password',$request['password'])->first();
        $data=$this->convert_from_latin1_to_utf8_recursively($data);
        //$token =  $data->createToken('MyApp')->accessToken; 
	$token =123;        
$custom = Str::random(10);
        Token::create(['custom'=>$custom,'laravel'=>$token,'user_id'=>$data->Id]);
        $permisions=[];
        $modules=Module::get();
        foreach($modules as $value)
        {
            $temp=[
                'view'=>false,
                'add'=>false,
                'edit'=>false,
                'delete'=>false,
            ];
            $permisions[strtolower($value->name)]=$temp;

        }
        $roles=UserRole::with('role.permission.permisions')->where('user_id',$data->Id)->get();
        foreach($roles as $key =>$value)
        {
            foreach($value->role as $key1 =>$value1)
            {
                foreach($value1->permission as $key2 =>$value2)
                {
                    $temp=[];
                    if(array_key_exists(strtolower($value2->permisions->module),$permisions))
                    {
                        $temp=$permisions[strtolower($value2->permisions->module)];
                    }
                    $temp=$permisions[strtolower($value2->permisions->module)];
                    $temp[strtolower($value2->permisions->name)]=true;
                    $permisions[strtolower($value2->permisions->module)]=$temp;
                }
            }
        }
        //$token =  $data->createToken('MyApp')->accessToken; 
        // $token = $data->createToken('API Token')->accessToken;
        return response()->json(
        [
            'status' => 'success',
            'code' => '200',
            'data' =>  $this->convert_from_latin1_to_utf8_recursively($data),
            'custom'=>$custom,
            //'token'=>$this->convert_from_latin1_to_utf8_recursively($token),
            'permisions'=>$this->convert_from_latin1_to_utf8_recursively($permisions)
        ]);
    }
    public function redirect()
    {
        return response()->json(
            [
                'error'  => 'Not Access',
                'status' => 'failure',
                'code'   => '401',
            ]);
    }
}