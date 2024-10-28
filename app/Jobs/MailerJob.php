<?php

namespace App\Jobs;

use App\Mail\ResetPasswordMail;
use App\Mail\ValidateUser;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class MailerJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(public $data, public $mail_type)
    {
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        switch ($this->mail_type) {
            case 'validate':
                $mail = new ValidateUser($this->data);
                Mail::to($this->data)->send($mail);
                break;
            case 'reset_password':
                $mail = new ResetPasswordMail($this->data);
                Mail::to($this->data)->send($mail);
                break;
            default:
                # code...
                break;
        }
    }
}
