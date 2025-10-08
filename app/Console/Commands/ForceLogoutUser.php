<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class ForceLogoutUser extends Command
{
    protected $signature = 'user:logout {userId}';
    protected $description = 'Force logout a user by deleting their sessions';

    public function handle()
    {
        $userId = $this->argument('userId');

        $deleted = DB::table('sessions')->where('user_id', $userId)->delete();

        $this->info("User $userId has been logged out. ($deleted session(s) deleted)");
    }
}
