<?php

use Illuminate\Database\Seeder;
use App\Models\UserMaster\Module;
class ModuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data=[
            ['name'=>'user'],
            ['name'=>'role'],
            ['name'=>'permision'],
            ['name'=>'skills'],
            ['name'=>'skillstype'],
            ['name'=>'permisionassign'],
            ['name'=>'ticketstatus'],
            ['name'=>'tickettype'],
            ['name'=>'ticket'],
            ['name'=>'ticketAssign'],
        ];
        foreach($data as $key=>$value)
        {
            Module::updateOrCreate($value,$value);
        }
    }
}
