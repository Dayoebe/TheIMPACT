<?php

namespace Tests\Feature;

use App\Livewire\AboutPage;
use Tests\TestCase;

class AboutPageTest extends TestCase
{
    public function test_about_page_is_public_and_explains_all_six_topics(): void
    {
        $this->get(route('about'))
            ->assertOk()
            ->assertSeeLivewire(AboutPage::class)
            ->assertSeeInOrder([
                '01 / WHO WE ARE',
                '02 / WHY THE IMPACT EXISTS',
                '03 / THE PROBLEM WE’RE ADDRESSING',
                '04 / OUR PHILOSOPHY',
                '05 / OUR APPROACH',
                '06 / WHAT MAKES THE NETWORK DIFFERENT',
            ])
            ->assertSee('governance, public policy, leadership, service and societal transformation')
            ->assertSee('Conviction without direction')
            ->assertSee('Character and competence together');
    }

    public function test_about_page_has_its_own_metadata_and_working_section_destinations(): void
    {
        $response = $this->get(route('about'));

        $response->assertSee('<title>About THE IMPACT — Faith, Leadership &amp; Service in Africa</title>', false)
            ->assertSee('Discover why THE IMPACT exists, the gap we seek to address')
            ->assertSee('href="'.route('programmes.index').'"', false)
            ->assertSee('href="'.route('about').'"', false)
            ->assertSee('aria-current="page"', false);

        foreach (['who-we-are', 'why-we-exist', 'the-problem', 'our-philosophy', 'our-approach', 'our-difference'] as $section) {
            $response->assertSee('href="#'.$section.'"', false)
                ->assertSee('id="'.$section.'"', false);
        }
    }

    public function test_homepage_links_to_the_dedicated_about_page(): void
    {
        $this->get(route('home'))->assertOk()
            ->assertSee('href="'.route('about').'"', false)
            ->assertSee('More about THE IMPACT');
    }
}
