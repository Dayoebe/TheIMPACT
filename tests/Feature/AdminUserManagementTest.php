<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminUserManagementTest extends TestCase
{
    use RefreshDatabase;

    public function test_administrator_can_see_registered_users(): void
    {
        $administrator = User::factory()->superAdmin()->create();
        $member = User::factory()->create(['name' => 'Visible Member', 'email' => 'visible@example.com']);

        $this->actingAs($administrator)->get(route('admin.users.index'))->assertOk()
            ->assertSee($administrator->email)
            ->assertSee($member->email)
            ->assertSee('Make administrator');
    }

    public function test_administrator_can_grant_and_remove_another_users_access(): void
    {
        $administrator = User::factory()->superAdmin()->create();
        $member = User::factory()->create();

        $this->actingAs($administrator)->patch(route('admin.users.administrator.update', $member), [
            'is_super_admin' => true,
        ])->assertRedirect()->assertSessionHas('status');

        $this->assertTrue($member->fresh()->is_super_admin);

        $this->actingAs($administrator)->patch(route('admin.users.administrator.update', $member), [
            'is_super_admin' => false,
        ])->assertRedirect()->assertSessionHas('status');

        $this->assertFalse($member->fresh()->is_super_admin);
    }

    public function test_regular_member_cannot_view_or_change_user_access(): void
    {
        $member = User::factory()->create();
        $target = User::factory()->create();

        $this->actingAs($member)->get(route('admin.users.index'))->assertForbidden();
        $this->actingAs($member)->patch(route('admin.users.administrator.update', $target), [
            'is_super_admin' => true,
        ])->assertForbidden();

        $this->assertFalse($target->fresh()->is_super_admin);
    }

    public function test_administrator_cannot_remove_their_own_access(): void
    {
        $administrator = User::factory()->superAdmin()->create();

        $this->actingAs($administrator)->patch(route('admin.users.administrator.update', $administrator), [
            'is_super_admin' => false,
        ])->assertRedirect()->assertSessionHas('error');

        $this->assertTrue($administrator->fresh()->is_super_admin);
    }
}
