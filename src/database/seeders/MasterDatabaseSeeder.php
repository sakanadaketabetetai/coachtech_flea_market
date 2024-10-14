<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;
use App\Models\Profile;

class MasterDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $president = User::create([
            'name'=> '社長',
            'email'=> 'test1@example.com',
            'password'=> bcrypt('president12345'),
        ]);

        Profile::create([
            'user_id' => $president->id
        ]);

        

        $gest = User::create([
            'name'=> '社員1',
            'email'=> 'test2@example.com',
            'password'=> bcrypt('gest12345'),
        ]);

        Profile::create([
            'user_id' => $gest->id
        ]);

        //admin Roleを作成
        $adminRole = Role::create(['name' => 'admin']);

        //権限を作成
        $registerPermission = Permission::create(['name' => 'register']);

        //adminRoleにregister権限を付与
        $adminRole->givePermissionTo($registerPermission);

        //社長にadminを割り当て
        $president->assignRole($adminRole);
    }
}
