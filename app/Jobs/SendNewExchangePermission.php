<?php

namespace App\Jobs;

use App\Mail\Exchange\NewExchangeRequest;
use App\Models\ExchangePermission;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendNewExchangePermission implements ShouldQueue
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
            Mail::to($owners)->send(new NewExchangeRequest($this->exchange, 'owner'));

        // 
        $financials = User::whereRoleIs('financial')->get();
        if (env('SEND_MAIL', false)) {
            foreach ($financials as $financial) {
                Mail::to($financial->email)->send(new NewExchangeRequest($this->exchange, 'financial', $financial->id));
            }
        }

        // 
        $technicals = User::whereRoleIs('technical')->get();
        if (env('SEND_MAIL', false)) {
            foreach ($technicals as $technical) {
                Mail::to($technical->email)->send(new NewExchangeRequest($this->exchange, 'technical', $technical->id));
            }
        }
    }
}
