<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class RoleAndUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached roles
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Buat role
        $superAdmin      = Role::firstOrCreate(['name' => 'super_admin']);
        $pihakManajemen   = Role::firstOrCreate(['name' => 'pihak_manajemen']);

        // Buat user default super admin
        $user = User::firstOrCreate(
            ['email' => 'superadmin@gmail.com'],
            [
                'name'     => 'Super Admin',
                'password' => Hash::make('admin'),
            ]
        );
        $user->assignRole($superAdmin);

        // Buat user pihak manajemen
        $ks = User::firstOrCreate(
            ['email' => 'manajemen@gmail.com'],
            [
                'name'     => 'manajemen',
                'password' => Hash::make('password'),
            ]
        );
        $ks->assignRole($pihakManajemen);

        // Buat user admin kantor
        $admin = User::firstOrCreate(
            ['email' => 'adminkantor@gmail.com'],
            [
                'name'     => 'Admin Kantor',
                'password' => Hash::make('password'),
            ]
        );
        $admin->assignRole($pihakManajemen);
    }
}
