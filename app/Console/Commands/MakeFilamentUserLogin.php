<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class MakeFilamentUserLogin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:make-filament-user-login';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $login = $this->ask('Login');
        $password = $this->secret('Parol');

        $user = User::create([
            'login' => $login,
            'password' => Hash::make($password),
        ]);

        $this->info("{$user->login} loginli foydalanuvchi yaratildi.");
    }
}
