<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User; //this represents the users table
use Illuminate\Support\Facades\Hash; //use for hashing a password (encryption)

class AdminSeeder extends Seeder
{

    private $user;

    public function __construct(User $user){
        $this->user = $user;
    }

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->user->name = 'newtestuser';
        $this->user->email = 'newtestuser2024@gmail.com';
        $this->user->password = Hash::make('newtestuser2024'); //any password
        $this->user->role_id = User::USER_ROLE_ID; // 1 for administrator
        $this->user->save(); //insert into users table
    }
}
