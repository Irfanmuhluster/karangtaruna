<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $user = User::create([
                'name' => 'Irvan',
                'email'  => 'admin@blossom.com',
                'password' => bcrypt('admin123')
        ]);

        $user->assignRole('admin');
    }
}
