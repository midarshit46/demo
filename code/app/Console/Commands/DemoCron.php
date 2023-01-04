<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Console\Command\Log;
use App\Models\Product;
use Mail;
use Auth;
use App\Mail\MyTestMail;




class DemoCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'demo:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
     * @return int
     */
    public function handle()
    {
        Mail::to('mi.darshittank@gmail.com')->send(new MyTestMail());
    }
}
