<?php

use Illuminate\Database\Seeder;

class AdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('admin_users')->insert([
            'name' => 'admin', 'password' => bcrypt('123456'), 'created_at' => now(), 'updated_at' => now(),
        ]);
    }
}
