<?php

namespace App\Jobs;

use App\Mail\Exchange\NewChangeExchangeRequest;
use App\Mail\Exchange\NewExchangeRequest;
use App\Mail\exchangepermissions\exchange;
use App\Models\ExchangePermission;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendNewExchangePermession implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public ExchangePermission $exchange;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(ExchangePermission $exchange)
    {
        $this->exchange = $exchange;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $owners = User::whereRoleIs('owner')->pluck('email')->toArray();

        if (env('SEND_MAIL', false))
            Mail::to($owners)->send(new NewExchangeRequest($this->exchange));

        $owners = User::whereRoleIs('owner')->pluck('email')->toArray();

        if (env('SEND_MAIL', false))
            Mail::to($owners)->send(new NewExchangeRequest($this->exchange));

        // if (env('SEND_MAIL', false))
        //     Mail::to(
        //         $this->discount->task->manager->email
        //     )->send(new SendNewDiscountToTeam($this->discount));

        // if (env('SEND_MAIL', false))
        //     Mail::to(
        //         $this->discount->user->email
        //     )->send(new SendNewDiscountToTeam($this->discount));

        // if (env('SEND_MAIL', false))
        //     Mail::to(
        //         $this->discount->task->employees->pluck('email')->toArray()
        //     )->send(new SendNewDiscountToTeam($this->discount));
    }
}
