<?php

use Illuminate\Database\Seeder;
use App\Models\UserMaster\Permission;
class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $data=[
            //User
            ['name'=>'view','display_name'=>'View','module'=>'user','module_id'=>1],
            ['name'=>'add','display_name'=>'Add','module'=>'user','module_id'=>1],
            ['name'=>'edit','display_name'=>'Edit','module'=>'user','module_id'=>1],
            ['name'=>'delete','display_name'=>'Delete','module'=>'user','module_id'=>1],
             //Role
            ['name'=>'view','display_name'=>'View','module'=>'role','module_id'=>2],
            ['name'=>'add','display_name'=>'Add','module'=>'role','module_id'=>2],
            ['name'=>'edit','display_name'=>'Edit','module'=>'role','module_id'=>2],
            ['name'=>'delete','display_name'=>'Delete','module'=>'role','module_id'=>2],
            //Permision
            ['name'=>'view','display_name'=>'View','module'=>'permision','module_id'=>3],
            ['name'=>'add','display_name'=>'Add','module'=>'permision','status'=>0,'module_id'=>3],
            ['name'=>'edit','display_name'=>'Edit','module'=>'permision','status'=>0,'module_id'=>3],
            ['name'=>'delete','display_name'=>'Delete','module'=>'permision','status'=>0,'module_id'=>3],
            //Skills
            ['name'=>'view','display_name'=>'View','module'=>'skills','module_id'=>4],
            ['name'=>'add','display_name'=>'Add','module'=>'skills','module_id'=>4],
            ['name'=>'edit','display_name'=>'Edit','module'=>'skills','module_id'=>4],
            ['name'=>'delete','display_name'=>'Delete','module'=>'skills','module_id'=>4],
            //skillstype
            ['name'=>'view','display_name'=>'View','module'=>'skillstype','module_id'=>5],
            ['name'=>'add','display_name'=>'Add','module'=>'skillstype','module_id'=>5],
            ['name'=>'edit','display_name'=>'Edit','module'=>'skillstype','module_id'=>5],
            ['name'=>'delete','display_name'=>'Delete','module'=>'skillstype','module_id'=>5],
            //PermisionAssign
            ['name'=>'view','display_name'=>'View','module'=>'PermisionAssign','status'=>0,'module_id'=>6],
            ['name'=>'add','display_name'=>'Add','module'=>'PermisionAssign','status'=>0,'module_id'=>6],
            ['name'=>'edit','display_name'=>'Edit','module'=>'PermisionAssign','module_id'=>6],
            ['name'=>'delete','display_name'=>'Delete','module'=>'PermisionAssign','status'=>0,'module_id'=>6],
            //ticketstatus
            ['name'=>'view','display_name'=>'View','module'=>'ticketstatus','status'=>1,'module_id'=>7],
            ['name'=>'add','display_name'=>'Add','module'=>'ticketstatus','status'=>1,'module_id'=>7],
            ['name'=>'edit','display_name'=>'Edit','module'=>'ticketstatus','module_id'=>7],
            ['name'=>'delete','display_name'=>'Delete','module'=>'ticketstatus','status'=>1,'module_id'=>7],
            //tickettype
            ['name'=>'view','display_name'=>'View','module'=>'tickettype','status'=>1,'module_id'=>8],
            ['name'=>'add','display_name'=>'Add','module'=>'tickettype','status'=>1,'module_id'=>8],
            ['name'=>'edit','display_name'=>'Edit','module'=>'tickettype','module_id'=>8],
            ['name'=>'delete','display_name'=>'Delete','module'=>'tickettype','status'=>1,'module_id'=>8],
            //ticket
            ['name'=>'view','display_name'=>'View','module'=>'ticket','status'=>1,'module_id'=>9],
            ['name'=>'add','display_name'=>'Add','module'=>'ticket','status'=>1,'module_id'=>9],
            ['name'=>'edit','display_name'=>'Edit','module'=>'ticket','module_id'=>9],
            ['name'=>'delete','display_name'=>'Delete','module'=>'ticket','status'=>1,'module_id'=>9],
            //ticketAsign
            ['name'=>'ticket_type','display_name'=>'Ticket Type','module'=>'ticketAssign','status'=>1,'module_id'=>10],
            ['name'=>'ticket_status','display_name'=>'Ticket Status','module'=>'ticketAssign','status'=>1,'module_id'=>10],
            ['name'=>'user','display_name'=>'User','module'=>'ticketAssign','module_id'=>10],
            ['name'=>'email','display_name'=>'Email','module'=>'ticketAssign','status'=>1,'module_id'=>10],
        ];
        foreach($data as $key=>$value)
        {
            $check=$value;
            unset($check['status']);
            Permission::updateOrCreate($check,$value);

        }
    }
}
