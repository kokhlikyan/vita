<?php

namespace App\Console\Commands;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class RemoveInactiveUsers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:remove-inactive-users';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Remove users with null first_name after 30 minutes of creation.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $users = User::whereNull('first_name')
            ->where('created_at', '<=', Carbon::now()->subMinutes(30))
            ->get();

        foreach ($users as $user) {
            $user->delete();
            $this->info("User ID {$user->id} removed.");
            Log::info("User ID {$user->id} removed.");
        }
        Log::info('Inactive users removed successfully.');
        $this->info('Inactive users removed successfully.');
    }
}
