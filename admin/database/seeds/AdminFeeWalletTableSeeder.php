<?php

use Illuminate\Database\Seeder;

class AdminFeeWalletTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admin_fee_wallet')->insert(
        [
            'coinname'         => 'XRP',
            'address'      => 'r1hFJgnhVxH4tDdFhPtiBus3LrZWbGYmH',    
            'narcanru'      => 'eyJpdiI6ImZQaUZ4TVJtQjRGZ3cxbnRXNXVhaUE9PSIsInZhbHVlIjoiK29vM3dcL0ZsWG4xa1B5c0k3UnN0VjdFYzFKMnIzVFlmYm5vZ2drV0NvNGs9IiwibWFjIjoiNzI3MzI4MzgxMTU0YWQ3YjUwMjRmMmFlZTZjMzRkNzNmZDNjMGFlZjY1MWQ1MjUwZTBhNzczZThkMGQ0N2UwMCJ9',    
            'fee'      => '0.0005',    
            'created_at'    => date("Y-m-d H:i:s"),
            'updated_at'    => date("Y-m-d H:i:s")
        ]);
        DB::table('admin_fee_wallet')->insert(
        [
            'coinname'         => 'ETH',
            'address'      => '',    
            'narcanru'      => '',    
            'fee'      => '0.0010914',    
            'created_at'    => date("Y-m-d H:i:s"),
            'updated_at'    => date("Y-m-d H:i:s")
        ]);
    }
}
