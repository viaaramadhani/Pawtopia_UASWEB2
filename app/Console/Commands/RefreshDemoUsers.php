<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class RefreshDemoUsers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'demo:refresh-users';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Refresh the demo user accounts for quick login';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Create or update admin user
        User::updateOrCreate(
            ['email' => 'admin@pawtopia.com'],
            [
                'name' => 'Admin Pawtopia',
                'password' => Hash::make('password'),
                'role' => 'admin',
            ]
        );
        $this->info('Admin user created/refreshed: admin@pawtopia.com / password');

        // Create or update regular user
        User::updateOrCreate(
            ['email' => 'user@pawtopia.com'],
            [
                'name' => 'Regular User',
                'password' => Hash::make('password'),
                'role' => 'user',
            ]
        );
        $this->info('Regular user created/refreshed: user@pawtopia.com / password');

        return Command::SUCCESS;
    }
}
