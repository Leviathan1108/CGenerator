<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use Carbon\Carbon;

class DeactivateInactiveUsers extends Command
{
    protected $signature = 'user:deactivate-inactive';
    protected $description = 'Menonaktifkan user yang tidak login lebih dari 6 bulan';

    public function handle()
    {
        $cutoffDate = Carbon::now()->subMonths(6);

        $inactiveUsers = User::where('last_login_at', '<', $cutoffDate)
            ->where('status', 'active')
            ->update(['status' => 'inactive']);

        $this->info("Total $inactiveUsers user telah dinonaktifkan.");
    }
}