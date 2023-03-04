<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
class admins extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admins=[['name'=>'admin',
    'email'=>'admin@gmail.com',
'password' => Hash::make('12345678')],];
        foreach($admins as $admin){
    Admin::create($admin);
        }
    }
}
