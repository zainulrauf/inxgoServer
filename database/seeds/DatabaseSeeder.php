<?php

use Illuminate\Database\Seeder;
use App\Models\UserMaster\Permission;
use App\Models\UserMaster\Role;
use App\Models\UserMaster\Module;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        // Role::truncate();
        // Module::truncate();
        // Permission::truncate();
        $this->call(ModuleSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(PermissionSeeder::class);
        $this->call(UserRoleSeeder::class);
        $this->call(PermissionRoleSeeder::class);
        // DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
