<?php

use Illuminate\Database\Seeder;
use App\Models\UserMaster\Permission;
use App\Models\UserMaster\RolePermission;
class PermissionRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permission=Permission::where('status',1)->get();
        foreach($permission as $key=>$value)
        {
            $data=[
                ['permision_id'=>$value->id,'role_id'=>1]
            ];
            RolePermission::insert($data);
        }
    }
}
