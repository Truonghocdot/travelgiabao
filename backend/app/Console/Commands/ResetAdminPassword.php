<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ResetAdminPassword extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:reset-admin-password {password? : The new password for the admin}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Reset the password for the admin account (admin@giabaotravel.com)';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $email = 'admin@giabaotravel.com';
        $user = \App\Models\User::where('email', $email)->first();

        if (!$user) {
            $this->error("User not found: {$email}. Please run migrations and seeders first.");
            return 1;
        }

        $newPassword = $this->argument('password');

        if (!$newPassword) {
            $newPassword = $this->secret('Please enter the new password for Admin');

            if (!$newPassword) {
                $this->error('Password cannot be empty.');
                return 1;
            }

            $confirmPassword = $this->secret('Please confirm the new password');

            if ($newPassword !== $confirmPassword) {
                $this->error('Passwords do not match.');
                return 1;
            }
        }

        $user->password = \Illuminate\Support\Facades\Hash::make($newPassword);
        $user->save();

        $this->info("Successfully reset password for {$email}");
        return 0;
    }
}
