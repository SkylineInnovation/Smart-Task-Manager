<?php

namespace Database\Seeders;

use App\Models\Role;
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
        try {
            $owner = Role::where('name', 'owner')->first();

            if (!$owner)
                $owner = Role::create([
                    'name' => 'owner',
                    'display_name' => 'Project Owner', // optional
                    'description' => 'User is the owner of a given project', // optional
                ]);

            $mhamad = User::where('email', 'mohammadawwad22@gmail.com')->first();

            if (!$mhamad)
                $mhamad = User::create([
                    "user_name" => "mhamad22",
                    "first_name" => "Mhamad",
                    "last_name" => "Awwad",
                    "email" => "mohammadawwad22@gmail.com",
                    "phone" => "+962782562016",
                    "password" => Hash::make("Ma@147532968"),
                    "language" => "en",
                ]);

            $mhamad->attachRole($owner);
            // parameter can be a Role object, array, id or the role string name
        } catch (\Throwable $th) {
        }
    }
}
