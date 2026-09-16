<?php

namespace Tests\Feature;

use App\Livewire\HomePage;
use Livewire\Livewire;
use Tests\TestCase;

class HomePageTest extends TestCase
{
    public function test_home_page_renders_the_network_identity_and_mission(): void
    {
        $this->get(route('home'))
            ->assertOk()
            ->assertSeeLivewire(HomePage::class)
            ->assertSee('Christian Youth Leadership &amp; Public Impact Network', false)
            ->assertSee("To become Africa's leading network", false)
            ->assertSee('The IMPACT exists to identify, connect, equip, mentor and deploy')
            ->assertSee('id="mobile-navigation"', false);
    }

    public function test_home_page_includes_all_philosophy_stages_and_focus_areas(): void
    {
        Livewire::test(HomePage::class)
            ->assertSeeInOrder(['Faith', 'Leadership', 'Competence', 'Service', 'Influence', 'Transformation'])
            ->assertSee('Governance')
            ->assertSee('Public policy')
            ->assertSee('Societal transformation')
            ->assertSeeInOrder(['Recognise purpose', 'Find your people', 'Build competence', 'Grow with guidance', 'Put faith into action']);
    }
}
