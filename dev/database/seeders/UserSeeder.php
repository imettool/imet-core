<?php

namespace Database\Seeders;

use Auth;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use ImetCore\Models\User\Role;

class UserSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Run the database seeders.
     */
    public function run(): void
    {
        // Add administrator user
        DB::table('users')
            ->insert([
                'id' => 0,
                'first_name' => 'John',
                'last_name' => 'Smith',
                'email' => 'john.smith@email.com',
                'organisation' => 'IMET',
                'function' => 'Developer',
                'imet_role' => Role::ROLE_ADMINISTRATOR,
            ]);

        // Authenticate as administrator
        Auth::loginUsingId(0);
    }
}
