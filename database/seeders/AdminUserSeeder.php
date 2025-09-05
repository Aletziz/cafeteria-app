<?php

namespace Database\Seeders;

use App\Models\AdminUser;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Crear usuario administrador por defecto
        AdminUser::create([
            'name' => 'Administrador',
            'email' => 'admin@cafeteria.com',
            'password' => Hash::make('admin123'),
            'role' => 'super_admin',
            'active' => true,
        ]);

        // Crear gerente de cafetería
        AdminUser::create([
            'name' => 'Gerente Cafetería',
            'email' => 'gerente@cafeteria.com',
            'password' => Hash::make('gerente123'),
            'role' => 'manager',
            'active' => true,
        ]);
    }
}
