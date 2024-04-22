<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\LevelAccount;

class ResetViewsSearchLimit extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reset:views-search-limit';
    
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Reset views search limit every day';
    
    public function __construct()
    {
        parent::__construct();
    }


    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $account_hr = LevelAccount::all();
        foreach($account_hr as $account){
            $account->used_views = 0;
            $account->used_search = 0;
            $account->save();
        }
        return response()->json(['data'=>'success']);
        
    }
}
