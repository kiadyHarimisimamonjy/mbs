<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class CreateUserCounterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $user = User::create([
            'name' => 'Sonerana',
            'email' => 'sonerana@gmail.com',
            'password' => bcrypt('sonerana')
        ]);
        $userToamasina = User::create([
            'name' => 'Toamasina',
            'email' => 'toamasina@gmail.com',
            'password' => bcrypt('toamasina')
        ]);
        $userstmarie = User::create([
            'name' => 'St marie',
            'email' => 'stmarie@gmail.com',
            'password' => bcrypt('stmarie')
        ]);

        $role = Role::create(['name' => 'counter']);

        $permissions = Permission::pluck('id','id')->all();

        $role->syncPermissions($permissions);

        $user->assignRole([$role->id]);
        $userToamasina->assignRole([$role->id]);
        $userstmarie->assignRole([$role->id]);
    }
}
