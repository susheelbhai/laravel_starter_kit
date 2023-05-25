<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use App\Mail\Auth\ResetPassword;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class SendPasswordResetLink implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public $data;
    public $token_url;
    public function __construct($data, $token_url)
    {
        $this->data = $data;
        $this->token_url= $token_url;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Mail::to($this->data->email)->send(new ResetPassword($this->data, $this->token_url));
    }
}
