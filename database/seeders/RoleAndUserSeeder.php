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
        $kepalaSekolah   = Role::firstOrCreate(['name' => 'kepala_sekolah']);
        $adminKantor     = Role::firstOrCreate(['name' => 'admin_kantor']);

        // Buat user default super admin
        $user = User::firstOrCreate(
            ['email' => 'superadmin@spk.com'],
            [
                'name'     => 'Super Admin',
                'password' => Hash::make('password'),
            ]
        );
        $user->assignRole($superAdmin);

        // Buat user kepala sekolah
        $ks = User::firstOrCreate(
            ['email' => 'kepala@spk.com'],
            [
                'name'     => 'Kepala Sekolah',
                'password' => Hash::make('password'),
            ]
        );
        $ks->assignRole($kepalaSekolah);

        // Buat user admin kantor
        $admin = User::firstOrCreate(
            ['email' => 'admin@spk.com'],
            [
                'name'     => 'Admin Kantor',
                'password' => Hash::make('password'),
            ]
        );
        $admin->assignRole($adminKantor);
    }
}
