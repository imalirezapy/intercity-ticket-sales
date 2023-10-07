<?php

namespace App\Domains\Auth\Jobs;

use Illuminate\Support\Facades\Auth;
use Lucid\Units\Job;

class AttemptCredentialsJob extends Job
{
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * attempt user credentials
     *
     */
    public function handle(string $email, string $password): bool
    {
        return Auth::attempt(['email' => $email, 'password' => $password]);
    }
}
