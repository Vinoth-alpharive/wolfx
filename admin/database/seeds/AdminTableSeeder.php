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
        DB::table('admins')->insert(
        [
            'email'         => 'superadmin@matrixchange.exchange',
            'password'      => bcrypt('admin@12345678'),   
            'google2fa_secret' => 'RKUHZMSA64X7DCOQ',    
            'google2fa_verify' => 0,       
            'created_at'    => date("Y-m-d H:i:s"),
            'updated_at'    => date("Y-m-d H:i:s")
        ]);
    }
}
