<?php

namespace App\Console\Commands;

use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Console\Command;

class CheckDiscounts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'discounts:check';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check if any discounts have expired and update their status';

    // public function __construct()
    // {
    //     dd(parent::__construct());
    // }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $discounts = Product::where('final_date_off', '<=', Carbon::now('Asia/Tehran'))->where('status_off', '!=', 'none')->get();

        foreach ($discounts as $discount) {
            $discount->status_off = 'none';
            $discount->number_off = null;
            $discount->time_off = null;
            $discount->unit_time_off = null;
            $discount->final_date_off = null;
            foreach ($discount->colors as $color) {
                $color->pivot->update(['final_price' => $color->pivot->price]);
            }
            $discount->save();
        }

        $this->info('Discount statuses have been updated.');
    }
}
