<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Wallet;


class UpdateUserRole extends Command
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:tradeprice';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update Live price for all trade pair';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }
    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        try {

            $users = User::where(['email_verify' => 1, 'status' => 1])->get();
            foreach ($users as $user) {

                $balinUSD = Wallet::where(['currency' => 'USDT'])->first();

                $rolesetting = RoleSetting::whereIn('role', ['Base1', 'Base2', 'Base3', 'Default'])->get()->keyBy('role');

                switch (true) {

                    case ($balinUSD >= $rolesetting['Base1']):
                        $role = "Base1";
                        break;

                    case ($balinUSD >= $rolesetting['Base2']):
                        $role = "Base2";
                        break;

                    case ($balinUSD >= $rolesetting['Base3']):
                        $role = "Base3";
                        break;
                        
                    default:
                        $role = "Default";
                        break;

                }

                $user->fee_role = $role;
                $user->save();
            }

        } catch (\Exception $e) {

        }
        $this->info('Trade Price update successfully');
    }
}
