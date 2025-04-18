<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            ['name' => 'superadmin'],
            ['name' => 'tester'],
            ['name' => 'developer'],
            ['name' => 'admin'],
            ['name' => 'manager'],
            ['name' => 'staff'],
        ];

        foreach ($roles as $role) {
            Role::firstOrCreate($role);
        }

        // Assign roles to specific users if needed
        $this->assignRolesToUsers();
    }

    protected function assignRolesToUsers(): void
    {
        $users = [
            'superadmin@forexbackoffice.com' => 'superadmin',
            'tester@forexbackoffice.com' => 'tester',
            'developer@forexbackoffice.com' => 'developer',
            'admin@forexbackoffice.com' => 'admin',
            'manager@forexbackoffice.com' => 'manager',
            'staff@forexbackoffice.com' => 'staff',
        ];

        foreach ($users as $email => $roleName) {
            $user = User::where('email', $email)->first();
            if ($user) {
                $user->assignRole($roleName);
            }
        }
    }
}
