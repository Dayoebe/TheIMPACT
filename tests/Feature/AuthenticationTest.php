<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class AuthenticationTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_login_screen_is_available(): void
    {
        $this->get(route('admin.login'))->assertOk()
            ->assertSee('Authorised access only')
            ->assertSee('name="email"', false)
            ->assertSee('name="password"', false);
    }

    public function test_super_administrator_can_sign_in(): void
    {
        $user = User::factory()->superAdmin()->create([
            'password' => Hash::make('secure-test-password'),
        ]);

        $this->post(route('admin.login.store'), [
            'email' => $user->email,
            'password' => 'secure-test-password',
        ])->assertRedirect(route('admin.dashboard'));

        $this->assertAuthenticatedAs($user);
    }

    public function test_regular_user_is_refused_dashboard_login(): void
    {
        $user = User::factory()->create([
            'password' => Hash::make('secure-test-password'),
        ]);

        $this->from(route('admin.login'))->post(route('admin.login.store'), [
            'email' => $user->email,
            'password' => 'secure-test-password',
        ])->assertRedirect(route('admin.login'))->assertSessionHasErrors('email');

        $this->assertGuest();
    }

    public function test_invalid_credentials_are_rejected(): void
    {
        $this->from(route('admin.login'))->post(route('admin.login.store'), [
            'email' => 'unknown@example.com',
            'password' => 'incorrect',
        ])->assertRedirect(route('admin.login'))->assertSessionHasErrors('email');

        $this->assertGuest();
    }

    public function test_super_administrator_can_sign_out(): void
    {
        $user = User::factory()->superAdmin()->create();

        $this->actingAs($user)->post(route('admin.logout'))
            ->assertRedirect(route('admin.login'));

        $this->assertGuest();
    }
}
