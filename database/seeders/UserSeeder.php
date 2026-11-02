<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use function Symfony\Component\String\b;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = new User();
        $user->name = "Hanif Roihan";
        $user->email= "hanif@localhost";
        $user->password= bcrypt("rahasiarahasia");
        $user->save();
    }
}
