<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use RuntimeException;

class SuperAdminSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $email = env('SUPER_ADMIN_EMAIL');
        $password = env('SUPER_ADMIN_PASSWORD');

        if (! is_string($email) || $email === '' || ! is_string($password) || $password === '') {
            throw new RuntimeException('SUPER_ADMIN_EMAIL and SUPER_ADMIN_PASSWORD must be provided when running this seeder.');
        }

        User::query()->updateOrCreate(
            ['email' => $email],
            [
                'name' => 'Super Administrator',
                'email_verified_at' => now(),
                'password' => Hash::make($password),
                'is_super_admin' => true,
            ],
        );
    }
}
