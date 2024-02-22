<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use DB;
use App\Models\User;
/*use App\Artiststudio;
use App\Auctions;
use App\Auctionwon;
use App\Artistauction;
use App\User;
use App\Sitecontentsettings;
use App\NotificationAdminLib;
use App\Auctionfollower;
use App\Auctionbid;
use Log;
use App\Helper\mailqueuehelper;
use App\Helper\timehelper;
use App\Helper\helpers;
use App\Helper\auction;

use Carbon\Carbon;
use DateTime;*/

class InstaFollower extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:instafollower';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Reset artwork if not sold.';

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
    public function handle() {
        //dd("a");
        DB::beginTransaction();
        try {
            $raw = file_get_contents('https://www.instagram.com/being__anik'); //replace with user
            preg_match('/\"edge_followed_by\"\:\s?\{\"count\"\:\s?([0-9]+)/',$raw,$m);

            echo "<pre>";
            print_r($m);
            echo "</pre>";
            exit();


            User::where('id', 3)->update([
                'insta_followers'    => $m[1]
            ]);
            DB::commit();
            echo "followers updated successfully";
        }catch (\Exception $e) {
           DB::rollback();
          // dd($e->getMessage());
           echo "followers updat Error";
        }
        //echo "followers updated successfully";
        //Log::info("auctionreset Runs successfully");
    }



}
