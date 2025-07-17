<?php

namespace App\Console\Commands;

use App\Http\Controllers\AmoController;
use Illuminate\Console\Command;

class TestAmo extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:test-amo';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        (new AmoController())->addContact('Jasur','+998936475203','Привет');
        //9736994
        //77582534
    }
}
