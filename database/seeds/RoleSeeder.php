<?php

use Illuminate\Database\Seeder;
use App\Models\UserMaster\Role;
class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data=[
            ['name'=>'admin'],
            ['name'=>'manager'],
        ];
        Role::insert($data);
    }
}
