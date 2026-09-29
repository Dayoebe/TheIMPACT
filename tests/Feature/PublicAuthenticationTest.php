<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class PublicAuthenticationTest extends TestCase
{
    use RefreshDatabase;

    public function test_public_navigation_shows_login_and_registration_to_guests(): void
    {
        $this->get(route('home'))->assertOk()
            ->assertSee('href="'.route('login').'"', false)
            ->assertSee('href="'.route('register').'"', false);
    }

    public function test_user_can_register_as_a_member_without_dashboard_access(): void
    {
        $response = $this->post(route('register.store'), [
            'name' => 'New Member',
            'email' => 'member@example.com',
            'password' => 'purpose9638',
            'password_confirmation' => 'purpose9638',
        ]);

        $response->assertRedirect(route('home'));
        $user = User::query()->where('email', 'member@example.com')->firstOrFail();
        $this->assertFalse($user->is_super_admin);
        $this->assertAuthenticatedAs($user);
        $this->actingAs($user)->get(route('admin.dashboard'))->assertForbidden();
    }

    public function test_registered_member_can_log_in_and_is_sent_to_the_website(): void
    {
        $user = User::factory()->create(['password' => Hash::make('purpose9638')]);

        $this->post(route('login.store'), [
            'email' => $user->email,
            'password' => 'purpose9638',
        ])->assertRedirect(route('home'));

        $this->assertAuthenticatedAs($user);
    }

    public function test_administrator_using_public_login_is_sent_to_dashboard(): void
    {
        $user = User::factory()->superAdmin()->create(['password' => Hash::make('purpose9638')]);

        $this->post(route('login.store'), [
            'email' => $user->email,
            'password' => 'purpose9638',
        ])->assertRedirect(route('admin.dashboard'));

        $this->assertAuthenticatedAs($user);
    }

    public function test_authenticated_member_navigation_does_not_show_guest_actions(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)->get(route('home'))->assertOk()
            ->assertDontSee('href="'.route('register').'"', false)
            ->assertSee('action="'.route('logout').'"', false)
            ->assertDontSee('href="'.route('admin.dashboard').'"', false);
    }
}
