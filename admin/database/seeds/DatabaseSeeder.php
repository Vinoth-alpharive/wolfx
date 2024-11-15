<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         $this->call(AdminTableSeeder::class);
         $this->call(AdminbankdetailsTableSeeder::class);
         $this->call(UseraddressTableSeeder::class);
         $this->call(AdminFeeWalletTableSeeder::class);
    }
}
