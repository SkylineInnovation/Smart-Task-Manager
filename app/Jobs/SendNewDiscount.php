<?php

namespace App\Jobs;

use App\Mail\Discount\SendNewDiscountToTeam;
use App\Models\Discount;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendNewDiscount implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public Discount $discount;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Discount $discount)
    {
        $this->discount = $discount;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Mail::to(
            $this->discount->task->manager->email
        )->send(new SendNewDiscountToTeam($this->discount));

        // Mail::to(
        //     $this->discount->task->employees->pluck('email')->toArray()
        // )->send(new SendNewDiscountToTeam($this->discount));
    }
}
