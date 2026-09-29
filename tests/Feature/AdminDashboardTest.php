<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminDashboardTest extends TestCase
{
    use RefreshDatabase;

    public function test_guests_are_redirected_to_the_admin_login(): void
    {
        $this->get(route('admin.dashboard'))->assertRedirect(route('admin.login'));
    }

    public function test_regular_users_cannot_access_the_dashboard(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)->get(route('admin.dashboard'))->assertForbidden();
    }

    public function test_super_administrator_can_view_the_dashboard_and_complete_menu(): void
    {
        $user = User::factory()->superAdmin()->create();

        $response = $this->actingAs($user)->get(route('admin.dashboard'))->assertOk()
            ->assertSee('Everything in one place.')
            ->assertSee('Website content')
            ->assertSee('Programmes &amp; people', false)
            ->assertSee('Engagement')
            ->assertSee('SEO &amp; social sharing', false)
            ->assertSee('Users &amp; access', false);

        foreach (config('menu.groups') as $group) {
            foreach ($group['items'] as $item) {
                $response->assertSee($item['label']);
            }
        }
    }

    public function test_placeholder_menu_items_do_not_expose_unbuilt_routes(): void
    {
        $user = User::factory()->superAdmin()->create();

        $this->actingAs($user)->get(route('admin.dashboard'))->assertOk()
            ->assertSee('href="#"', false)
            ->assertSee('aria-disabled="true"', false);
    }
}
